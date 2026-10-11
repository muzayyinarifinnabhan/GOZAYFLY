<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model BoardingPass & e-ticket yang digenerate setelah bayar disetujui.
 */
class BoardingPass extends Model
{
    protected $fillable = [
        'booking_id',
        'booking_passenger_id',
        'passenger_number',
        'terminal',
        'gate',
        'boarding_code',
        'qr_path',
        'eticket_pdf',
        'boarding_pdf',
        'issued_at',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
        ];
    }

    /**
     * Relasi: boarding pass milik booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Relasi: penumpang yang menerima boarding pass ini.
     */
    public function bookingPassenger()
    {
        return $this->belongsTo(BookingPassenger::class);
    }
}