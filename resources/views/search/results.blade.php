@extends('layouts.landing')

@section('title', ($legs[0]['kind'] ?? null) === 'all' ? 'Semua Penerbangan - GoZay' : 'Hasil Pencarian - ' . ($legs[0]['origin']->city ?? '?') . ' ke ' . ($legs[0]['destination']->city ?? '?'))

@php
    $firstLeg = $legs[0];
    $hasReturn = count($legs) > 1;
    $classLabels = ['economy' => 'Ekonomi', 'premium_economy' => 'Ekonomi Premium', 'business' => 'Bisnis', 'first' => 'Kelas Pertama'];
    $seatClassLabel = $classLabels[$seatClass] ?? ucfirst(str_replace('_', ' ', $seatClass));
    $totalFlights = collect($legs)->sum(fn ($leg) => $leg['flights']->count());
    $allEmpty = $totalFlights === 0;
    $allClassQuery = request()->query();
    unset($allClassQuery['seat_class']);
    $allClassQuery = http_build_query($allClassQuery);
@endphp

@section('content')
<div data-sk-zone>
<div data-sk-skeleton aria-hidden="true" class="space-y-6">
    <!-- Progress Bar Skeleton -->
    <section class="bg-surface-container-lowest py-8 shadow-sm">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="flex items-center justify-between max-w-3xl mx-auto">
                @for($i = 0; $i < 4; $i++)
                    <div class="flex flex-col items-center gap-2">
                        <div class="gk-skel gsk-circle" style="width:40px;height:40px"></div>
                        <div class="gk-skel gsk-line" style="width:50px;height:10px"></div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Search Summary Ribbon Skeleton -->
    <div class="bg-primary text-white py-4 mb-stack-md">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-6">
                <div class="flex flex-col">
                    <div class="gk-skel gsk-line" style="width:60px;height:10px"></div>
                    <div class="gk-skel gsk-line-lg" style="width:120px;height:24px;margin-top:4px"></div>
                </div>
            </div>
            <div class="flex items-center space-x-8">
                <div class="flex flex-col">
                    <div class="gk-skel gsk-line" style="width:50px;height:10px"></div>
                    <div class="gk-skel gsk-line-sm" style="width:80px;height:14px;margin-top:4px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row gap-gutter-desktop pb-stack-lg">
        <!-- Filter Sidebar Skeleton -->
        <aside class="w-full md:w-72 flex-shrink-0">
            <div class="gk-skel gsk-filter-sidebar">
                <div class="gk-skel gsk-line" style="width:80px;height:18px;margin-bottom:24px"></div>
                <div class="gk-skel gsk-filter-item">
                    <div class="gk-skel gsk-filter-title"></div>
                    <div class="gk-skel gsk-filter-option"></div>
                    <div class="gk-skel gsk-filter-option"></div>
                    <div class="gk-skel gsk-filter-option"></div>
                </div>
                <div class="gk-skel gsk-filter-item">
                    <div class="gk-skel gsk-filter-title"></div>
                    <div class="gk-skel gsk-filter-range"></div>
                </div>
                <div class="gk-skel gsk-filter-item">
                    <div class="gk-skel gsk-filter-title"></div>
                    <div class="gk-skel gsk-filter-option"></div>
                    <div class="gk-skel gsk-filter-option"></div>
                    <div class="gk-skel gsk-filter-option"></div>
                </div>
                <div class="gk-skel gsk-filter-item">
                    <div class="gk-skel gsk-filter-title"></div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="gk-skel gsk-filter-option"></div>
                        <div class="gk-skel gsk-filter-option"></div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Results List Skeleton -->
        <div class="flex-grow space-y-stack-md">
            <!-- Sort Bar Skeleton -->
            <div class="flex items-center justify-between mb-4 px-2">
                <div class="gk-skel gsk-line" style="width:160px;height:14px"></div>
                <div class="flex items-center space-x-4">
                    <div class="gk-skel gsk-line" style="width:100px;height:14px"></div>
                    <div class="gk-skel gsk-line" style="width:80px;height:32px;border-radius:8px"></div>
                </div>
            </div>

            <!-- Flight Cards Skeleton -->
            @for($i = 0; $i < 3; $i++)
                <div class="gk-skel gsk-flight-card">
                    <div class="gsk-flight-header">
                        <div class="gk-skel gsk-flight-airline"></div>
                        <div class="gsk-flight-info">
                            <div class="gk-skel gsk-flight-time"></div>
                            <div class="gk-skel gsk-flight-route"></div>
                        </div>
                        <div class="gk-skel gsk-flight-price"></div>
                    </div>
                    <div class="flex-grow flex items-center justify-between w-full">
                        <div class="text-center">
                            <div class="gk-skel gsk-line-lg" style="width:60px;height:24px"></div>
                            <div class="gk-skel gsk-line-sm" style="width:80px;height:12px;margin-top:4px"></div>
                        </div>
                        <div class="flex-grow flex flex-col items-center px-8">
                            <div class="gk-skel gsk-line-sm" style="width:80px;height:14px"></div>
                            <div class="gk-skel gsk-line" style="width:2px;height:20px;margin-top:4px"></div>
                        </div>
                        <div class="text-center">
                            <div class="gk-skel gsk-line-lg" style="width:60px;height:24px"></div>
                            <div class="gk-skel gsk-line-sm" style="width:80px;height:12px;margin-top:4px"></div>
                        </div>
                    </div>
                    <div class="gk-skel gsk-flight-features">
                        <div class="gk-skel gsk-flight-feature"></div>
                        <div class="gk-skel gsk-flight-feature"></div>
                        <div class="gk-skel gsk-flight-feature"></div>
                    </div>
                    <div class="gk-skel gsk-flight-footer">
                        <div>
                            <div class="gk-skel gsk-line-xs" style="width:80px;height:10px"></div>
                            <div class="gk-skel gsk-line-lg" style="width:60px;height:20px;margin-top:4px"></div>
                        </div>
                        <div class="gk-skel gsk-btn" style="width:80px;height:40px"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

