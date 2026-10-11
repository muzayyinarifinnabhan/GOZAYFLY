@extends('layouts.landing')

@section('title', 'GoZay - Pesan Tiket Pesawat Murah')

@section('content')

<!-- Hero Section -->
<section class="relative h-[870px] min-h-[700px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center transition-transform duration-[20s] hover:scale-110" data-gk-bg style="background-image: url('{{ $settings->get('hero.background_image', 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1600&q=80') }}')"></div>
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    <div class="relative z-10 w-full max-w-container-max px-margin-mobile md:px-margin-desktop text-center" data-sk-zone>
        <!-- Skeleton hero: background image shimmer + teks judul + grid form pencarian -->
        <div data-sk-skeleton aria-hidden="true" class="text-center">
            <div class="absolute inset-0 z-0" style="pointer-events:none">
                <div class="gk-skel gsk-banner w-full h-full" style="background-image:linear-gradient(90deg,#d1d5db 25%,#e5e7eb 50%,#d1d5db 75%);background-size:200% 100%;animation:gk-shimmer 1.8s ease-in-out infinite;"></div>
            </div>
            <div class="relative z-10">
                <x-skeleton-text :lines="3" :last-width="'38%'" class="max-w-3xl mx-auto mb-1" :line-class="'gsk-line-2xl'" />
                <div class="bg-white/90 rounded-[28px] sm:rounded-[32px] p-4 sm:p-8 max-w-5xl mx-auto mt-6 text-left shadow-2xl">
                    <div class="flex gap-6 border-b border-black/5 pb-3 mb-6">
                        <div class="gk-skel gsk-line" style="width:80px"></div>
                        <div class="gk-skel gsk-line" style="width:105px"></div>
                        <div class="gk-skel gsk-line" style="width:95px"></div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                        <!-- Tab skeleton -->
                        <div class="gk-skel gsk-line" style="width:70px;height:14px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-line" style="width:80px;height:14px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-line" style="width:75px;height:14px;margin-bottom:8px"></div>
                        <!-- Dari Field -->
                        <div class="gk-skel gsk-field" style="border-radius:16px;border:1px solid rgba(12,12,12,0.06);padding:16px">
                            <div class="gk-skel gsk-line-xs mb-2" style="width:45%;height:8px"></div>
                            <div class="flex items-center gap-2">
                                <div class="gk-skel gsk-icon" style="width:16px;height:16px;border-radius:4px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:60%;height:11px"></div>
                                <div class="gk-skel" style="width:12px;height:12px;border-radius:2px"></div>
                            </div>
                        </div>
                        <!-- Ke Field -->
                        <div class="gk-skel gsk-field" style="border-radius:16px;border:1px solid rgba(12,12,12,0.06);padding:16px">
                            <div class="gk-skel gsk-line-xs mb-2" style="width:45%;height:8px"></div>
                            <div class="flex items-center gap-2">
                                <div class="gk-skel gsk-icon" style="width:16px;height:16px;border-radius:4px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:60%;height:11px"></div>
                                <div class="gk-skel" style="width:12px;height:12px;border-radius:2px"></div>
                            </div>
                        </div>
                        <!-- Berangkat Field -->
                        <div class="gk-skel gsk-field" style="border-radius:16px;border:1px solid rgba(12,12,12,0.06);padding:16px">
                            <div class="gk-skel gsk-line-xs mb-2" style="width:45%;height:8px"></div>
                            <div class="flex items-center gap-2">
                                <div class="gk-skel gsk-icon" style="width:16px;height:16px;border-radius:4px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:60%;height:11px"></div>
                            </div>
                        </div>
                        <!-- Pulang Field -->
                        <div class="gk-skel gsk-field" style="border-radius:16px;border:1px solid rgba(12,12,12,0.06);padding:16px">
                            <div class="gk-skel gsk-line-xs mb-2" style="width:45%;height:8px"></div>
                            <div class="flex items-center gap-2">
                                <div class="gk-skel gsk-icon" style="width:16px;height:16px;border-radius:4px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:60%;height:11px"></div>
                            </div>
                        </div>
                        <!-- Penumpang Field -->
                        <div class="gk-skel gsk-field" style="border-radius:16px;border:1px solid rgba(12,12,12,0.06);padding:16px">
                            <div class="gk-skel gsk-line-xs mb-2" style="width:45%;height:8px"></div>
                            <div class="flex items-center gap-2">
                                <div class="gk-skel gsk-icon" style="width:16px;height:16px;border-radius:4px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:60%;height:11px"></div>
                                <div class="gk-skel" style="width:12px;height:12px;border-radius:2px"></div>
                            </div>
                        </div>
                        <!-- Kelas Field -->
                        <div class="gk-skel gsk-field" style="border-radius:16px;border:1px solid rgba(12,12,12,0.06);padding:16px">
                            <div class="gk-skel gsk-line-xs mb-2" style="width:45%;height:8px"></div>
                            <div class="flex items-center gap-2">
                                <div class="gk-skel gsk-icon" style="width:16px;height:16px;border-radius:4px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:60%;height:11px"></div>
                                <div class="gk-skel" style="width:12px;height:12px;border-radius:2px"></div>
                            </div>
                        </div>
                        <!-- Search Button -->
                        <div class="gk-skel gsk-btn" style="border-radius:16px;background:#fd6c00;height:54px;margin-top:24px"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Konten asli -->
        <div data-sk-content>
        <h1 class="font-display-lg text-display-lg text-white mb-6 drop-shadow-lg">
            {{ $settings->get('hero.headline_before', 'Temukan') }} <span class="text-secondary-fixed">{{ $settings->get('hero.highlight', 'Petualangan') }}</span> {{ $settings->get('hero.headline_after', 'Anda Berikutnya') }}
        </h1>
        <!-- Search Widget -->
        <div class="bg-white/90 backdrop-blur-md rounded-[28px] sm:rounded-[32px] p-4 sm:p-8 shadow-2xl max-w-5xl mx-auto border border-white/40 text-left">
            <form action="{{ route('search.results') }}" method="GET" id="search-form">
                @if ($errors->any())
                    <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600">
                        <span class="material-symbols-outlined text-[18px] align-middle mr-1">error</span>
                        @foreach ($errors->all() as $error)
                            <span class="block">{{ $error }}</span>
                        @endforeach
                    </div>
                @endif
                <!-- Search Tabs -->
                <div class="flex flex-wrap space-x-4 sm:space-x-6 mb-8 border-b border-outline-variant/30 pb-2">
                    <button type="button" data-trip="round" class="font-label-md text-label-md text-primary border-b-2 border-secondary-container pb-4 search-tab">Pulang Pergi</button>
                    <button type="button" data-trip="oneway" class="font-label-md text-label-md text-on-surface-variant hover:text-primary border-b-2 border-transparent pb-4 transition-colors search-tab">Sekali Jalan</button>
                    <button type="button" data-trip="multi" class="font-label-md text-label-md text-on-surface-variant hover:text-primary border-b-2 border-transparent pb-4 transition-colors search-tab">Multi-kota</button>
                </div>
                <!-- Search Fields (round trip / one way) -->
                <div id="route-single" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div class="relative group col-span-1">
                        <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Dari</label>
                        <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">flight_takeoff</span>
                            <select name="origin" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                <option value="">Kota Keberangkatan</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}" data-city="{{ $airport->city }}" @selected($airport->code === 'CGK')>{{ $airport->label }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                        </div>
                    </div>
                    <div class="relative group">
                        <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Ke</label>
                        <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">flight_land</span>
                            <select name="destination" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                <option value="">-- Kota Kedatangan --</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}" data-city="{{ $airport->city }}" @selected($airport->code === 'SUB')>{{ $airport->label }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                        </div>
                    </div>
                    <div class="relative group lg:col-span-1">
                        <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Berangkat</label>
                        <div class="flex items-center gap-3 bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors cursor-pointer mb-3" onclick="openDatePicker(this)">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 pointer-events-none">calendar_month</span>
                            <input id="date_to" name="date" type="date" min="{{ now()->format('Y-m-d') }}" value="{{ now()->addDay()->format('Y-m-d') }}" class="w-full min-w-0 border-none p-0 focus:ring-0 font-body-md text-body-md bg-transparent [&::-webkit-calendar-picker-indicator]:cursor-pointer"/>
                        </div>
                        <div id="return-row-wrap" class="relative">
                            <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Pulang</label>
                            <div id="return-row" class="flex items-center gap-3 bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors cursor-pointer" onclick="openDatePicker(this)">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 pointer-events-none">calendar_month</span>
                                <input id="date_back" name="return_date" type="date" min="{{ now()->addDay()->format('Y-m-d') }}" value="{{ now()->addDay(2)->format('Y-m-d') }}" class="w-full min-w-0 border-none p-0 focus:ring-0 font-body-md text-body-md bg-transparent [&::-webkit-calendar-picker-indicator]:cursor-pointer"/>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Penumpang</label>
                        <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">person</span>
                            <select name="passengers" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                @for ($i = 1; $i <= 9; $i++)
                                    <option value="{{ $i }}" @selected($i === 1)>{{ $i }} Penumpang</option>
                                @endfor
                            </select>
                            <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                        </div>
                    </div>
                    <div class="relative group">
                        <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Kelas</label>
                        <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">confirmation_number</span>
                            <select name="seat_class" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                <option value="economy">Ekonomi</option>
                                <option value="premium_economy">Ekonomi Premium</option>
                                <option value="business">Bisnis</option>
                                <option value="first">Kelas Pertama</option>
                            </select>
                            <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                        </div>
                    </div>
                    <div class="lg:col-span-1">
                        <button type="submit" class="w-full h-full bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 py-4">
                            <span class="material-symbols-outlined">search</span>
                            Cari
                        </button>
                    </div>
                </div>
                <!-- Search Fields (multi-city) -->
                <div id="route-multi" class="hidden">
                    <div id="multi-legs" class="space-y-4">
                        <div class="multi-leg relative pt-7 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <button type="button" class="remove-leg absolute top-0 right-0 z-10 flex items-center gap-1 font-label-sm text-label-sm text-error hover:text-red-700 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span> Hapus
                            </button>
                            <div class="relative group">
                                <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Dari</label>
                                <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                                    <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">flight_takeoff</span>
                                    <select name="leg_origin[]" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                        <option value="">Kota Keberangkatan</option>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->label }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                                </div>
                            </div>
                            <div class="relative group">
                                <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Ke</label>
                                <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                                    <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">flight_land</span>
                                    <select name="leg_destination[]" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                        <option value="">-- Kota Kedatangan --</option>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->label }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                                </div>
                            </div>
                            <div class="relative group">
                                <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Tanggal</label>
                                <div class="flex items-center gap-3 bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors cursor-pointer" onclick="openDatePicker(this)">
                                    <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 pointer-events-none">calendar_month</span>
                                    <input name="leg_date[]" type="date" min="{{ now()->format('Y-m-d') }}" value="{{ now()->addDay()->format('Y-m-d') }}" class="w-full min-w-0 border-none p-0 focus:ring-0 font-body-md text-body-md bg-transparent [&::-webkit-calendar-picker-indicator]:cursor-pointer"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-leg" class="mt-4 font-label-md text-label-md text-primary flex items-center gap-1 hover:gap-2 transition-all">
                        <span class="material-symbols-outlined text-[20px]">add_circle</span> Tambah Rute
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                        <div class="relative group">
                            <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Penumpang</label>
                            <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">person</span>
                                <select name="passengers" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}" @selected($i === 1)>{{ $i }} Penumpang</option>
                                    @endfor
                                </select>
                                <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                            </div>
                        </div>
                        <div class="relative group">
                            <label class="absolute -top-3 left-4 bg-white px-1 font-label-sm text-label-sm text-outline z-10">Kelas</label>
                            <div class="flex items-center bg-white border border-outline-variant rounded-2xl px-4 py-4 focus-within:border-primary transition-colors relative">
                                <span class="material-symbols-outlined text-outline group-focus-within:text-primary shrink-0 mr-2">confirmation_number</span>
                                <select name="seat_class" style="appearance:none;-moz-appearance:none;-webkit-appearance:none;background-image:none!important;" class="w-full min-w-0 pr-6 bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md leading-6 truncate">
                                    <option value="economy">Ekonomi</option>
                                    <option value="premium_economy">Ekonomi Premium</option>
                                    <option value="business">Bisnis</option>
                                    <option value="first">Kelas Pertama</option>
                                </select>
                                <span class="material-symbols-outlined text-outline shrink-0 pointer-events-none">arrow_drop_down</span>
                            </div>
                        </div>
                        <div class="md:col-span-1">
                            <button type="submit" class="w-full bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 py-4">
                                <span class="material-symbols-outlined">search</span>
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>

