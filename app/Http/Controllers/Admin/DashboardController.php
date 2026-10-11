<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\View\View;

/**
 * Dashboard Admin - ringkasan statistik.
 */
class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'airports' => Airport::count(),
            'airlines' => Airline::count(),
            'flights' => \App\Models\Flight::count(),
            'bookings' => Booking::count(),
            'payments_waiting' => Payment::where('status', Payment::STATUS_WAITING)->count(),
            'revenue' => Payment::where('status', Payment::STATUS_SUCCESS)->sum('amount'),
        ];

        // 5 transaksi terbaru
        $recentPayments = Payment::with('booking')
            ->latest()
            ->take(5)
            ->get();

        // Pemesanan yang menunggu konfirmasi admin (untuk ACC / tolak langsung)
        $waitingPayments = Payment::where('status', Payment::STATUS_WAITING)
            ->with(['booking.user', 'booking.flight'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPayments', 'waitingPayments'));
    }
}