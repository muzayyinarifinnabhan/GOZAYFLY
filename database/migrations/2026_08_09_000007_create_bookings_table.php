<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pemesanan (bookings).
     * Satu user bisa punya banyak booking (one-to-many).
     * Setiap booking memiliki 1 flight + 1 seat (dipilih user).
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Pemesan
            $table->foreignId('flight_id')->constrained()->cascadeOnDelete(); // Penerbangan dipilih
            $table->foreignId('seat_id')->constrained()->cascadeOnDelete(); // Kursi dipilih
            $table->string('booking_code', 10)->unique(); // Booking code utk e-ticket (contoh: GZY-XXXXXX)
            $table->string('passenger_name'); // Nama penumpang utama
            $table->string('passenger_nik', 16); // NIK penumpang
            $table->integer('total_price'); // Total biaya (harga seat + airline base)
            $table->enum('booking_status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();

            // Index user untuk mengambil riwayat booking
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};