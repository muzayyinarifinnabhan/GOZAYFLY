<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Melebarkan seat_row (1 -> 2 karakter) supaya mendukung layout
     * 50 kursi (10 baris x 5 kolom, A1..E10).
     */
    public function up(): void
    {
        Schema::table('seats', function (Blueprint $table) {
            $table->string('seat_row', 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('seats', function (Blueprint $table) {
            $table->string('seat_row', 1)->change();
        });
    }
};