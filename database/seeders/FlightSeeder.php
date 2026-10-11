<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeder penerbangan - buat beberapa jadwal + generate kursi otomatis.
 * Kursi layout: 40 baris x 5 kolom (A1..E40), total 200 kursi (50 per kelas).
 */
class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $airlines = Airline::all();
        $airports = Airport::all();

        // Pastikan data referensi ada
        if ($airlines->isEmpty() || $airports->isEmpty()) {
            $this->command?->warn('Seeder butuh maskapai & bandara. Jalankan AirlineSeeder & AirportSeeder dahulu.');
            return;
        }

        $routes = [
            ['CGK', 'DPS'], ['CGK', 'SUB'], ['CGK', 'JOG'], ['CGK', 'KNO'],
            ['DPS', 'CGK'], ['SUB', 'CGK'], ['JOG', 'CGK'], ['KNO', 'CGK'],
            ['CGK', 'UPG'], ['UPG', 'CGK'], ['SUB', 'DPS'], ['DPS', 'SUB'],
            ['MDC', 'PNK'], ['PNK', 'MDC'], ['CGK', 'PDG'], ['PDG', 'CGK'],
        ];

        // Beberapa tanggal ke depan agar penumpang bisa mencari
        foreach (range(0, 14) as $offset) {
            foreach ($routes as $route) {
                // Setiap tanggal: 2-3 jadwal per rute
                $count = rand(2, 3);
                for ($i = 0; $i < $count; $i++) {
                    $this->createFlightWithSeats($airlines, $airports, $route, $offset);
                }
            }
        }
    }

    /**
     * Membuat satu penerbangan + semua kursinya.
     */
    private function createFlightWithSeats($airlines, $airports, array $route, int $offset): void
    {
        $origin = $airports->firstWhere('code', $route[0]);
        $destination = $airports->firstWhere('code', $route[1]);
        if (!$origin || !$destination) {
            return;
        }

        $airline = $airlines->random();
        $departureTime = Carbon::createFromTime(rand(5, 23), rand(0, 59));
        $duration = rand(60, 240);
        $arrivalTime = $departureTime->copy()->addMinutes($duration);

        $seatClass = collect(['economy', 'premium_economy', 'business', 'first'])->random();

        $flight = Flight::create([
            'airline_id' => $airline->id,
            'origin_id' => $origin->id,
            'destination_id' => $destination->id,
            'flight_number' => $airline->code . '-' . Str::upper(rand(100, 999)),
            'departure_date' => now()->addDays($offset)->format('Y-m-d'),
            'departure_time' => $departureTime->format('H:i'),
            'arrival_time' => $arrivalTime->format('H:i'),
            'duration_minutes' => $arrivalTime->diffInMinutes($departureTime),
            'price' => rand(450000, 2600000),
            'seat_class' => $seatClass,
            'seats_total' => 200,
        ]);

        $this->generateSeats($flight, $seatClass);
    }

    /**
     * Generate 200 kursi layout 40x5 (A1..E40):
     * 50 kursi per kelas -> First (baris 1-10), Bisnis (11-20),
     * Ekonomi Premium (21-30), Ekonomi (31-40).
     */
    private function generateSeats(Flight $flight, string $flightClass): void
    {
        $cols = ['A', 'B', 'C', 'D', 'E'];
        $classPlan = [
            1 => ['class' => 'first', 'surcharge' => 500000],
            2 => ['class' => 'business', 'surcharge' => 250000],
            3 => ['class' => 'premium_economy', 'surcharge' => 150000],
            4 => ['class' => 'economy', 'surcharge' => 0],
        ];

        foreach (range(1, 40) as $row) {
            $plan = $classPlan[intdiv($row - 1, 10) + 1];

            foreach ($cols as $col) {
                $flight->seats()->create([
                    'seat_number' => $col . $row,
                    'seat_row' => (string) $row,
                    'seat_col' => $col,
                    'class' => $plan['class'],
                    'price' => $flight->price + $plan['surcharge'],
                    'available' => true,
                ]);
            }
        }
    }
}