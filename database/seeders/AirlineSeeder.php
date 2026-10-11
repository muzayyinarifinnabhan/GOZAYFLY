<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;

/**
 * Seeder maskapai - data minimal 10 maskapai Indonesia & internasional.
 */
class AirlineSeeder extends Seeder
{
    public function run(): void
    {
        $airlines = [
            ['code' => 'GA', 'name' => 'Garuda Indonesia'],
            ['code' => 'QG', 'name' => 'Citilink'],
            ['code' => 'ID', 'name' => 'Batik Air'],
            ['code' => 'JT', 'name' => 'Lion Air'],
            ['code' => 'IU', 'name' => 'Super Air Jet'],
            ['code' => 'QZ', 'name' => 'AirAsia Indonesia'],
            ['code' => 'IP', 'name' => 'Pelita Air'],
            ['code' => 'SJ', 'name' => 'Sriwijaya Air'],
            ['code' => 'IN', 'name' => 'NAM Air'],
            ['code' => 'IW', 'name' => 'Wings Air'],
        ];

        foreach ($airlines as $airline) {
            Airline::firstOrCreate(['code' => $airline['code']], [
                'name' => $airline['name'],
                'description' => "Maskapai {$airline['name']} - mitra penerbangan GoZay.",
            ]);
        }
    }
}