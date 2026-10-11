<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

/**
 * Seeder bandara - data minimal 10 bandara utama Indonesia.
 */
class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            ['code' => 'CGK', 'name' => 'Soekarno-Hatta', 'city' => 'Jakarta', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bundaran_Hotel_Indonesia_%282025%29_%28cropped%29.jpg?width=1000'],
            ['code' => 'HLP', 'name' => 'Halim Perdanakusuma', 'city' => 'Jakarta', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bundaran_Hotel_Indonesia_%282025%29_%28cropped%29.jpg?width=1000'],
            ['code' => 'SUB', 'name' => 'Juanda', 'city' => 'Surabaya', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Central_Surabaya_view_taken_from_JW_Marriott_Surabaya.jpg?width=1000'],
            ['code' => 'DPS', 'name' => 'Ngurah Rai', 'city' => 'Denpasar', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Aerial_view_of_Bajra_Sandhi_Monument_Denpasar_Bali_Indonesia.jpg?width=950'],
            ['code' => 'KNO', 'name' => 'Kualanamu', 'city' => 'Medan', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Great_mosque_in_Medan_cropped.jpg?width=1000'],
            ['code' => 'UPG', 'name' => 'Sultan Hasanuddin', 'city' => 'Makassar', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Losari_Beach%2C_Makassar%2C_Indonesia.jpg?width=1000'],
            ['code' => 'JOG', 'name' => 'Adisutjipto', 'city' => 'Yogyakarta', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Jogja_-_Tugu_Monument_%282025%29_-_img_06.jpg?width=1000'],
            ['code' => 'PDG', 'name' => 'Minangkabau', 'city' => 'Padang', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Kota_Padang_Indah.jpg?width=1000'],
            ['code' => 'PNK', 'name' => 'Supadio', 'city' => 'Pontianak', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Equator_Pontianak_Monument.jpg?width=1000'],
            ['code' => 'MDC', 'name' => 'Sam Ratulangi', 'city' => 'Manado', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Soekarno_bridge_sunset.jpg?width=1000'],
        ];

        foreach ($airports as $airport) {
            Airport::firstOrCreate(['code' => $airport['code']], $airport);
        }
    }
}