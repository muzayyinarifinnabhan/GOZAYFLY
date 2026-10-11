<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Seat (kursi pesawat).
 */
class Seat extends Model
{
    protected $fillable = [
        'flight_id',
        'seat_number',
        'seat_row',
        'seat_col',
        'class',
        'price',
        'available',
    ];

    protected function casts(): array
    {
        return [
            'available' => 'boolean',
            'price' => 'integer',
        ];
    }

    /**
     * Relasi: kursi milik penerbangan.
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}