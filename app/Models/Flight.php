<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Flight (penerbangan). Berisi detail jadwal + harga base.
 * Banyak kursi dimiliki satu penerbangan.
 */
class Flight extends Model
{
    protected $fillable = [
        'airline_id',
        'origin_id',
        'destination_id',
        'flight_number',
        'departure_date',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'price',
        'seat_class',
        'seats_total',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'departure_date' => 'date',
            'departure_time' => 'datetime:H:i',
            'arrival_time' => 'datetime:H:i',
            'price' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi: maskapai penerbang.
     */
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    /**
     * Relasi: bandara asal.
     */
    public function origin()
    {
        return $this->belongsTo(Airport::class, 'origin_id');
    }

    /**
     * Relasi: bandara tujuan.
     */
    public function destination()
    {
        return $this->belongsTo(Airport::class, 'destination_id');
    }

    /**
     * Relasi: kursi-kursi penerbangan.
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Helper: jumlah kursi yang masih tersedia.
     */
    public function availableSeatsCount(): int
    {
        return $this->seats()->where('available', true)->count();
    }

    /**
     * Accessor: durasi format jam:menit.
     * Dihitung dari jam berangkat & tiba agar aman walau data duration_minutes
     * negatif atau penerbangan melewati tengah malam.
     */
    public function getDurationLabelAttribute(): string
    {
        $minutes = $this->duration_minutes;

        if ($this->departure_time && $this->arrival_time) {
            $dep = new \DateTime($this->departure_time->format('H:i'));
            $arr = new \DateTime($this->arrival_time->format('H:i'));
            $diff = $arr->getTimestamp() - $dep->getTimestamp();
            if ($diff < 0) {
                // Tiba keesokan hari (melewati tengah malam)
                $diff += 86400;
            }
            if ($diff > 0 && $diff < 86400) {
                $minutes = (int) round($diff / 60);
            }
        }

        if (!is_numeric($minutes) || $minutes <= 0) {
            $minutes = 60;
        }

        $h = intdiv($minutes, 60);
        $m = $minutes % 60;

        return "{$h}j {$m}m";
    }

    /**
     * Accessor: label kelas penerbangan dalam bahasa Indonesia.
     */
    public function getSeatClassLabelAttribute(): string
    {
        return match ($this->seat_class) {
            'economy' => 'Ekonomi',
            'premium_economy' => 'Ekonomi Premium',
            'business' => 'Bisnis',
            'first' => 'Kelas Pertama',
            default => ucfirst(str_replace('_', ' ', (string) $this->seat_class)),
        };
    }
}