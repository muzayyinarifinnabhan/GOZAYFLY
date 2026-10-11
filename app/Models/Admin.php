<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model Admin - autentikasi terpisah dari User menggunakan guard 'admin'.
 */
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_super',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_super' => 'boolean',
        ];
    }

    /**
     * Relasi: admin yang menyetujui pembayaran.
     */
    public function approvedPayments()
    {
        return $this->hasMany(Payment::class, 'admin_id');
    }
}