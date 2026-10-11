<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardingPass;
use Illuminate\View\View;

/**
 * Admin - Kelola Boarding Pass & e-ticket yang sudah terbit.
 */
class BoardingPassController extends Controller
{
    public function index(): View
    {
        $boardingPasses = BoardingPass::with(['booking.user', 'booking.flight.airline', 'bookingPassenger'])
            ->latest()
            ->paginate(15);

        return view('admin.boarding-passes.index', compact('boardingPasses'));
    }
}