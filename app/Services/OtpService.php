<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

/**
 * OtpService - logika bisnis kode OTP:
 *   - Generate OTP acak 6 digit
 *   - Kirim email via SMTP (queue)
 *   - Validasi & batas percobaan (5x salah)
 *   - Kirim ulang maksimal 3x
 *   - OTP berlaku 5 menit
 */
class OtpService
{
    public const MAX_ATTEMPTS = 5;    // Maksimal salah ketik OTP
    public const MAX_RESENDS = 3;     // Maksimal kirim ulang OTP
    public const EXPIRY_MINUTES = 5;  // OTP berlaku 5 menit

    /**
     * Buat OTP baru + kirim email.
     * OTP lama yang belum dipakai akan dihapus.
     *
     * @return OtpVerification
     */
    public function generate(string $email, string $type = 'register'): OtpVerification
    {
        // Bersihkan OTP lama untuk email + tipe yang sama
        OtpVerification::where('email', $email)
            ->where('type', $type)
            ->where('is_used', false)
            ->delete();

        $otp = (string) random_int(100000, 999999); // 6 digit acak

        $record = OtpVerification::create([
            'email' => $email,
            'otp' => $otp,
            'type' => $type,
            'expires_at' => now()->addMinutes(self::EXPIRY_MINUTES),
            'attempts' => 0,
            'resend_count' => 0,
        ]);

        // Kirim email OTP langsung ke email user (SMTP).
        try {
            Mail::to($email)->send(new OtpMail($otp));
        } catch (\Throwable $e) {
            Log::warning("Gagal mengirim OTP ke {$email}: {$e->getMessage()}");
        }

        return $record;
    }

    /**
     * Resend OTP. Maksimal 3x, kode di-generate ulang, attempts di-reset.
     */
    public function resend(string $email, string $type = 'register'): array
    {
        $record = OtpVerification::where('email', $email)
            ->where('type', $type)
            ->where('is_used', false)
            ->latest()
            ->first();

        // Jika tidak ada record, berarti OTP lama sudah lewat / gagal -> buat baru
        if (!$record) {
            $this->generate($email, $type);
            return [
                'success' => true,
                'message' => 'Kode OTP baru telah dikirim.',
            ];
        }

        // Cek batas kirim ulang
        if ($record->resend_count >= self::MAX_RESENDS) {
            return [
                'success' => false,
                'message' => 'Kesempatan kirim ulang sudah habis (maks 3 kali). Silakan daftar ulang.',
            ];
        }

        // Generate kode baru, reset attempts, naikkan resend_count
        $newOtp = (string) random_int(100000, 999999);
        $record->update([
            'otp' => $newOtp,
            'expires_at' => now()->addMinutes(self::EXPIRY_MINUTES),
            'attempts' => 0,
            'resend_count' => $record->resend_count + 1,
        ]);

        try {
            Mail::to($email)->send(new OtpMail($newOtp));
        } catch (\Throwable $e) {
            Log::warning("Gagal mengirim ulang OTP ke {$email}: {$e->getMessage()}");
        }

        return [
            'success' => true,
            'message' => 'Kode OTP baru terkirim ke email Anda.',
        ];
    }

    /**
     * Verifikasi kode yang dimasukkan user.
     *
     * @throws ValidationException
     */
    public function verify(string $email, string $otp, string $type = 'register'): OtpVerification
    {
        $record = OtpVerification::where('email', $email)
            ->where('type', $type)
            ->where('is_used', false)
            ->latest()
            ->first();

        // Tidak ada OTP aktif
        if (!$record) {
            throw ValidationException::withMessages([
                'otp' => 'Kode OTP tidak ditemukan. Silakan minta kode baru.',
            ]);
        }

        // OTP kedaluwarsa (5 menit)
        if ($record->isExpired()) {
            throw ValidationException::withMessages([
                'otp' => 'Kode OTP sudah kedaluwarsa. Silakan kirim ulang.',
            ]);
        }

        // Batas percobaan salah habis
        if ($record->attemptsExceeded()) {
            throw ValidationException::withMessages([
                'otp' => 'Terlalu banyak percobaan yang salah. Silakan minta kode baru.',
            ]);
        }

        // Kode benar
        if ($record->otp === $otp) {
            $record->update([
                'is_used' => true,
                'verified_at' => now(),
            ]);

            return $record;
        }

        // Kode salah -> tambah attempts
        $record->increment('attempts');
        $remaining = self::MAX_ATTEMPTS - $record->attempts;

        throw ValidationException::withMessages([
            'otp' => "Kode OTP salah. Sisa kesempatan: {$remaining} kali.",
        ]);
    }
}