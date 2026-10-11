<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel admin untuk login panel administrasi GoZay.
     * Menggunakan session guard sendiri ('admin').
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama admin
            $table->string('email')->unique(); // Email login admin
            $table->string('phone', 20)->nullable(); // Nomor HP admin
            $table->string('password'); // Password di-hash dengan Hash::make()
            $table->boolean('is_super')->default(false); // Penanda admin super (opsional)
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};