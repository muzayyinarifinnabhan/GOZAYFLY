<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model BookingPassenger (penumpang dalam satu booking).
 * Satu booking bisa memuat banyak penumpang, masing-masing dengan kursinya sendiri.
 */
class BookingPassenger extends Model
{
    protected $fillable = [
        'booking_id',
        'seat_id',
        'passenger_name',
        'passenger_nik',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }

    /**
     * Relasi: penumpang milik booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Relasi: kursi yang ditempati penumpang.
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    /**
     * Relasi: boarding pass / e-ticket penumpang ini.
     */
    public function boardingPass()
    {
        return $this->hasOne(BoardingPass::class);
    }
}
