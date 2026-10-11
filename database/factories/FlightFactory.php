<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    public function definition(): array
    {
        $airline = Airline::inRandomOrder()->first() ?? Airline::factory()->create();
        $origin = Airport::inRandomOrder()->first() ?? Airport::factory()->create();
        // Pastikan tujuan berbeda dari asal
        $destination = Airport::where('id', '!=', $origin->id)->inRandomOrder()->first()
            ?? Airport::factory()->create();
        $departure = fake()->dateTimeBetween('+1 day', '+14 days');

        return [
            'airline_id' => $airline->id,
            'origin_id' => $origin->id,
            'destination_id' => $destination->id,
            'flight_number' => $airline->code . '-' . fake()->numberBetween(100, 999),
            'departure_date' => $departure->format('Y-m-d'),
            'departure_time' => fake()->time('H:i'),
            'arrival_time' => fake()->time('H:i'),
            'duration_minutes' => fake()->numberBetween(60, 300),
            'price' => fake()->numberBetween(400000, 2500000),
            'seat_class' => fake()->randomElement(['economy', 'premium_economy', 'business', 'first']),
            'seats_total' => 36,
            'is_active' => true,
        ];
    }
}