<!-- Section 2: Destinasi Populer -->
<section class="py-stack-lg px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto" id="destinasi">
    <div class="flex flex-col md:flex-row justify-between items-end mb-stack-md gap-4">
        <div>
            <span class="font-label-md text-label-md text-secondary tracking-widest uppercase mb-2 block">{{ $settings->get('destinations.eyebrow', 'Inspirasi') }}</span>
            <h2 class="font-headline-lg text-headline-lg text-primary">{{ $settings->get('destinations.title', 'Destinasi Populer') }}</h2>
        </div>
        <a class="font-label-md text-label-md text-primary flex items-center gap-1 hover:gap-2 transition-all" href="{{ route('destinations.index') }}">
            Lihat semua destinasi <span class="material-symbols-outlined">chevron_right</span>
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter-desktop" data-sk-zone data-sk-content>
        <div data-sk-skeleton aria-hidden="true" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter-desktop">
            @for($i = 0; $i < 4; $i++)
                <x-skeleton-card :ratio="'h-64 w-full'" :lines="3" :footer="true" />
            @endfor
        </div>
        @foreach ($destinations as $index => $dest)
            <div class="group relative bg-surface-container-lowest rounded-[24px] overflow-hidden shadow-md transition-transform duration-300 hover:-translate-y-2 border border-outline-variant/10">
                <div class="h-64 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $dest->image ?? 'https://images.unsplash.com/photo-1502920514313-52581002a659?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $dest->city }}"/>
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full font-label-sm text-label-sm text-primary">
                        {{ $airlines->get($index % max(1, $airlines->count()))->name ?? 'GoZay' }}
                    </span>
                </div>
                <div class="p-6">
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">{{ $dest->city }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-4">Mulai dari Rp {{ number_format(rand(350000, 4500000), 0, ',', '.') }}</p>
                    <a href="{{ route('search.results') }}" class="w-full inline-block text-center py-3 bg-primary/5 hover:bg-primary hover:text-white transition-all text-primary font-label-md text-label-md rounded-xl">Pesan Sekarang</a>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Section 3: Penawaran Eksklusif -->
