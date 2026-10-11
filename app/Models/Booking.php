<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Model Booking (pemesanan).
 * Satu booking: 1 user + 1 flight + banyak penumpang/kursi, lalu 1 payment.
 */
class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_id',
        'booking_code',
        'total_price',
        'booking_status',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'integer',
        ];
    }

    /**
     * Relasi: pemesan (user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: penerbangan yang dipesan.
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    /**
     * Relasi: daftar penumpang beserta kursinya.
     */
    public function passengers()
    {
        return $this->hasMany(BookingPassenger::class);
    }

    /**
     * Relasi: pembayaran terkait (one-to-one).
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Relasi: boarding pass & e-ticket untuk tiap penumpang.
     */
    public function boardingPasses()
    {
        return $this->hasManyThrough(BoardingPass::class, BookingPassenger::class);
    }

    /**
     * Relasi: boarding pass pertama (untuk tampilan ringkas).
     */
    public function boardingPass()
    {
        return $this->hasOneThrough(BoardingPass::class, BookingPassenger::class);
    }

    /**
     * Helper: daftar nomor kursi (dipisah koma).
     */
    public function seatNumbers(): string
    {
        return $this->passengers->map(fn ($p) => $p->seat->seat_number)->join(', ');
    }

    /**
     * Generate kode booking unik format GZY-XXXXXX.
     */
    public static function generateBookingCode(): string
    {
        do {
            $code = 'GZY-' . strtoupper(Str::random(6));
        } while (static::where('booking_code', $code)->exists());

        return $code;
    }
}
