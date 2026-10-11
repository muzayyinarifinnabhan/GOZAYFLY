<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel verifikasi OTP email.
     * Menyimpan kode OTP 6 digit, batas percobaan (5x) dan batas kirim ulang (3x).
     * OTP hanya valid 5 menit.
     */
    public function up(): void
    {
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // Email yang meminta OTP
            $table->string('otp', 6); // Kode OTP
            $table->string('type')->default('register'); // register / reset
            $table->timestamp('expires_at'); // Waktu kadaluarsa (5 menit)
            $table->integer('attempts')->default(0); // Jumlah percobaang salah (maks 5)
            $table->integer('resend_count')->default(0); // Jumlah kirim ulang (maks 3)
            $table->boolean('is_used')->default(false); // Sudah pernah dipakai?
            $table->timestamp('verified_at')->nullable(); // Waktu sukses verifikasi
            $table->timestamps();

            // Satu email hanya boleh punya satu OTP aktif per tipe
            $table->index(['email', 'type'], 'otp_email_type_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_verifications');
    }
};