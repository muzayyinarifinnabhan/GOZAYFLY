<?php

namespace App\Services;

use App\Models\BoardingPass;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * TicketService: generate QR Code, boarding pass & e-ticket (PDF) untuk setiap
 * penumpang setelah pembayaran disetujui. Semua file disimpan di Storage 'public'.
 */
class TicketService
{
    /**
     * Generate QR, PDF e-ticket, PDF boarding pass untuk tiap penumpang sebuah booking.
     * Dipanggil dari job setelah pembayaran berhasil disetujui.
     */
    public function generate(Booking $booking): void
    {
        $booking->load('flight.airline', 'flight.origin', 'flight.destination', 'passengers.seat');
        $flight = $booking->flight;

        foreach ($booking->passengers as $passenger) {
            $seat = $passenger->seat;

            // Nomor penumpang unik
            $passengerNumber = 'P-' . strtoupper(Str::random(6));
            $terminal = 'Terminal ' . rand(1, 3);
            $gate = 'Gate ' . rand(1, 28);
            $boardingCode = strtoupper(Str::random(8));

            // === QR Code (SVG agar tidak butuh ekstensi Imagick) ===
            $qrContent = "GOZAY|{$booking->booking_code}|{$passengerNumber}|{$flight->flight_number}|{$seat->seat_number}";
            $qrFilename = 'qr/qr-' . $booking->booking_code . '-' . $passengerNumber . '.svg';
            $qrSvg = QrCode::format('svg')->size(220)->margin(1)->generate($qrContent);
            Storage::disk('public')->put($qrFilename, $qrSvg);

            // === Data yang dirender ke PDF ===
            $data = [
                'booking' => $booking,
                'passenger' => $passenger,
                'flight' => $flight,
                'seat' => $seat,
                'passengerNumber' => $passengerNumber,
                'terminal' => $terminal,
                'gate' => $gate,
                'qr' => $qrContent,
                'issued' => now(),
            ];

            // === PDF E-Ticket ===
            $eticketFilename = 'tickets/eticket-' . $booking->booking_code . '-' . $passengerNumber . '.pdf';
            Pdf::loadView('pdf.eticket', $data)
                ->setPaper('a4', 'portrait')
                ->save(Storage::disk('public')->path($eticketFilename));

            // === PDF Boarding Pass ===
            $boardingFilename = 'tickets/boarding-' . $booking->booking_code . '-' . $passengerNumber . '.pdf';
            Pdf::loadView('pdf.boarding-pass', $data)
                ->setPaper('a4', 'portrait')
                ->save(Storage::disk('public')->path($boardingFilename));

            // === Simpan record boarding pass per penumpang ===
            BoardingPass::updateOrCreate(
                ['booking_passenger_id' => $passenger->id],
                [
                    'booking_id' => $booking->id,
                    'passenger_number' => $passengerNumber,
                    'terminal' => $terminal,
                    'gate' => $gate,
                    'boarding_code' => $boardingCode,
                    'qr_path' => $qrFilename,
                    'eticket_pdf' => $eticketFilename,
                    'boarding_pdf' => $boardingFilename,
                    'issued_at' => now(),
                ]
            );
        }

        // Update status booking -> paid
        $booking->update([
            'booking_status' => 'paid',
        ]);

        Log::info('Tiket berhasil digenerate untuk booking ' . $booking->booking_code . ' (' . $booking->passengers->count() . ' penumpang)');
    }
}
