<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Airport (bandara). Satu bandara dipakai banyak penerbangan.
 */
class Airport extends Model
{
    protected $fillable = [
        'code',
        'name',
        'city',
        'country',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi: penerbangan dengan maskapai ini sebagai bandara asal.
     */
    public function originFlights()
    {
        return $this->hasMany(Flight::class, 'origin_id');
    }

    /**
     * Relasi: penerbangan dengan maskapai ini sebagai bandara tujuan.
     */
    public function destinationFlights()
    {
        return $this->hasMany(Flight::class, 'destination_id');
    }

    /**
     * Accessor: label singkat "Jakarta (CGK)".
     */
    public function getLabelAttribute(): string
    {
        return "{$this->city} ({$this->code})";
    }
}