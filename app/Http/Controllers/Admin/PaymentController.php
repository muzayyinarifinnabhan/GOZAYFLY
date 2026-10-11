<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateTicketJob;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Admin - Kelola Pembayaran: menyetujui / menolak pembayaran yang
 * berstatus "menunggu konfirmasi".
 */
class PaymentController extends Controller
{
    /**
     * Daftar semua pembayaran.
     */
    public function index(): View
    {
        $payments = Payment::with(['booking.user', 'booking.flight'])
            ->latest()
            ->paginate(15);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Detail pembayaran + tombol setujui / tolak.
     */
    public function show(Payment $payment): View
    {
        $payment->load(['booking.user', 'booking.flight.airline', 'booking.passengers.seat', 'admin']);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Setujui pembayaran:
     * - status payment -> success
     * - status booking -> paid
     * - jalankan job generate e-ticket & boarding pass (Laravel Queue)
     */
    public function approve(Payment $payment): RedirectResponse
    {
        abort_unless(in_array($payment->status, [Payment::STATUS_PENDING, Payment::STATUS_WAITING]), 422, 'Pembayaran harus menunggu konfirmasi.');

        $payment->update([
            'status' => Payment::STATUS_SUCCESS,
            'admin_id' => Auth::guard('admin')->id(),
            'paid_at' => now(),
        ]);

        $booking = $payment->booking;
        $booking->update(['booking_status' => 'paid']);

        // Proses generate tiket di antrian (Laravel Queue)
        GenerateTicketJob::dispatch($booking);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran disetujui. Ticket sedang digenerate.');
    }

    /**
     * Tolak pembayaran -> status gagal, kursi dikembalikan.
     */
    public function reject(Payment $payment): RedirectResponse
    {
        abort_unless(in_array($payment->status, [Payment::STATUS_PENDING, Payment::STATUS_WAITING]), 422, 'Pembayaran harus menunggu konfirmasi.');

        $payment->update([
            'status' => Payment::STATUS_FAILED,
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        $booking = $payment->booking;

        // Kembalikan semua kursi sehingga bisa dipesan lagi
        foreach ($booking->passengers as $passenger) {
            $passenger->seat->update(['available' => true]);
        }

        $booking->update(['booking_status' => 'cancelled']);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran ditolak.');
    }

    /**
     * Hapus pembayaran: kursi dikembalikan (available) & booking dibatalkan.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $booking = $payment->booking;

        // Kembalikan semua kursi sehingga bisa dipesan lagi
        foreach ($booking->passengers as $passenger) {
            $passenger->seat->update(['available' => true]);
        }

        $booking->update(['booking_status' => 'cancelled']);

        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran dihapus. Kursi dikembalikan.');
    }
}