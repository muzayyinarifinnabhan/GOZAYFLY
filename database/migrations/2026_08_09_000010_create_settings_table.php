<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel settings (key-value) untuk konten website yang dapat diedit admin
     * dari dashboard: hero, destinasi, janji, promo, dan kontak/footer.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();          // Contoh: promos.item1.title
            $table->text('value')->nullable();        // Isi konten
            $table->string('group')->default('general'); // hero / destinations / promises / promos / contact
            $table->string('label')->nullable();      // Keterangan di form admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};