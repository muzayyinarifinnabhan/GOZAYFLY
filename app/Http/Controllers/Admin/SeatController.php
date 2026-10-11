<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Seat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Admin - Kelola Kursi: melihat layout, mengubah harga, generate ulang.
 */
class SeatController extends Controller
{
    /**
     * Halaman kelola kursi untuk sebuah penerbangan.
     */
    public function index(Flight $flight): View
    {
        $flight->load('seats');
        $rows = $flight->seats->groupBy('seat_row')->sortKeys();

        return view('admin.seats.index', compact('flight', 'rows'));
    }

    /**
     * Update harga / status satu kursi.
     */
    public function update(Request $request, Seat $seat): RedirectResponse
    {
        $data = $request->validate([
            'price' => ['required', 'integer', 'min:0'],
            'available' => ['nullable', 'boolean'],
        ]);

        $seat->update([
            'price' => $data['price'],
            'available' => $request->boolean('available'),
        ]);

        return back()->with('success', 'Kursi ' . $seat->seat_number . ' berhasil diperbarui.');
    }

    /**
     * Generate ulang 200 kursi (A1..E40) untuk penerbangan:
     * 50 kursi per kelas -> First (baris 1-10), Bisnis (11-20),
     * Ekonomi Premium (21-30), Ekonomi (31-40).
     */
    public function generate(Flight $flight): RedirectResponse
    {
        $flight->seats()->delete();

        $cols = ['A', 'B', 'C', 'D', 'E'];
        $classPlan = [
            1 => ['class' => 'first', 'surcharge' => 500000],
            2 => ['class' => 'business', 'surcharge' => 250000],
            3 => ['class' => 'premium_economy', 'surcharge' => 150000],
            4 => ['class' => 'economy', 'surcharge' => 0],
        ];

        foreach (range(1, 40) as $row) {
            $plan = $classPlan[intdiv($row - 1, 10) + 1];

            foreach ($cols as $col) {
                Seat::create([
                    'flight_id' => $flight->id,
                    'seat_number' => $col . $row,
                    'seat_row' => (string) $row,
                    'seat_col' => $col,
                    'class' => $plan['class'],
                    'price' => $flight->price + $plan['surcharge'],
                    'available' => true,
                ]);
            }
        }

        $flight->update(['seats_total' => 200]);

        return back()->with('success', '200 kursi berhasil dibuat ulang (50 per kelas: First, Bisnis, Ekonomi Premium, Ekonomi).');
    }
}