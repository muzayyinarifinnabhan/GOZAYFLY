<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * FlightController: detail penerbangan & tampilan pilihan kursi interaktif.
 */
class FlightController extends Controller
{
    /**
     * Detail penerbangan + layout kursi 6x6 (A1..F6).
     * Hijau = tersedia, Merah = sudah dipesan, Biru = dipilih user (via JS/AJAX).
     */
    public function seats(Flight $flight): View
    {
        $flight->load(['airline', 'origin', 'destination', 'seats']);

        // Kelompokkan kursi per baris agar mudah dirender
        $rows = $flight->seats->groupBy('seat_row')->sortKeys(SORT_NATURAL);

        return view('booking.seat-selection', [
            'flight' => $flight,
            'rows' => $rows,
        ]);
    }

    /**
     * Endpoint AJAX: data kursi (untuk refresh status pemesanan).
     */
    public function seatsAjax(Flight $flight)
    {
        $seats = $flight->seats()
            ->orderBy('seat_row')
            ->orderBy('seat_col')
            ->get()
            ->map(fn ($seat) => [
                'seat_number' => $seat->seat_number,
                'class' => $seat->class,
                'price' => $seat->price,
                'available' => $seat->available,
            ]);

        return response()->json(['seats' => $seats]);
    }
}