<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed awal database GoZay.
     * Urutan penting: bandara -> maskapai -> penerbangan(+kursi) -> admin -> user demo.
     */
    public function run(): void
    {
        $this->call([
            AirportSeeder::class,
            AirlineSeeder::class,
            FlightSeeder::class,
            SettingSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
        ]);
    }
}