<section class="py-stack-lg bg-surface-container" id="promo">
@if ($promoFlights->isNotEmpty())
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-stack-md">Penawaran Eksklusif</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter-desktop" data-sk-zone data-sk-content>
            <div data-sk-skeleton aria-hidden="true" class="grid grid-cols-1 md:grid-cols-2 gap-gutter-desktop">
                @for($i = 0; $i < 2; $i++)
                    <x-skeleton-card :ratio="'h-64 md:h-80 w-full'" :lines="2" />
                @endfor
            </div>
            @foreach ($promoFlights->take(2) as $flight)
                <div class="relative rounded-[32px] overflow-hidden group h-64 md:h-80 shadow-lg hover:shadow-xl transition-all">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" data-gk-bg style="background-image: url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=80')"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute top-6 left-6 bg-secondary-container text-on-secondary px-4 py-1.5 rounded-full font-label-md text-label-md shadow-lg z-20 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">auto_awesome</span> Promo Spesial
                    </div>
                    <div class="relative z-10 p-10 flex flex-col justify-end h-full">
                        <h3 class="font-display-lg text-[24px] md:text-[32px] text-white mb-2 leading-tight drop-shadow-md">{{ $flight->origin->city }} ({{ $flight->origin->code }}) ke {{ $flight->destination->city }} ({{ $flight->destination->code }})</h3>
                        <p class="text-white/90 font-body-md mb-6">Mulai dari <span class="text-secondary-fixed font-bold">Rp {{ number_format($flight->price, 0, ',', '.') }}</span></p>
                        <a href="{{ route('flights.seats', $flight) }}" class="bg-white text-primary w-fit px-8 py-3 rounded-xl font-label-md text-label-md hover:bg-secondary-container hover:text-on-secondary transition-all shadow-md">Jelajahi Promo</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