<div data-sk-content>
<!-- Progress Bar Section -->
<section class="bg-surface-container-lowest py-8 shadow-sm">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center justify-between max-w-3xl mx-auto">
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center mb-2 shadow-lg ring-4 ring-primary/10">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <span class="font-label-sm text-label-sm text-primary font-bold">Cari</span>
            </div>
            <div class="flex-grow h-[2px] bg-primary mx-4 mb-6"></div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-secondary-container text-white flex items-center justify-center mb-2 shadow-lg scale-110">
                    <span class="material-symbols-outlined text-[20px]">airplane_ticket</span>
                </div>
                <span class="font-label-sm text-label-sm text-secondary font-bold">Pilih</span>
            </div>
            <div class="flex-grow h-[2px] bg-outline-variant/30 mx-4 mb-6"></div>
            <div class="flex flex-col items-center opacity-50">
                <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center mb-2">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Bayar</span>
            </div>
            <div class="flex-grow h-[2px] bg-outline-variant/30 mx-4 mb-6"></div>
            <div class="flex flex-col items-center opacity-50">
                <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center mb-2">
                    <span class="material-symbols-outlined text-[20px]">done_all</span>
                </div>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Selesai</span>
            </div>
        </div>
    </div>
</section>

<!-- Search Summary Ribbon -->
<div class="bg-primary text-white py-4 mb-stack-md">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-wrap items-center justify-between gap-4">
        @if ($firstLeg['kind'] === 'all')
        <div class="flex items-center space-x-6">
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70 uppercase tracking-widest">Rute</span>
                <span class="font-headline-md text-headline-md">Semua Penerbangan</span>
            </div>
        </div>
        <div class="h-8 w-[1px] bg-white/20 hidden md:block"></div>
        <div class="flex items-center space-x-8">
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70">Jadwal</span>
                <span class="font-body-md text-body-md font-semibold">Semua rute &amp; tanggal aktif</span>
            </div>
            <a href="{{ route('search.results') }}" class="bg-secondary-container hover:bg-secondary text-white px-6 py-2 rounded-xl transition-all font-label-md text-label-md">Cari</a>
        </div>
        @else
        <div class="flex items-center space-x-6">
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70 uppercase tracking-widest">Dari</span>
                <span class="font-headline-md text-headline-md">{{ $firstLeg['origin']->label ?? 'Pilih dari' }}</span>
            </div>
            <span class="material-symbols-outlined text-secondary-fixed rotate-90 md:rotate-0">sync_alt</span>
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70 uppercase tracking-widest">Ke</span>
                <span class="font-headline-md text-headline-md">{{ $firstLeg['destination']->label ?? 'Pilih tujuan' }}</span>
            </div>
        </div>
        <div class="h-8 w-[1px] bg-white/20 hidden md:block"></div>
        <div class="flex items-center space-x-8">
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70">Keberangkatan</span>
                <span class="font-body-md text-body-md font-semibold">{{ \Carbon\Carbon::parse($firstLeg['date'])->translatedFormat('j M Y') }}</span>
            </div>
            @if ($hasReturn)
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70">Kepulangan</span>
                <span class="font-body-md text-body-md font-semibold">{{ \Carbon\Carbon::parse($legs[1]['date'])->translatedFormat('j M Y') }}</span>
            </div>
            @endif
            <div class="flex flex-col">
                <span class="font-label-sm text-white/70">Penumpang</span>
                <span class="font-body-md text-body-md font-semibold">{{ $passCount }} Dewasa, {{ $seatClassLabel }}</span>
            </div>
            <a href="{{ route('search.results') }}" class="bg-secondary-container hover:bg-secondary text-white px-6 py-2 rounded-xl transition-all font-label-md text-label-md">Ubah</a>
        </div>
        @endif
    </div>
