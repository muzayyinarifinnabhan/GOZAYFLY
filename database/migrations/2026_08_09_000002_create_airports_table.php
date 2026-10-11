<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel bandara (airports) - referensi kota asal / tujuan penerbangan.
     * Data minimal 10 bandara Indonesia diisi lewat seeder.
     */
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // Kode IATA: CGK, DPS, SUB, dst
            $table->string('name'); // Nama bandara
            $table->string('city'); // Kota
            $table->string('country')->default('Indonesia'); // Negara
            $table->string('image')->nullable(); // Foto bandara (Storage/URL)
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};