</section>

<!-- Section 4: Janji GoZay -->
<section class="py-stack-lg px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center">
    <span class="font-label-md text-label-md text-secondary tracking-widest uppercase mb-4 block">Janji GoZay</span>
    <h2 class="font-headline-lg text-headline-lg text-primary mb-12">{{ $settings->get('promises.title', 'Terbang dengan Percaya Diri') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12" data-sk-zone data-sk-content>
        <div data-sk-skeleton aria-hidden="true" class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @for($i = 0; $i < 3; $i++)
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="gk-skel gsk-circle w-16 h-16"></div>
                    <div class="gk-skel gsk-line gsk-line-md" style="width:55%"></div>
                    <x-skeleton-text :lines="2" class="items-center" :last-width="'65%'" />
                </div>
            @endfor
        </div>
        @for ($i = 1; $i <= 3; $i++)
            <div class="p-8 rounded-[32px] hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-outline-variant/10">
                <div class="w-16 h-16 bg-primary/5 text-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-[32px]">{{ $settings->get("promises.item{$i}.icon", 'auto_awesome') }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary mb-4">{{ $settings->get("promises.item{$i}.title", '') }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">{{ $settings->get("promises.item{$i}.text", '') }}</p>
            </div>
        @endfor
    </div>
</section>

<!-- Section 5: Penawaran Terbatas -->
<section class="py-stack-lg bg-surface-container">
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-stack-md gap-4">
            <div>
                <span class="font-label-md text-label-md text-secondary tracking-widest uppercase mb-2 block">Penawaran Terbatas</span>
                <h2 class="font-headline-lg text-headline-lg text-primary">{{ $settings->get('promos.title', 'DISKON S/D 50%') }}</h2>
            </div>
            <a class="font-label-md text-label-md text-primary flex items-center gap-1 hover:gap-2 transition-all" href="#">
                Lihat semua promo <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter-desktop" data-sk-zone data-sk-content>
            <div data-sk-skeleton aria-hidden="true" class="grid grid-cols-1 md:grid-cols-2 gap-gutter-desktop">
                @for($i = 0; $i < 2; $i++)
                    <x-skeleton-card :ratio="'h-64 md:h-80 w-full'" :lines="2" />
                @endfor
            </div>
            @for ($i = 1; $i <= 2; $i++)
                @php
                    $promoImage = $settings->get("promos.item{$i}.image", 'https://images.unsplash.com/photo-1584810359583-96fc3448beaa?auto=format&fit=crop&w=800&q=80');
                    $promoBadge = $settings->get("promos.item{$i}.badge", 'Promo Spesial');
                    $promoTitle = $settings->get("promos.item{$i}.title", '');
                    $promoDiscount = $settings->get("promos.item{$i}.discount", '');
                    $promoPrice = $settings->get("promos.item{$i}.price", '');
                    $promoButton = $settings->get("promos.item{$i}.button_text", 'Dapatkan Diskon');
                @endphp
                <div class="relative rounded-[32px] overflow-hidden group h-64 md:h-80 shadow-lg hover:shadow-xl transition-all">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" data-gk-bg style="background-image: url('{{ $promoImage }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute top-6 left-6 bg-secondary-container text-on-secondary px-4 py-1.5 rounded-full font-label-md text-label-md shadow-lg z-20 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">auto_awesome</span> {{ $promoBadge }}
                    </div>
                    <div class="relative z-10 p-10 flex flex-col justify-end h-full">
                        <h3 class="font-display-lg text-[24px] md:text-[32px] text-white mb-2 leading-tight drop-shadow-md">{{ $promoTitle }}</h3>
                        <p class="text-white/90 font-body-md mb-6">Diskon <span class="text-secondary-fixed font-bold">{{ $promoDiscount }}</span> - Mulai dari <span class="text-secondary-fixed font-bold">{{ $promoPrice }}</span></p>
                        <a href="{{ route('search.results') }}" class="bg-white text-primary w-fit px-8 py-3 rounded-xl font-label-md text-label-md hover:bg-secondary-container hover:text-on-secondary transition-all shadow-md">{{ $promoButton }}</a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

@endsection