</div>

@if ($allEmpty)
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16 text-center">
        <span class="material-symbols-outlined text-6xl text-outline">flight</span>
        <h2 class="font-headline-lg text-headline-lg text-primary mt-4">Tidak ada penerbangan ditemukan</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Maaf, tidak ada penerbangan <strong>{{ $firstLeg['origin']->city ?? '?' }} &rarr; {{ $firstLeg['destination']->city ?? '?' }}</strong> pada <strong>{{ \Carbon\Carbon::parse($firstLeg['date'])->translatedFormat('j M Y') }}</strong>@if ($hasReturn) atau kepulangan <strong>{{ \Carbon\Carbon::parse($legs[1]['date'])->translatedFormat('j M Y') }}</strong>@endif dengan kelas <strong>{{ $seatClassLabel }}</strong> untuk <strong>{{ $passCount }} penumpang</strong>.</p>
        @if ($allClassQuery)
            <a href="{{ route('search.results') }}?{{ $allClassQuery }}" class="inline-block mt-4 bg-primary text-white font-headline-md text-headline-md rounded-2xl px-8 py-3 hover:bg-primary-container transition-all shadow-lg">Lihat Semua Kelas</a>
        @endif
        <a href="{{ route('search.results') }}" class="inline-block mt-6 bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl px-8 py-3 hover:bg-secondary transition-all shadow-lg">Cari Jadwal Lain</a>
    </div>
@else
<!-- Leg Switcher (Perjalanan Pergi/Pulang) -->
@if (count($legs) > 1)
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-4">
    <div class="flex flex-wrap gap-3" role="tablist">
        @foreach ($legs as $leg)
            <button type="button" class="leg-tab flex items-center gap-3 px-5 py-3 rounded-2xl border font-label-md text-label-md transition-all @if ($loop->first) border-secondary-container bg-secondary-container/10 text-primary shadow-sm @else border-outline-variant text-on-surface-variant hover:border-primary @endif"
                    data-leg="{{ $leg['index'] }}">
                <span class="material-symbols-outlined @if ($loop->first) text-secondary-container @else text-outline @endif">flight</span>
                <span class="flex flex-col text-left">
                    <span class="font-bold">{{ $leg['title'] }}</span>
                    <span class="font-label-sm text-label-sm opacity-80">{{ $leg['origin']->city ?? '?' }} &rarr; {{ $leg['destination']->city ?? '?' }} &bull; {{ \Carbon\Carbon::parse($leg['date'])->translatedFormat('j M') }}</span>
                </span>
                <span class="h-5 w-px bg-outline-variant/40 mx-1"></span>
                <span class="leg-count font-bold {{ $loop->first ? 'text-secondary-container' : 'text-primary' }}">{{ $leg['flights']->count() }}</span>
            </button>
        @endforeach
    </div>
</div>
@endif

