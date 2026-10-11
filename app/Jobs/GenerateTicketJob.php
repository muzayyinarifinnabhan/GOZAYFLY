<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Services\TicketService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * Job yang diproses di antrian (Laravel Queue):
 * generate e-ticket + boarding pass setelah pembayaran disetujui admin.
 */
class GenerateTicketJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Booking $booking)
    {
    }

    public function handle(TicketService $ticketService): void
    {
        $ticketService->generate($this->booking);
    }
}