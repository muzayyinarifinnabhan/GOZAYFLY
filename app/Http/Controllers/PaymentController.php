<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * PaymentController: alur pembayaran user.
 * Status: pending -> waiting_confirmation (user "sudah bayar") -> success/failed (admin).
 */
class PaymentController extends Controller
{
    /**
     * Pilih metode pembayaran (VA, Kartu, QRIS).
     */
    public function create(Booking $booking): View
    {
        $this->authorize('view', $booking);

        return view('payment.create', compact('booking'));
    }

    /**
     * Simpan pembayaran (rekap) lalu tampilkan instruksi / VA number.
     */
    public function store(PaymentRequest $request): RedirectResponse
    {
        $booking = Booking::with('user')->findOrFail($request->booking_id);

        // Pastikan pemesan yang membayar
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Bukan pemesan booking ini.');
        }

        // Jangan sampai pembayaran dobel untuk booking yang sudah dibayar
        abort_if($booking->payment && $booking->payment->status !== Payment::STATUS_FAILED, 409, 'Pembayaran sudah dibuat.');

        $method = $request->method;

        // Generate nomor Virtual Account untuk metode bank
        $vaNumber = null;
        if (in_array($method, ['bca', 'bni', 'bri', 'mandiri'])) {
            $vaNumber = $this->generateVaNumber($method);
        }

        // Simpan payment (status pending = menunggu pembayaran)
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'method' => $method,
            'va_number' => $vaNumber,
            'provider' => $this->providerName($method),
            'amount' => $booking->total_price,
            'status' => Payment::STATUS_PENDING,
        ]);

        // Redirect ke halaman instruksi
        return redirect()->route('payment.show', $payment);
    }

    /**
     * Halaman instruksi/ringkasan pembayaran + tombol "Saya Sudah Bayar".
     * Jika status pembayaran sudah diproses, arahkan ke halaman status.
     */
    public function show(Payment $payment): RedirectResponse|View
    {
        $this->authorize('view', $payment);

        if ($payment->status !== Payment::STATUS_PENDING) {
            return redirect()->route('payment.status', ['booking' => $payment->booking, 'payment' => $payment]);
        }

        // Untuk QRIS: render kode QR berisi payload pembayaran.
        $qrSvg = null;
        if ($payment->method === 'qris') {
            $qrSvg = QrCode::format('svg')->size(220)->margin(1)->generate($payment->qrisPayload());
        }

        return view('payment.show', compact('payment', 'qrSvg'));
    }

    /**
     * User menegaskan telah membayar -> status jadi "Menunggu Konfirmasi Admin".
     * Jika pembayaran sudah diproses (sudah ACC / ditolak / menunggu),
     * arahkan ke halaman status agar user tidak stuck di halaman instruksi.
     */
    public function confirm(Request $request, Payment $payment): RedirectResponse
    {
        $this->authorize('view', $payment);

        if ($payment->status !== Payment::STATUS_PENDING) {
            return redirect()->route('payment.status', ['booking' => $payment->booking, 'payment' => $payment])
                ->with('info', 'Status pembayaran sudah diproses.');
        }

        // Opsional unggah bukti bayar (Laravel Storage)
        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store('payments', 'public');
        }

        $payment->update([
            'status' => Payment::STATUS_WAITING,
            'receipt_image' => $receiptPath,
        ]);

        return redirect()->route('payment.status', ['booking' => $payment->booking, 'payment' => $payment])
            ->with('success', 'Terima kasih! Silakan menunggu konfirmasi admin.');
    }

    /**
     * Halaman status pembayaran (ditampilkan user sambil menunggu admin).
     */
    public function status(Booking $booking, Payment $payment): View
    {
        $this->authorize('view', $booking);

        return view('payment.status', compact('booking', 'payment'));
    }

    /**
     * Generate nomor VA virtual bangku format kode bank + invoice.
     */
    private function generateVaNumber(string $method): string
    {
        return match ($method) {
            'bca' => '88' . rand(100000000, 999999999),
            'bni' => '988' . rand(10000000, 99999999),
            'bri' => '88888' . rand(1000000, 9999999),
            'mandiri' => '89508' . rand(100000, 999999),
        };
    }

    /**
     * Label nama provider.
     */
    private function providerName(string $method): string
    {
        return match ($method) {
            'bca' => 'Bank BCA',
            'bni' => 'Bank BNI',
            'bri' => 'Bank BRI',
            'mandiri' => 'Bank Mandiri',
            'visa' => 'Visa',
            'mastercard' => 'Mastercard',
            'qris' => 'QRIS',
            default => ucfirst($method),
        };
    }
}