<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pembayaran (payments).
     * Satu booking memiliki satu pembayaran (one-to-one).
     * Admin menyetujui / menolak status pembayaran.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete(); // Relasi ke booking
            $table->enum('method', ['bca', 'bni', 'bri', 'mandiri', 'visa', 'mastercard', 'qris']); // Metode bayar
            $table->string('va_number', 30)->nullable(); // Nomor Virtual Account
            $table->string('provider')->nullable(); // Nama bank / kartu
            $table->integer('amount'); // Jumlah yang dibayar
            $table->string('receipt_image')->nullable(); // Bukti transfer (Laravel Storage)
            $table->enum('status', ['pending', 'waiting_confirmation', 'success', 'failed'])->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete(); // Admin konfirmasi
            $table->timestamp('paid_at')->nullable(); // Waktu pembayaran sukses
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};