@foreach ($legs as $leg)
    @php
        $legFlights = $leg['flights'];
        $legAirlines = $legFlights->pluck('airline')->filter()->unique('id');
        $legMin = $legFlights->min('price');
        $legMax = max(100000, $legFlights->max('price'));
    @endphp
    <div class="leg-pane {{ $loop->first ? '' : 'hidden' }}" data-leg="{{ $leg['index'] }}">
        @if ($legFlights->isEmpty())
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 text-center">
                <span class="material-symbols-outlined text-5xl text-outline">flight</span>
                <h2 class="font-headline-md text-headline-md text-primary mt-4">Tidak ada penerbangan {{ mb_strtolower($leg['title']) }}</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2">Tidak ada penerbangan {{ mb_strtolower($leg['title']) }} {{ $leg['origin']->city ?? '' }} &rarr; {{ $leg['destination']->city ?? '' }} pada {{ \Carbon\Carbon::parse($leg['date'])->translatedFormat('j M Y') }} dengan kelas {{ $seatClassLabel }}.</p>
                <a href="{{ route('search.results') }}" class="inline-block mt-6 bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl px-8 py-3 hover:bg-secondary transition-all shadow-lg">Cari Jadwal Lain</a>
            </div>
        @else
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row gap-gutter-desktop pb-stack-lg">
            <!-- Sidebar Filters -->
            <aside class="w-full md:w-72 flex-shrink-0">
                <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-28 border border-outline-variant/20 max-h-[calc(100vh-8rem)] overflow-y-auto overscroll-contain">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-headline-md text-headline-md text-primary">Filter</h2>
                        <button type="button" class="reset-filters text-secondary font-label-md text-label-md hover:underline">Atur Ulang</button>
                    </div>
                    <div class="mb-8">
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-4">Rentang Harga</label>
                        <input class="price-filter w-full accent-secondary h-1.5 bg-surface-variant rounded-lg appearance-none cursor-pointer" type="range" min="0" max="{{ $legMax }}" step="25000" value="{{ $legMax }}"/>
                        <div class="flex justify-between mt-2 font-label-sm text-label-sm text-outline">
                            <span>Rp 0</span>
                            <span class="price-max-label">Rp {{ number_format($legMax, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="mb-8">
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-4">Maskapai</label>
                        <div class="space-y-3">
                            @forelse ($legAirlines as $airline)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input checked class="filter-airline w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary" type="checkbox" data-airline="{{ $airline->id }}" onchange="applyFilters()"/>
                                    <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">{{ $airline->name }}</span>
                                </label>
                            @empty
                                <span class="font-body-md text-body-md text-outline">Belum ada maskapai.</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="mb-8">
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-4">Pemberhentian</label>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="filter-stops px-4 py-2 rounded-full border border-primary bg-primary/5 text-primary font-label-md text-label-md" data-stops="0">Langsung</button>
                            <button type="button" class="filter-stops px-4 py-2 rounded-full border border-outline-variant text-on-surface-variant font-label-md text-label-md" data-stops="1">1 Transit</button>
                            <button type="button" class="filter-stops px-4 py-2 rounded-full border border-outline-variant text-on-surface-variant font-label-md text-label-md" data-stops="2">2+ Transit</button>
                        </div>
                    </div>
                    <div>
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-4">Waktu Keberangkatan</label>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" class="filter-time flex flex-col items-center p-3 rounded-xl border border-outline-variant hover:border-primary transition-all" data-time="morning">
                                <span class="material-symbols-outlined text-outline">light_mode</span>
                                <span class="font-label-sm text-label-sm mt-1">Pagi</span>
                            </button>
                            <button type="button" class="filter-time flex flex-col items-center p-3 rounded-xl border border-outline-variant hover:border-primary transition-all" data-time="afternoon">
                                <span class="material-symbols-outlined text-outline">wb_sunny</span>
                                <span class="font-label-sm text-label-sm mt-1">Siang</span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Results List -->
            <div class="flex-grow space-y-stack-md">
                <!-- Sort Bar -->
                <div class="flex items-center justify-between mb-4 px-2">
                    <span class="font-body-md text-body-md text-on-surface-variant">Menampilkan <span class="font-bold text-primary">{{ $legFlights->count() }} penerbangan</span>@if ($leg['destination']) ke {{ $leg['destination']->city }}@endif</span>
                    <div class="flex items-center space-x-4">
                        <span class="font-label-md text-label-md text-outline">Urutkan:</span>
                        <select class="sort-select bg-transparent border-none font-label-md text-label-md text-primary font-bold focus:ring-0 cursor-pointer">
                            <option value="price">Termurah</option>
                            <option value="duration">Tercepat</option>
                            <option value="best">Pengalaman Terbaik</option>
                        </select>
                    </div>
                </div>

                <!-- Flight Cards -->
                <div class="flight-list space-y-stack-md">
                    @foreach ($legFlights as $flight)
                        <div class="flight-card bg-white rounded-3xl p-6 shadow-md hover:shadow-xl border border-outline-variant/10 hover:border-primary/30 transition-all group overflow-hidden relative"
                             data-price="{{ $flight->price }}"
                             data-duration="{{ $flight->duration_minutes }}"
                             data-departure="{{ $flight->departure_time?->format('H:i') }}"
                             data-airline="{{ $flight->airline_id }}">
                            <div class="absolute top-0 left-0 w-1.5 h-full bg-secondary-container opacity-0 group-hover:opacity-100 transition-all"></div>
                            @if ($flight->price === $legMin && $flight->price > 0)
                                <div class="absolute top-0 right-10 bg-secondary-container text-white px-4 py-1 rounded-b-xl font-label-sm text-label-sm font-bold flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">stars</span> TERMURAH
                                </div>
                            @endif
                            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12 @if ($flight->price === $legMin && $flight->price > 0) pt-2 @endif">
                                <div class="flex items-center space-x-4 w-full lg:w-48">
                                    <div class="w-12 h-12 bg-surface-container rounded-xl flex items-center justify-center overflow-hidden">
                                        @if ($flight->airline && $flight->airline->logo)
                                            <img class="w-8 h-8 object-contain" src="{{ asset('storage/' . $flight->airline->logo) }}" alt="{{ $flight->airline->name }}"/>
                                        @else
                                            <span class="material-symbols-outlined text-primary">flight</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-headline-md text-headline-md font-bold text-primary leading-tight">{{ $flight->airline->name }}</h3>
                                        <p class="font-label-sm text-label-sm text-outline">{{ $flight->flight_number }} &bull; {{ $flight->seat_class_label }}</p>
                                    </div>
                                </div>
                                <div class="flex-grow flex items-center justify-between w-full">
                                    <div class="text-center lg:text-left">
                                        <p class="font-headline-md text-headline-md font-bold text-on-surface leading-none">{{ $flight->departure_time->format('H:i') }}</p>
                                        <p class="font-label-md text-label-md text-outline">{{ $flight->origin->code }} &bull; {{ $flight->origin->city }}</p>
                                    </div>
                                    <div class="flex-grow flex flex-col items-center px-8 relative">
                                        <span class="font-label-sm text-label-sm text-secondary font-semibold mb-2">{{ $flight->duration_label }}</span>
                                        <div class="w-full h-[2px] bg-outline-variant/30 relative">
                                            <div class="absolute -top-1.5 left-1/2 -translate-x-1/2">
                                                <span class="material-symbols-outlined text-primary text-lg rotate-90">flight</span>
                                            </div>
                                            <div class="absolute top-1/2 left-0 w-2 h-2 rounded-full bg-outline-variant -translate-y-1/2"></div>
                                            <div class="absolute top-1/2 right-0 w-2 h-2 rounded-full bg-outline-variant -translate-y-1/2"></div>
                                        </div>
                                        <span class="font-label-sm text-label-sm text-outline mt-2">Langsung</span>
                                    </div>
                                    <div class="text-center lg:text-right">
                                        <p class="font-headline-md text-headline-md font-bold text-on-surface leading-none">{{ $flight->arrival_time->format('H:i') }}</p>
                                        <p class="font-label-md text-label-md text-outline">{{ $flight->destination->code }} &bull; {{ $flight->destination->city }}</p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-48 flex lg:flex-col items-center lg:items-end justify-between border-t lg:border-t-0 lg:border-l border-outline-variant/20 pt-4 lg:pt-0 lg:pl-8 gap-4">
                                    <div class="text-right">
                                        <span class="font-label-sm text-label-sm text-outline block">Mulai dari</span>
                                        <p class="font-headline-md text-headline-md text-primary">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
                                    </div>
                                    <a href="{{ route('flights.seats', $flight) }}" class="bg-primary text-white px-8 py-3 rounded-2xl font-label-md text-label-md font-bold hover:bg-primary-container hover:scale-105 active:scale-95 transition-all shadow-md shadow-primary/20">Pilih</a>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t border-dashed border-outline-variant/30 flex flex-wrap gap-4">
                                <span class="flex items-center text-label-sm text-on-surface-variant bg-surface-container-low px-3 py-1 rounded-full"><span class="material-symbols-outlined text-sm mr-1">airplane_ticket</span>
                                    @if (($flight->available_seats_count ?? $flight->seats_count) > 0)
                                        <strong class="text-primary">{{ $flight->seats_total }}</strong>&nbsp;tiket &middot; <strong class="text-primary">{{ $flight->available_seats_count ?? 0 }}</strong>&nbsp;tersedia
                                    @else
                                        Kursi Habis
                                    @endif
                                </span>
                                <span class="flex items-center text-label-sm text-on-surface-variant bg-surface-container-low px-3 py-1 rounded-full"><span class="material-symbols-outlined text-sm mr-1">wifi</span> Wi-Fi Gratis</span>
                                <span class="flex items-center text-label-sm text-on-surface-variant bg-surface-container-low px-3 py-1 rounded-full"><span class="material-symbols-outlined text-sm mr-1">restaurant</span> Makan</span>
                                <span class="flex items-center text-label-sm text-on-surface-variant bg-surface-container-low px-3 py-1 rounded-full"><span class="material-symbols-outlined text-sm mr-1">luggage</span> Bagasi 20kg</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="location.href='{{ route('search.results') }}'" class="w-full py-6 border-2 border-dashed border-outline-variant/50 rounded-3xl text-outline font-bold hover:border-primary hover:text-primary transition-all flex items-center justify-center gap-2 group">
                    <span class="material-symbols-outlined group-hover:rotate-180 transition-transform duration-500">expand_more</span> Tampilkan lebih banyak penerbangan
                </button>
            </div>
        </div>
        @endif
    </div>
@endforeach
@endif

<!-- Interactive Search FAB (Mobile Only) -->
<a href="{{ route('search.results') }}" class="md:hidden fixed bottom-6 right-6 w-14 h-14 rounded-full bg-secondary-container text-white shadow-2xl flex items-center justify-center z-50 animate-bounce active:scale-95 transition-transform">
    <span class="material-symbols-outlined">search</span>
</a>
</div>
</div>
@endsection

@push('scripts')
<script>
    function activePane() {
        return document.querySelector('.leg-pane:not(.hidden)') || document.querySelector('.leg-pane');
    }

    function updatePriceLabels(pane) {
        const slider = pane.querySelector('.price-filter');
        if (!slider) return;
        pane.querySelector('.price-max-label').textContent = 'Rp ' + Number(slider.value).toLocaleString('id-ID');
    }

    function applyFilters() {
        const pane = activePane();
        const slider = pane?.querySelector('.price-filter');
        if (!pane || !slider) return;
        const maxPrice = Number(pane.querySelector('.price-filter').value);
        const checkedAirlines = Array.from(pane.querySelectorAll('.filter-airline')).filter(c => c.checked).map(c => c.getAttribute('data-airline'));
        const activeDay = pane.querySelector('.filter-time.border-primary')?.getAttribute('data-time');
        const cards = pane.querySelectorAll('.flight-card');
        let visible = 0;
        cards.forEach(card => {
            const price = Number(card.getAttribute('data-price'));
            const airline = card.getAttribute('data-airline');
            const hour = Number(card.getAttribute('data-departure')?.split(':')[0] || 0);
            let show = price <= maxPrice && checkedAirlines.includes(airline);
            if (show && activeDay === 'morning' && hour >= 12) show = false;
            if (show && activeDay === 'afternoon' && hour < 12) show = false;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        pane.querySelector('.flight-list').dataset.visible = visible;
    }

    function sortPane(pane, key) {
        const list = pane.querySelector('.flight-list');
        if (!list) return;
        const cards = Array.from(list.querySelectorAll('.flight-card'));
        cards.sort((a, b) => {
            if (key === 'price') return Number(a.getAttribute('data-price')) - Number(b.getAttribute('data-price'));
            if (key === 'duration') return Number(a.getAttribute('data-duration')) - Number(b.getAttribute('data-duration'));
            return (a.getAttribute('data-departure') || '').localeCompare(b.getAttribute('data-departure') || '');
        });
        cards.forEach(card => list.appendChild(card));
    }

    document.querySelectorAll('.leg-pane').forEach(pane => {
        const slider = pane.querySelector('.price-filter');
        if (slider) {
            slider.addEventListener('input', () => { updatePriceLabels(pane); applyFilters(); });
            updatePriceLabels(pane);
        }
        const sortSelect = pane.querySelector('.sort-select');
        if (sortSelect) sortSelect.addEventListener('change', (e) => sortPane(pane, e.target.value));
        const resetBtn = pane.querySelector('.reset-filters');
        if (resetBtn) resetBtn.addEventListener('click', () => {
            pane.querySelectorAll('.filter-airline').forEach(c => { c.checked = true; });
            const s = pane.querySelector('.price-filter');
            if (s) {
                s.value = s.max = Math.max(100000, Number(s.getAttribute('max')));
                updatePriceLabels(pane);
            }
            pane.querySelectorAll('.filter-stops').forEach((b, i) => {
                const on = i === 0;
                b.classList.toggle('border-primary', on);
                b.classList.toggle('bg-primary/5', on);
                b.classList.toggle('text-primary', on);
                b.classList.toggle('border-outline-variant', !on);
                b.classList.toggle('text-on-surface-variant', !on);
            });
            applyFilters();
        });
    });

    document.querySelectorAll('.filter-stops').forEach(btn => {
        btn.addEventListener('click', () => {
            const pane = btn.closest('.leg-pane');
            pane.querySelectorAll('.filter-stops').forEach(b => {
                b.classList.remove('border-primary', 'bg-primary/5', 'text-primary');
                b.classList.add('border-outline-variant', 'text-on-surface-variant');
            });
            btn.classList.add('border-primary', 'bg-primary/5', 'text-primary');
            btn.classList.remove('border-outline-variant', 'text-on-surface-variant');
        });
    });

    document.querySelectorAll('.filter-time').forEach(btn => {
        btn.addEventListener('click', () => {
            const pane = btn.closest('.leg-pane');
            pane.querySelectorAll('.filter-time').forEach(b => {
                b.classList.remove('border-primary', 'bg-primary/5');
                b.querySelector('.material-symbols-outlined')?.classList.add('text-outline');
                b.querySelector('.material-symbols-outlined')?.classList.remove('text-primary');
                b.querySelector('.font-label-sm')?.classList.remove('text-primary');
            });
            btn.classList.add('border-primary', 'bg-primary/5');
            btn.querySelector('.material-symbols-outlined')?.classList.remove('text-outline');
            btn.querySelector('.material-symbols-outlined')?.classList.add('text-primary');
            btn.querySelector('.font-label-sm')?.classList.add('text-primary');
            applyFilters();
        });
    });

    document.querySelectorAll('.leg-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.leg-tab').forEach(t => {
                t.classList.remove('border-secondary-container', 'bg-secondary-container/10', 'text-primary', 'shadow-sm');
                t.classList.add('border-outline-variant', 'text-on-surface-variant', 'hover:border-primary');
                t.querySelector('.material-symbols-outlined')?.classList.replace('text-secondary-container', 'text-outline');
                t.querySelector('.leg-count')?.classList.replace('text-secondary-container', 'text-primary');
            });
            tab.classList.add('border-secondary-container', 'bg-secondary-container/10', 'text-primary', 'shadow-sm');
            tab.classList.remove('border-outline-variant', 'text-on-surface-variant', 'hover:border-primary');
            tab.querySelector('.material-symbols-outlined')?.classList.replace('text-outline', 'text-secondary-container');
            tab.querySelector('.leg-count')?.classList.replace('text-primary', 'text-secondary-container');
            const idx = tab.getAttribute('data-leg');
            document.querySelectorAll('.leg-pane').forEach(p => {
                p.classList.toggle('hidden', p.getAttribute('data-leg') !== idx);
            });
            applyFilters();
        });
    });

    document.querySelectorAll('.flight-card').forEach(card => {
        card.addEventListener('mouseenter', () => { card.style.transform = 'translateY(-4px)'; });
        card.addEventListener('mouseleave', () => { card.style.transform = 'translateY(0)'; });
    });

    applyFilters();
</script>
@endpush