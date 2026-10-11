<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ubah model booking menjadi 1 booking = beberapa kursi/penumpang.
     * - Buat tabel booking_passengers (satu baris per penumpang + kursi).
     * - Hapus kolom seat_id, passenger_name, passenger_nik dari tabel bookings.
     * - Tambahkan booking_passenger_id di tabel boarding_passes (1 per penumpang).
     */
    public function up(): void
    {
        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete(); // Relasi ke booking
            $table->foreignId('seat_id')->constrained()->cascadeOnDelete(); // Kursi penumpang
            $table->string('passenger_name'); // Nama penumpang
            $table->string('passenger_nik', 16); // NIK penumpang
            $table->integer('price'); // Harga kursi penumpang ini
            $table->timestamps();

            $table->index('booking_id');
        });

        // Hapus kolom tunggal di bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['seat_id']);
            $table->dropColumn(['seat_id', 'passenger_name', 'passenger_nik']);
        });

        // Boarding pass kini per penumpang
        Schema::table('boarding_passes', function (Blueprint $table) {
            $table->foreignId('booking_passenger_id')->nullable()->after('booking_id')
                ->constrained('booking_passengers')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('boarding_passes', function (Blueprint $table) {
            $table->dropForeign(['booking_passenger_id']);
            $table->dropColumn('booking_passenger_id');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('seat_id')->nullable()->after('flight_id')->constrained()->cascadeOnDelete();
            $table->string('passenger_name')->nullable()->after('booking_code');
            $table->string('passenger_nik', 16)->nullable()->after('passenger_name');
        });

        Schema::dropIfExists('booking_passengers');
    }
};
