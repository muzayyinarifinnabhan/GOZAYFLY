<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel penerbangan (flights) - jadwal penerbangan dengan harga dan kelas.
     * Relasi: belongsTo Airline, belongsTo Airport (asal & tujuan).
     * ibeberapa seat dimiliki oleh satu penerbangan (one-to-many).
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained()->cascadeOnDelete(); // Relasi maskapai
            $table->foreignId('origin_id')->constrained('airports')->cascadeOnDelete(); // Bandara asal
            $table->foreignId('destination_id')->constrained('airports')->cascadeOnDelete(); // Bandara tujuan
            $table->string('flight_number', 10); // Nomor penerbangan, contoh: GA-412
            $table->date('departure_date'); // Tanggal berangkat
            $table->time('departure_time'); // Jam berangkat
            $table->time('arrival_time'); // Jam tiba
            $table->integer('duration_minutes'); // Durasi dalam menit
            $table->integer('price'); // Base price (IDR)
            $table->string('seat_class')->default('economy'); // economy / premium_economy / business / first
            $table->integer('seats_total'); // Total kursi pesawat
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Index gabungan agar pencarian tanggal + rute cepat
            $table->index(['origin_id', 'destination_id', 'departure_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};