<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi massal (mass assignment).
     */
    protected $fillable = [
        'name',
        'nik',
        'phone',
        'email',
        'avatar',
        'password',
        'email_verified_at',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast: password otomatis di-hash, tanggal diubah ke Carbon.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: satu user punya banyak pemesanan.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}