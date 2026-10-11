<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * SearchController: pencarian penerbangan dari form landing & halaman cari.
 */
class SearchController extends Controller
{
    /**
     * Tampilkan form pencarian & riwayat pencarian terakhir.
     */
    public function index(Request $request): View
    {
        $airports = Airport::where('is_active', true)->orderBy('city')->get();

        return view('search.index', compact('airports'));
    }

    /**
     * Proses pencarian penerbangan (filter by rute + tanggal + kelas).
     * Mendukung sekali jalan (1 leg) & pulang-pergi (2 leg) & multi-kota.
     * Jika tidak ada parameter pencarian, tampilkan penerbangan default
     * supaya halaman /penerbangan tetap berisi saat dibuka dari menu.
     */
    public function results(Request $request): View
    {
        // Deteksi mode dengan tegas: form landing mengirim leg_origin[] kosong
        // (opsi placeholder ter-pilih) walau pengguna memakai mode sekali jalan/pulang-pergi.
        $hasSingle = $request->filled('origin') && $request->filled('destination');
        $legOrigins = collect((array) $request->input('leg_origin', []))
            ->filter(fn ($v) => $v !== null && $v !== '');
        $hasMulti = $legOrigins->isNotEmpty();

        $validated = $request->validate([
            'origin' => ['nullable', 'exists:airports,id'],
            'destination' => ['nullable', 'exists:airports,id', 'different:origin', function ($attribute, $value, $fail) use ($request) {
                if (!$value) {
                    return;
                }
                $origin = Airport::find($request->input('origin'));
                $dest = Airport::find($value);
                if ($origin && $dest && $origin->city === $dest->city) {
                    $fail('Kota asal dan kota tujuan tidak boleh sama.');
                }
            }],
            'date' => ['nullable', 'date', 'after_or_equal:today'],
            'return_date' => ['nullable', 'date', 'after_or_equal:date'],
            'leg_origin' => ['nullable', 'array'],
            'leg_origin.*' => ['nullable', 'exists:airports,id'],
            'leg_destination' => ['nullable', 'array'],
            'leg_destination.*' => ['nullable', 'exists:airports,id', function ($attribute, $value, $fail) use ($request) {
                if (!$value) {
                    return;
                }
                $index = explode('.', $attribute)[1] ?? 0;
                $origin = Airport::find($request->input('leg_origin')[$index] ?? null);
                $dest = Airport::find($value);
                if ($origin && $dest && $origin->city === $dest->city) {
                    $fail('Kota asal dan kota tujuan tidak boleh sama.');
                }
            }],
            'leg_date' => ['nullable', 'array'],
            'leg_date.*' => ['nullable', 'date', 'after_or_equal:today'],
            'passengers' => ['nullable', 'integer', 'min:1', 'max:9'],
            'seat_class' => ['nullable', 'string'],
        ]);

        $passCount = $validated['passengers'] ?? 1;
        $seatClass = $validated['seat_class'] ?? 'economy';

        $legs = [];
        if ($hasMulti && !$hasSingle) {
            foreach ($legOrigins as $i => $originId) {
                $legs[] = [
                    'kind' => 'multi',
                    'origin_id' => $originId,
                    'destination_id' => $validated['leg_destination'][$i] ?? null,
                    'date' => $validated['leg_date'][$i] ?? null,
                ];
            }
        } elseif ($hasSingle) {
            $legs[] = [
                'kind' => 'outbound',
                'origin_id' => $validated['origin'],
                'destination_id' => $validated['destination'],
                'date' => $validated['date'] ?? now()->addDay()->format('Y-m-d'),
            ];
            // Pulang-pergi: tambahkan leg kepulangan rute terbalik
            if (!empty($validated['return_date'])) {
                $legs[] = [
                    'kind' => 'return',
                    'origin_id' => $validated['destination'],
                    'destination_id' => $validated['origin'],
                    'date' => $validated['return_date'],
                ];
            }
        } else {
            // Klik langsung menu "Penerbangan" tanpa pencarian:
            // tampilkan SEMUA penerbangan aktif (bukan rute default).
            $legs[] = [
                'kind' => 'all',
                'origin_id' => null,
                'destination_id' => null,
                'date' => null,
            ];
        }

        $resultLegs = [];
        foreach ($legs as $i => $leg) {
            if ($leg['kind'] === 'all') {
                $flights = Flight::with(['airline', 'origin', 'destination'])
                    ->withCount([
                        'seats',
                        'seats as available_seats_count' => fn ($q) => $q->where('available', true),
                    ])
                    ->where('is_active', true)
                    ->orderBy('departure_date')
                    ->orderBy('departure_time')
                    ->get()
                    ->each(fn ($f) => $f->setAttribute('segment_date', null));

                $resultLegs[] = [
                    'index' => $i,
                    'kind' => 'all',
                    'title' => 'Semua Penerbangan',
                    'origin' => null,
                    'destination' => null,
                    'date' => null,
                    'flights' => $flights,
                ];
                continue;
            }

            $query = Flight::with(['airline', 'origin', 'destination'])
                ->withCount([
                    'seats',
                    'seats as available_seats_count' => fn ($q) => $q->where('available', true),
                ])
                ->where('origin_id', $leg['origin_id'])
                ->where('destination_id', $leg['destination_id'])
                ->where('is_active', true);

            if (!empty($leg['date'])) {
                $query->where('departure_date', $leg['date']);
            }

            if ($request->filled('seat_class')) {
                $query->where('seat_class', $seatClass);
            }

            $flights = $query->orderBy('departure_time')
                ->get()
                ->each(fn ($f) => $f->setAttribute('segment_date', $leg['date']));

            $title = match ($leg['kind']) {
                'outbound' => 'Keberangkatan',
                'return' => 'Kepulangan',
                default => 'Rute ' . ($i + 1),
            };

            $resultLegs[] = [
                'index' => $i,
                'kind' => $leg['kind'],
                'title' => $title,
                'origin' => Airport::find($leg['origin_id'] ?? 0),
                'destination' => Airport::find($leg['destination_id'] ?? 0),
                'date' => $leg['date'],
                'flights' => $flights,
            ];
        }

        return view('search.results', [
            'legs' => $resultLegs,
            'passCount' => $passCount,
            'seatClass' => $seatClass,
        ]);
    }
}