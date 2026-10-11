<?php

namespace App\Http\Controllers;

use App\Models\BoardingPass;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * TicketController: menampilkan / mengunduh e-ticket & boarding pass.
 */
class TicketController extends Controller
{
    /**
     * Halaman e-ticket (list penumpang + QR + opsi download PDF).
     */
    public function eticket(Booking $booking)
    {
        $this->authorize('view', $booking);

        $boardingPasses = $booking->boardingPasses;
        abort_if($boardingPasses->isEmpty(), 404, 'Tiket belum terbit.');

        return view('ticket.eticket', compact('booking', 'boardingPasses'));
    }

    /**
     * Halaman boarding pass yang bisa dicetak (per penumpang).
     */
    public function boardingPass(Booking $booking)
    {
        $this->authorize('view', $booking);

        $boardingPasses = $booking->boardingPasses;
        abort_if($boardingPasses->isEmpty(), 404, 'Boarding Pass belum terbit.');

        return view('ticket.boarding-pass', compact('booking', 'boardingPasses'));
    }

    /**
     * Unduh PDF boarding pass atau e-ticket untuk satu boarding pass.
     */
    public function downloadPdf(Request $request, BoardingPass $boardingPass, string $type): StreamedResponse
    {
        $booking = $boardingPass->booking;
        $this->authorize('view', $booking);

        $path = $type === 'boarding' ? $boardingPass->boarding_pdf : $boardingPass->eticket_pdf;
        abort_if(!$path || !Storage::disk('public')->exists($path), 404, 'File PDF tidak ditemukan.');

        $name = $type === 'boarding'
            ? "boarding-pass-{$booking->booking_code}-{$boardingPass->passenger_number}.pdf"
            : "eticket-{$booking->booking_code}-{$boardingPass->passenger_number}.pdf";

        return Storage::disk('public')->download($path, $name);
    }
}
