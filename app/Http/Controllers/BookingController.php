<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Seat;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * BookingController: buat pemesanan, ringkasan, dan riwayat user.
 */
class BookingController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {
    }

    /**
     * Form ringkasan pemesanan + data penumpang (kursi dipilih dari halaman kursi).
     * Terima daftar seat id (multiple) dari query parameter seats[].
     */
    public function create(Request $request, Flight $flight): View
    {
        $seatIds = $request->input('seats', []);
        $seatIds = is_array($seatIds) ? array_filter(array_map('intval', $seatIds)) : [];

        if (empty($seatIds)) {
            return abort(404, 'Belum ada kursi dipilih.');
        }

        // Ambil kursi sesuai flight & pastikan tersedia
        $seats = Seat::where('flight_id', $flight->id)
            ->whereIn('id', $seatIds)
            ->where('available', true)
            ->orderBy('seat_row')
            ->orderBy('seat_col')
            ->get();

        if ($seats->count() !== count($seatIds)) {
            return abort(422, 'Salah satu kursi sudah tidak tersedia. Silakan pilih ulang.');
        }

        $total = $seats->sum('price');

        return view('booking.summary', [
            'flight' => $flight,
            'seats' => $seats,
            'total' => $total,
        ]);
    }

    /**
     * Simpan booking multi-penumpang -> redirect ke pembayaran.
     */
    public function store(Request $request, Flight $flight): RedirectResponse
    {
        $validated = $request->validate([
            'seats' => ['required', 'array', 'min:1'],
            'seats.*' => ['integer', 'exists:seats,id'],
            'passenger_name' => ['required', 'array'],
            'passenger_name.*' => ['required', 'string', 'max:255'],
            'passenger_nik' => ['required', 'array'],
            'passenger_nik.*' => ['required', 'string', 'size:16', 'regex:/^[0-9]{16}$/'],
        ]);

        // Susun penumpang sesuai daftar kursi
        $seatIds = array_values(array_unique(array_map('intval', $validated['seats'])));
        $passengers = [];

        foreach ($seatIds as $index => $seatId) {
            $seat = Seat::where('id', $seatId)
                ->where('flight_id', $flight->id)
                ->where('available', true)
                ->first();

            if (!$seat) {
                return back()->with('error', 'Maaf, salah satu kursi sudah tidak tersedia.');
            }

            $passengers[] = [
                'seat' => $seat,
                'passenger_name' => $validated['passenger_name'][$index] ?? $validated['passenger_name'][$seatId] ?? null,
                'passenger_nik' => $validated['passenger_nik'][$index] ?? $validated['passenger_nik'][$seatId] ?? null,
            ];
        }

        $booking = $this->bookingService->createBooking(Auth::user(), $passengers);

        return redirect()->route('payment.create', $booking)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    /**
     * Halaman "Perjalanan Saya": tiket aktif, menunggu bayar, riwayat, & tracking.
     */
    public function history(): View
    {
        $bookings = Auth::user()->bookings()
            ->with(['flight.airline', 'flight.origin', 'flight.destination', 'passengers.seat', 'payment', 'boardingPasses.bookingPassenger'])
            ->latest()
            ->get();

        $today = now()->startOfDay();
        $isUpcoming = fn (Booking $booking) => optional($booking->flight?->departure_date)->startOfDay()->gte($today);

        $activeBookings = $bookings->filter(fn (Booking $b) => $b->booking_status === 'paid' && $isUpcoming($b));
        $pendingBookings = $bookings->filter(fn (Booking $b) => $b->booking_status === 'pending' && $isUpcoming($b));
        $historyBookings = $bookings->reject(function (Booking $b) use ($activeBookings, $pendingBookings) {
            return $activeBookings->contains('id', $b->id) || $pendingBookings->contains('id', $b->id);
        });

        $rejectedBookings = $historyBookings->filter(
            fn (Booking $b) => $b->booking_status === 'cancelled'
                && $b->payment
                && $b->payment->status === \App\Models\Payment::STATUS_FAILED
                && $b->flight
                && $isUpcoming($b)
        )->values();

        // Penerbangan yang sedang dilacak (tiket aktif terdekat)
        $trackingBooking = $activeBookings
            ->sortBy(fn (Booking $b) => $b->flight?->departure_date ?? now()->subDay())
            ->first();

        $trackingProgress = 0;
        if ($trackingBooking && $trackingBooking->flight) {
            $flight = $trackingBooking->flight;
            $departure = $flight->departure_date->copy()->setTimeFrom($flight->departure_time);
            $arrival = $flight->departure_date->copy()->setTimeFrom($flight->arrival_time);
            if ($arrival->lt($departure)) {
                $arrival->addDay();
            }

            $total = max(1, $departure->diffInSeconds($arrival));
            $trackingProgress = (int) round(min(100, max(0, now()->diffInSeconds($departure, false) / $total * 100)));
        }

        return view('user.trips', compact(
            'activeBookings',
            'pendingBookings',
            'rejectedBookings',
            'historyBookings',
            'trackingBooking',
            'trackingProgress'
        ));
    }

    /**
     * Batalkan booking (hanya milik sendiri, via Policy).
     */
    public function cancel(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorize('cancel', $booking);

        // Kembalikan semua kursi
        foreach ($booking->passengers as $passenger) {
            $passenger->seat->update(['available' => true]);
        }

        $booking->update(['booking_status' => 'cancelled']);

        return back()->with('success', 'Booking dibatalkan.');
    }
}
