<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingPassenger;
use App\Models\User;

/**
 * BookingService: logika create booking multi-penumpang + reservasi kursi.
 */
class BookingService
{
    /**
     * Membuat booking dengan banyak penumpang/kursi, langsung me-reserve semua
     * kursi (available = false). Total harga = akumulasi harga tiap kursi.
     *
     * @param array $passengers List: [['seat' => Seat, 'passenger_name' => string, 'passenger_nik' => string], ...]
     * @return Booking
     */
    public function createBooking(User $user, array $passengers): Booking
    {
        $totalPrice = collect($passengers)->sum(fn ($p) => $p['seat']->price);

        $booking = Booking::create([
            'user_id' => $user->id,
            'flight_id' => $passengers[0]['seat']->flight_id,
            'booking_code' => Booking::generateBookingCode(),
            'total_price' => $totalPrice,
            'booking_status' => 'pending',
        ]);

        foreach ($passengers as $p) {
            $passenger = BookingPassenger::create([
                'booking_id' => $booking->id,
                'seat_id' => $p['seat']->id,
                'passenger_name' => $p['passenger_name'],
                'passenger_nik' => $p['passenger_nik'],
                'price' => $p['seat']->price,
            ]);

            // Kursi dikunci segera agar tidak dipesan orang lain
            $p['seat']->update(['available' => false]);
        }

        return $booking;
    }
}
