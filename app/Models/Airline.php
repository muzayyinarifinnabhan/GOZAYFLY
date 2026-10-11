<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Airline (maskapai). One-to-many ke flights.
 */
class Airline extends Model
{
    protected $fillable = [
        'code',
        'name',
        'logo',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi: satu maskapai punya banyak penerbangan.
     */
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}