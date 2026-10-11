<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model OtpVerification - menyimpan kode OTP per email.
 */
class OtpVerification extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'type',
        'expires_at',
        'attempts',
        'resend_count',
        'is_used',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'verified_at' => 'datetime',
            'is_used' => 'boolean',
        ];
    }

    /**
     * Helper: apakah OTP sudah lewat batas waktu (5 menit)?
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Helper: apakah percobaan salah sudah mencapai batas (5x)?
     */
    public function attemptsExceeded(): bool
    {
        return $this->attempts >= 5;
    }

    /**
     * Helper: apakah kirim ulang sudah mencapai batas (3x)?
     */
    public function resendExceeded(): bool
    {
        return $this->resend_count >= 3;
    }
}