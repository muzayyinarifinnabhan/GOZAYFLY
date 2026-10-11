<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel kursi penerbangan (seats).
     * Format kursi A1..F6. Warna UI:
     *   hijau (available) / merah (booked) / biru (dipilih).
     * Relasi many-to-one ke table flights.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained()->cascadeOnDelete(); // Kepemilikan penerbangan
            $table->string('seat_number', 4); // Contoh: A1
            $table->string('seat_row', 1); // Baris (1..6)
            $table->string('seat_col', 1); // Kolom (A..F)
            $table->string('class', 20); // economy / premium_economy / business / first
            $table->integer('price'); // Harga kursi (sudah termasuk surcharge kelas)
            $table->boolean('available')->default(true); // false = sudah dipesan
            $table->timestamps();

            // Satu penerbangan tidak boleh duplikat nomor kursi
            $table->unique(['flight_id', 'seat_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};