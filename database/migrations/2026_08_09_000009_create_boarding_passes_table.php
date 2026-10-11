<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel boarding pass & e-ticket.
     * Dibuat otomatis oleh sistem setelah pembayaran disetujui admin.
     * Menyimpan QR Code, kode booking, terminal & gate, serta path PDF.
     */
    public function up(): void
    {
        Schema::create('boarding_passes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete(); // Relasi ke booking
            $table->string('passenger_number', 10)->unique(); // Nomor penumpang (P-XXXXXX)
            $table->string('terminal'); // Terminal bandara
            $table->string('gate'); // Gate keberangkatan
            $table->string('boarding_code')->nullable(); // Kode QR validation
            $table->string('qr_path')->nullable(); // File QR (Laravel Storage: publik)
            $table->string('eticket_pdf')->nullable(); // PDF e-ticket
            $table->string('boarding_pdf')->nullable(); // PDF boarding pass
            $table->timestamp('issued_at')->nullable(); // Waktu terbit
            $table->timestamps();

            $table->index('booking_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boarding_passes');
    }
};