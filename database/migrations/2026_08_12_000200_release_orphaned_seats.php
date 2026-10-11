<?php

use App\Models\BookingPassenger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Perbaikan data: kursi yang ditandai unavailable tetapi tidak terhubung ke
     * booking_passengers manapun adalah sisa booking skema lama (1 booking = 1 kursi,
     * tanpa tabel penumpang). Karena data penumpangnya hilang saat kolom dihapus,
     * kursi-kursi ini dikembalikan ke status tersedia agar tidak terkunci permanen.
     */
    public function up(): void
    {
        DB::table('seats')
            ->where('available', false)
            ->whereNotIn('id', BookingPassenger::query()->select('seat_id'))
            ->update(['available' => true]);
    }

    public function down(): void
    {
        // Tidak perlu dibalik.
    }
};
