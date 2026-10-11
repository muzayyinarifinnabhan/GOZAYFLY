<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validasi data penerbangan (jadwal).
 */
class FlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'airline_id' => ['required', 'exists:airlines,id'],
            'origin_id' => ['required', 'exists:airports,id', 'different:destination_id'],
            'destination_id' => ['required', 'exists:airports,id', 'different:origin_id'],
            'flight_number' => ['required', 'string', 'max:10'],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'departure_time' => ['required', 'date_format:H:i'],
            'arrival_time' => ['required', 'date_format:H:i', 'after:departure_time'],
            'duration_minutes' => ['required', 'integer', 'min:30', 'max:1440'],
            'price' => ['required', 'integer', 'min:100000'],
            'seat_class' => ['required', 'string', Rule::in(['economy', 'premium_economy', 'business', 'first'])],
            'seats_total' => ['required', 'integer', 'min:1', 'max:400'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'origin_id.different' => 'Bandara asal dan tujuan tidak boleh sama.',
            'destination_id.different' => 'Bandara asal dan tujuan tidak boleh sama.',
            'arrival_time.after' => 'Jam tiba harus setelah jam berangkat.',
            'price.min' => 'Harga minimal 100.000.',
            'seat_class.in' => 'Kelas penerbangan tidak valid.',
        ];
    }
}