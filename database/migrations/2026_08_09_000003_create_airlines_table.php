<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel maskapai (airlines).
     * Setiap maskapai punya banyak penerbangan (one-to-many).
     */
    public function up(): void
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // Kode maskapai
            $table->string('name'); // Nama maskapai
            $table->string('logo')->nullable(); // Logo maskapai disimpan di Laravel Storage
            $table->string('description')->nullable(); // Deskripsi singkat maskapai
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};