<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeder konten website default (hero, destinasi, janji, promo, kontak).
 * Berlaku untuk Laravel: php artisan db:seed --class=SettingSeeder.
 */
class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['hero.headline_before', 'hero', 'Teks utama (bagian awal)', 'Temukan'],
            ['hero.highlight',      'hero', 'Kata yang ditebalkan/berwarna', 'Petualangan'],
            ['hero.headline_after', 'hero', 'Teks utama (bagian akhir)', 'Anda Berikutnya'],
            ['hero.background_image', 'hero', 'Gambar latar hero (URL)', 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1600&q=80'],

            ['destinations.eyebrow', 'destinations', 'Label kecil atas', 'Inspirasi'],
            ['destinations.title',   'destinations', 'Judul bagian', 'Destinasi Populer'],
            ['destinations.hero_image', 'destinations', 'Gambar hero destinasi (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Piaynemo%2C_Raja_Ampat_%2845710648355%29.jpg?width=1280'],
            ['destinations.raja_ampat',   'destinations', 'Gambar Raja Ampat (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Piaynemo%2C_Raja_Ampat_%2831683906917%29.jpg?width=1280'],
            ['destinations.labuan_bajo',  'destinations', 'Gambar Labuan Bajo (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Pink_Beach%2C_Padar_Island%2C_Komodo_National_Park.jpg?width=1280'],
            ['destinations.bromo',        'destinations', 'Gambar Gunung Bromo (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Mount_Bromo_at_sunrise%2C_showing_its_volcanoes_and_Mount_Semeru_%28background%29.jpg?width=1280'],
            ['destinations.borobudur',    'destinations', 'Gambar Candi Borobudur (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Borobudur%2C_Java%2C_Indonesia%2C_20220817_1013_8739.jpg?width=1280'],
            ['destinations.bali',         'destinations', 'Gambar Bali (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Tanah-Lot_Bali_Indonesia_Pura-Tanah-Lot-01.jpg?width=1280'],
            ['destinations.yogyakarta',   'destinations', 'Gambar Yogyakarta (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Yogyakarta_Indonesia_Prambanan-temple-complex-02.jpg?width=1280'],
            ['destinations.bunaken',      'destinations', 'Gambar Bunaken (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Sunset_at_Bunaken_Island%2C_Sulawesi%2C_2016.jpg?width=1280'],
            ['destinations.lombok',       'destinations', 'Gambar Lombok (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Tanjung_Aan%2C_Lombok.jpg?width=1280'],
            ['destinations.toba',         'destinations', 'Gambar Danau Toba (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Panorama_view_Lake_Toba%2C_North_Sumatra%2C_Indonesia.jpg?width=1280'],
            ['destinations.belitung',     'destinations', 'Gambar Belitung (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Pantai_Tanjung_Tinggi.jpg?width=1280'],
            ['destinations.padang',       'destinations', 'Gambar Padang (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Jam_Gadang%2C_Bukittinggi%2C_2016-02-12_01.jpg?width=1280'],
            ['destinations.banda',        'destinations', 'Gambar Banda Neira (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Fort_Belgica_01.JPG?width=1280'],

            ['promises.title',       'promises', 'Judul bagian', 'Terbang dengan Percaya Diri'],
            ['promises.item1.icon',  'promises', 'Ikon 1 (Material Symbol)', 'payments'],
            ['promises.item1.title', 'promises', 'Judul keunggulan 1', 'Harga Terbaik'],
            ['promises.item1.text',  'promises', 'Deskripsi keunggulan 1', 'Kami bekerja sama dengan maskapai utama seperti Garuda Indonesia dan Citilink untuk tarif termurah.'],
            ['promises.item2.icon',  'promises', 'Ikon 2 (Material Symbol)', 'support_agent'],
            ['promises.item2.title', 'promises', 'Judul keunggulan 2', 'Bantuan 24 Jam'],
            ['promises.item2.text',  'promises', 'Deskripsi keunggulan 2', 'Tim dukungan lokal kami siap membantu Anda kapan saja, di mana saja di seluruh wilayah Indonesia.'],
            ['promises.item3.icon',  'promises', 'Ikon 3 (Material Symbol)', 'speed'],
            ['promises.item3.title', 'promises', 'Judul keunggulan 3', 'Proses Cepat'],
            ['promises.item3.text',  'promises', 'Deskripsi keunggulan 3', 'Dapatkan tiket Batik Air atau Lion Air Anda dalam hitungan detik dengan sistem pemesanan kami.'],

            ['promos.title',         'promos', 'Judul bagian promo', 'DISKON S/D 50%'],
            ['promos.item1.image',     'promos', 'Gambar promo 1 (URL)', 'https://images.unsplash.com/photo-1584810359583-96fc3448beaa?auto=format&fit=crop&w=800&q=80'],
            ['promos.item1.badge',     'promos', 'Badge promo 1', 'Promo Spesial'],
            ['promos.item1.title',     'promos', 'Judul promo 1', 'Jakarta (CGK) ke Yogyakarta (YIA)'],
            ['promos.item1.discount',  'promos', 'Diskon promo 1', '50%'],
            ['promos.item1.price',     'promos', 'Harga promo 1', 'Rp 425.000'],
            ['promos.item1.button_text', 'promos', 'Teks tombol promo 1', 'Dapatkan Diskon'],
            ['promos.item2.image',     'promos', 'Gambar promo 2 (URL)', 'https://commons.wikimedia.org/wiki/Special:FilePath/Tanjung_Aan%2C_Lombok.jpg?width=1280'],
            ['promos.item2.badge',     'promos', 'Badge promo 2', 'Promo Spesial'],
            ['promos.item2.title',     'promos', 'Judul promo 2', 'Surabaya (SUB) ke Lombok (LOP)'],
            ['promos.item2.discount',  'promos', 'Diskon promo 2', '50%'],
            ['promos.item2.price',     'promos', 'Harga promo 2', 'Rp 360.000'],
            ['promos.item2.button_text', 'promos', 'Teks tombol promo 2', 'Dapatkan Diskon'],

            ['contact.tagline',  'contact', 'Tagline footer', 'Mendefinisikan ulang pengalaman perjalanan domestik melalui teknologi, keterjangkauan, dan layanan prima.'],
            ['contact.copyright', 'contact', 'Teks hak cipta footer', 'GoZay. Terbang Lebih Sering, Bayar Lebih Sedikit.'],
        ];

        foreach ($settings as [$key, $group, $label, $value]) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group, 'label' => $label]
            );
        }
    }
}