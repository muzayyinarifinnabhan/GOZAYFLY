@extends('layouts.landing-orange')

@section('title', 'Destinasi - GoZay')

@push('styles')
<style>
    html{scroll-behavior:smooth}
    body{background:#fffaf8}
    ::selection{background:#ff7000;color:#fff}
    .glass{background:rgba(255,255,255,.82);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px)}
    .hero-title{font-size:clamp(2.2rem,5vw,4.2rem);line-height:1.04;letter-spacing:-.045em}
    .hero-copy{max-width:720px}
    .destination-card{position:relative;isolation:isolate}
    .destination-card::after{content:"";position:absolute;inset:0;border-radius:1rem;pointer-events:none;box-shadow:inset 0 0 0 1px rgba(255,255,255,.7);opacity:.7}
    .destination-card .card-image{transition:transform .7s cubic-bezier(.2,.7,.2,1),filter .5s ease}
    .destination-card:hover .card-image{transform:scale(1.07);filter:saturate(1.08)}
    .destination-card:hover{transform:translateY(-6px)}
    .shine{position:relative;overflow:hidden}
    .shine::before{content:"";position:absolute;top:0;left:-120%;width:70%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.22),transparent);transform:skewX(-18deg);transition:left .8s ease;z-index:2;pointer-events:none}
    .shine:hover::before{left:150%}
    .filter-box{transition:transform .2s ease,box-shadow .2s ease,background .2s ease}
    .filter-box:focus-within{transform:translateY(-1px);box-shadow:0 12px 30px rgba(158,67,0,.12)}
    .section-kicker{letter-spacing:.14em}
    .stat-pill{box-shadow:0 8px 24px rgba(0,0,0,.08)}
    .fade-up{animation:fadeUp .65s ease both}
    .delay-1{animation-delay:.08s}.delay-2{animation-delay:.16s}.delay-3{animation-delay:.24s}.delay-4{animation-delay:.32s}
    @keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
    @media(max-width:767px){
        header .h-20{height:68px}
        main.pt-20{padding-top:68px}
        .hero-title{font-size:2.35rem}
    }
    @media(prefers-reduced-motion:reduce){
        *,*::before,*::after{scroll-behavior:auto!important;animation:none!important;transition:none!important}
    }
    #destSearchForm > .filter-box > label {
        letter-spacing: .02em;
    }
    #destSearchForm select {
        min-width: 0;
    }
    @media (max-width: 767px) {
        #destSearchForm > .filter-box > label {
            margin-bottom: 6px;
        }
    }
</style>
@endpush

@section('content')
<div data-sk-zone>
<div data-sk-skeleton aria-hidden="true" class="space-y-6">
    <!-- Hero Skeleton -->
    <div class="relative w-full overflow-hidden bg-inverse-surface -mt-20">
        <div class="absolute inset-0 z-0">
            <div class="gk-skel gsk-banner" style="width:100%;height:500px"></div>
        </div>
        <section class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-28 md:pt-36 pb-10 md:pb-12 w-full">
            <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-10 w-full">
                <div class="gk-skel gsk-badge" style="width:120px;height:36px;margin-bottom:16px"></div>
                <div class="gk-skel gsk-line-2xl" style="width:80%;height:48px;margin-bottom:16px"></div>
                <div class="gk-skel gsk-line-lg" style="width:55%;height:32px;margin-bottom:20px"></div>
                <div class="gk-skel gsk-line-xs" style="width:46%;height:14px;margin-bottom:8px"></div>
                <div class="gk-skel gsk-line-xs" style="width:32%;height:14px"></div>
            </div>
            <div class="gk-skel" style="background:rgba(255,255,255,.82);border:1px solid rgba(255,255,255,.7);border-radius:16px;padding:16px;box-shadow:0 20px 60px rgba(0,0,0,.18)">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5">
                        <div class="gk-skel gsk-line-xs" style="width:80px;height:12px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-form-field" style="height:58px"></div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="gk-skel gsk-line-xs" style="width:60px;height:12px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-form-field" style="height:58px"></div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="gk-skel gsk-line-xs" style="width:60px;height:12px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-form-field" style="height:58px"></div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="gk-skel gsk-line-xs" style="width:60px;height:12px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-form-field" style="height:58px"></div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="gk-skel gsk-form-field" style="height:58px"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Quick Filter Skeleton -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-6 pb-2 w-full">
        <div class="gk-skel" style="background:#fffaf8;padding:16px 24px;border-radius:16px;border:1px solid rgba(0,0,0,.05);display:flex;align-items:center;justify-content:space-between">
            <div class="gk-skel gsk-line" style="width:120px;height:14px"></div>
            <div class="gk-skel gsk-line" style="width:80px;height:14px"></div>
        </div>
    </section>

    <!-- Featured Cards Skeleton -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-8 w-full">
        <div class="gk-skel gsk-section-header">
            <div class="gk-skel gsk-line-xs" style="width:100px;height:14px"></div>
            <div class="gk-skel gsk-line-xl" style="width:250px;height:32px"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @for($i = 0; $i < 4; $i++)
                <div class="gk-skel" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 8px 28px rgba(12,12,12,.06)">
                    <div class="gk-skel" style="height:256px;width:100%"></div>
                    <div style="padding:20px;display:flex;flex-direction:column;gap:12px">
                        <div class="gk-skel gsk-line" style="width:50%;height:16px"></div>
                        <div class="gk-skel gsk-line" style="width:75%;height:20px"></div>
                        <div class="gk-skel gsk-line" style="width:50%;height:16px"></div>
                        <div class="gk-skel gsk-btn" style="width:100%;height:40px"></div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- Catalog Grid Skeleton -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 w-full">
        <div class="gk-skel gsk-section-header">
            <div class="gk-skel gsk-line-xl" style="width:200px;height:32px;margin-bottom:8px"></div>
            <div class="gk-skel gsk-line-sm" style="width:200px;height:16px"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @for($i = 0; $i < 8; $i++)
                <div class="gk-skel" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 8px 28px rgba(12,12,12,.06)">
                    <div class="gk-skel" style="height:192px;width:100%"></div>
                    <div style="padding:20px;display:flex;flex-direction:column;gap:12px">
                        <div class="gk-skel gsk-line" style="width:66%;height:16px"></div>
                        <div class="gk-skel gsk-line" style="width:80%;height:20px"></div>
                        <div class="gk-skel gsk-line" style="width:50%;height:16px"></div>
                        <div class="gk-skel gsk-btn" style="width:100%;height:36px"></div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
</div>

<div data-sk-content>
<div class="flex flex-col w-full">

    <!-- Top Ambient Glow -->
    <div class="relative w-full overflow-hidden bg-inverse-surface -mt-20">
        <div class="absolute inset-0 z-0">
            <img alt="Panorama Lanskap Indonesia" class="w-full h-full object-cover object-center"
                 src="{{ $settings->get('destinations.hero_image', 'https://commons.wikimedia.org/wiki/Special:FilePath/Piaynemo%2C_Raja_Ampat_%2845710648355%29.jpg?width=1280') }}"/>
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/70"></div>
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[350px] bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <section class="relative z-10 data-sk-zone data-sk-content max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-28 md:pt-36 pb-10 md:pb-12 w-full">
            <div class="data-sk-skeleton flex flex-col items-center" aria-hidden="true">
                <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-10 w-full">
                    <div class="gzy-sk-block h-7 w-56 rounded-full mb-4"></div>
                    <div class="gzy-sk-block h-12 md:h-14 w-[80%] rounded-2xl mb-3"></div>
                    <div class="gzy-sk-block h-12 md:h-14 w-[55%] rounded-2xl mb-5"></div>
                    <div class="gzy-sk-block h-3 w-[46%] rounded-full mb-2"></div>
                    <div class="gzy-sk-block h-3 w-[32%] rounded-full"></div>
                </div>
                <div class="w-full bg-white/85 border border-white/70 rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.18)] p-3 md:p-5">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-5">
                            <div class="gzy-sk-block h-3 w-28 rounded-full mb-2"></div>
                            <div class="gzy-sk-block h-[58px] rounded-xl"></div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="gzy-sk-block h-3 w-20 rounded-full mb-2"></div>
                            <div class="gzy-sk-block h-[58px] rounded-xl"></div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="gzy-sk-block h-3 w-20 rounded-full mb-2"></div>
                            <div class="gzy-sk-block h-[58px] rounded-xl"></div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="gzy-sk-block h-3 w-20 rounded-full mb-2"></div>
                            <div class="gzy-sk-block h-[58px] rounded-xl"></div>
                        </div>
                        <div class="md:col-span-1">
                            <div class="gzy-sk-block h-[58px] rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-container text-on-primary font-label-sm text-label-sm mb-4 shadow-md backdrop-blur-md">
                    <span class="material-symbols-outlined text-sm">explore</span>
                    <span class="">Eksplorasi Keajaiban Nusantara</span>
                </div>
                <h1 class="hero-title font-display-lg text-white font-extrabold mb-5 drop-shadow-lg fade-up">Jelajahi Semua Destinasi Terbaik Indonesia</h1>
                <p class="hero-copy font-body-lg text-body-md md:text-body-lg text-neutral-200 leading-relaxed drop-shadow fade-up delay-1">Temukan keindahan nusantara dari Sabang sampai Merauke dengan penerbangan langsung dan harga terbaik bersama GoZay.</p>
            </div>

            <div class="glass rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.18)] p-3 md:p-5 transition-all border border-white/70 fade-up delay-2">
                <form class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end" id="destSearchForm" onsubmit="event.preventDefault();">

                    <div class="md:col-span-5 filter-box">
                        <label for="destInput" class="block mb-2 px-1 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold">
                            Cari Destinasi
                        </label>
                        <div class="flex items-center gap-3 bg-surface-container-low px-4 py-3.5 rounded-xl focus-within:bg-surface-bright focus-within:shadow-[0_0_0_2px_#ff7000] transition-all min-h-[58px]">
                            <span class="material-symbols-outlined text-primary-container text-2xl">search</span>
                            <input class="bg-transparent text-on-surface font-body-md text-body-md focus:outline-none w-full placeholder:text-outline"
                                   id="destInput" placeholder="Cari nama kota, pulau, atau bandara..." type="text">
                        </div>
                    </div>

                    <div class="md:col-span-2 filter-box">
                        <label for="regionSelect" class="block mb-2 px-1 font-label-sm text-label-sm text-on-surface-variant font-semibold">
                            Wilayah
                        </label>
                        <div class="flex items-center gap-2 bg-surface-container-low px-3 py-3.5 rounded-xl hover:bg-surface-container transition-colors min-h-[58px]">
                            <span class="material-symbols-outlined text-primary-container text-xl">map</span>
                            <select class="bg-transparent font-label-md text-label-md text-on-surface font-semibold focus:outline-none cursor-pointer w-full"
                                    id="regionSelect">
                                <option value="all">Semua Wilayah</option>
                                <option value="jawa-bali">Jawa &amp; Bali</option>
                                <option value="sumatra">Sumatra</option>
                                <option value="nusa-tenggara">Nusa Tenggara</option>
                                <option value="sulawesi">Sulawesi</option>
                                <option value="maluku-papua">Maluku &amp; Papua</option>
                                <option value="kalimantan">Kalimantan</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-2 filter-box">
                        <label for="typeSelect" class="block mb-2 px-1 font-label-sm text-label-sm text-on-surface-variant font-semibold">
                            Tipe Wisata
                        </label>
                        <div class="flex items-center gap-2 bg-surface-container-low px-3 py-3.5 rounded-xl hover:bg-surface-container transition-colors min-h-[58px]">
                            <span class="material-symbols-outlined text-primary text-xl">category</span>
                            <select class="bg-transparent font-label-md text-label-md text-on-surface font-semibold focus:outline-none cursor-pointer w-full"
                                    id="typeSelect">
                                <option value="all">Semua Wisata</option>
                                <option value="pantai">Pantai &amp; Bahari</option>
                                <option value="budaya">Budaya &amp; Sejarah</option>
                                <option value="gunung">Gunung &amp; Alam</option>
                                <option value="kuliner">Kuliner</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-2 filter-box">
                        <label for="sortSelect" class="block mb-2 px-1 font-label-sm text-label-sm text-on-surface-variant font-semibold">
                            Urutkan
                        </label>
                        <div class="flex items-center gap-2 bg-surface-container-low px-3 py-3.5 rounded-xl hover:bg-surface-container transition-colors min-h-[58px]">
                            <span class="material-symbols-outlined text-tertiary text-xl">sort</span>
                            <select class="bg-transparent font-label-md text-label-md text-on-surface font-semibold focus:outline-none cursor-pointer w-full"
                                    id="sortSelect">
                                <option value="cheap">Harga Termurah</option>
                                <option value="populer">Paling Populer</option>
                                <option value="promo">Promo Spesial</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-1 flex items-end justify-center">
                        <button aria-label="Cari Penerbangan"
                                class="w-full h-[58px] rounded-xl bg-primary-container text-on-primary flex items-center justify-center font-label-md text-label-md hover:bg-primary transition-all duration-200 shadow-md hover:-translate-y-0.5"
                                type="button">
                            <span class="material-symbols-outlined text-2xl">arrow_forward</span>
                        </button>
                    </div>

                </form>
            </div>
        </section>
    </div>

    <!-- Quick Filter -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-6 pb-2 w-full">
        <div class="flex flex-wrap items-center justify-between gap-4 bg-surface-container-lowest p-4 px-6 rounded-xl border border-surface-container shadow-sm">
            <div class="flex items-center gap-3 flex-wrap">
                <div class="flex items-center gap-1.5 text-on-surface-variant font-label-md text-label-md">
                    <span class="material-symbols-outlined text-primary text-lg">tune</span>
                    <span class="font-semibold text-on-surface">Filter Cepat:</span>
                </div>
                <div class="relative">
                    <select class="bg-surface-container px-3.5 py-2 rounded-lg font-label-md text-label-md text-on-surface font-medium border-0 focus:outline-none focus:ring-2 focus:ring-primary-container cursor-pointer pr-8 appearance-none shadow-sm" id="quickFilterSelect">
                        <option value="all">Semua Destinasi</option>
                        <option value="pantai">Pantai Tropis</option>
                        <option value="budaya">Wisata Budaya</option>
                        <option value="alam">Petualangan Alam</option>
                        <option value="promo">Promo Terheboh</option>
                        <option value="baru">Rute Baru</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-on-surface-variant">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-sm text-primary">verified</span>
                <span class="">Koleksi destinasi resmi terkurasi GoZay</span>
            </div>
        </div>
    </section>

    <!-- Section: Destinasi Pilihan Utama / Favorit Wisatawan (Bento Grid) -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-8 w-full">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary-container text-xl" style="font-variation-settings: &quot;FILL&quot; 1;">star</span>
                    <span class="font-label-md text-label-md text-primary font-bold uppercase tracking-wider">Favorit Wisatawan</span>
                </div>
                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface font-bold tracking-tight">
                    Destinasi Pilihan Utama Indonesia
                </h2>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                Jelajahi surga terpopuler dengan penawaran paket penerbangan GoZay bergaransi kursi terbaik dan fleksibilitas jadwal.
            </p>
        </div>

        <!-- 4 Featured Destination Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative gzy-cards-target">
            <div class="gzy-sk-overlay grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" aria-hidden="true">
                @for($sk = 0; $sk < 4; $sk++)
                <div class="gzy-sk-card rounded-2xl overflow-hidden">
                    <div class="gzy-sk-block h-64 w-full"></div>
                    <div class="p-5 space-y-3">
                        <div class="gzy-sk-block h-3 w-1/2 rounded-full"></div>
                        <div class="gzy-sk-block h-5 w-3/4 rounded-full"></div>
                        <div class="gzy-sk-block h-4 w-1/2 rounded-full"></div>
                        <div class="gzy-sk-block h-10 w-full rounded-xl"></div>
                        <div class="gzy-sk-block h-3 w-2/3 rounded-full"></div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Card 1: Raja Ampat -->
            <div class="destination-card shine group flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_20px_45px_rgba(38,25,18,0.13)] transition-all duration-300">
                <div class="relative h-64 w-full overflow-hidden">
                    <img alt="Raja Ampat Papua Barat" class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $settings->get('destinations.raja_ampat', 'https://commons.wikimedia.org/wiki/Special:FilePath/Piaynemo%2C_Raja_Ampat_%2831683906917%29.jpg?width=1280') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-primary-container text-on-primary font-label-sm text-label-sm font-bold shadow-md">
                                Promo 20%
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-surface/90 text-on-surface backdrop-blur-md font-label-sm text-label-sm font-semibold">
                                SOQ
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-xs uppercase tracking-wider font-semibold text-primary-fixed">Papua Barat</span>
                            <h3 class="font-headline-md text-headline-md font-bold text-white leading-tight">Raja Ampat</h3>
                            <p class="font-label-sm text-label-sm text-neutral-200 mt-0.5 truncate">Surga Bawah Laut Dunia</p>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between bg-surface-container-lowest">
                        <div class="flex items-center justify-between pb-4 border-b border-surface-container">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai Dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 4.500.000</span>
                            </div>
                            <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-base">flight_takeoff</span>
                                <span class="">4j 10m (CGK)</span>
                            </div>
                        </div>
                        <button class="mt-4 w-full py-2.5 px-4 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:-translate-y-0.5">
                            <span class="">Cari Penerbangan</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </div>
            </div>

            <!-- Card 2: Labuan Bajo -->
            <div class="destination-card shine group flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_20px_45px_rgba(38,25,18,0.13)] transition-all duration-300">
                <div class="relative h-64 w-full overflow-hidden">
                    <img alt="Labuan Bajo NTT Phinisi Sunset" class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $settings->get('destinations.labuan_bajo', 'https://commons.wikimedia.org/wiki/Special:FilePath/Pink_Beach%2C_Padar_Island%2C_Komodo_National_Park.jpg?width=1280') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-primary text-on-primary font-label-sm text-label-sm font-bold shadow-md">
                                Populer
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-surface/90 text-on-surface backdrop-blur-md font-label-sm text-label-sm font-semibold">
                                LBJ
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-xs uppercase tracking-wider font-semibold text-primary-fixed">Nusa Tenggara Timur</span>
                            <h3 class="font-headline-md text-headline-md font-bold text-white leading-tight">Labuan Bajo</h3>
                            <p class="font-label-sm text-label-sm text-neutral-200 mt-0.5 truncate">Habitat Komodo &amp; Pulau Padar</p>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between bg-surface-container-lowest">
                        <div class="flex items-center justify-between pb-4 border-b border-surface-container">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai Dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 1.500.000</span>
                            </div>
                            <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-base">flight_takeoff</span>
                                <span class="">2j 25m (CGK)</span>
                            </div>
                        </div>
                        <button class="mt-4 w-full py-2.5 px-4 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:-translate-y-0.5">
                            <span class="">Cari Penerbangan</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </div>
            </div>

            <!-- Card 3: Gunung Bromo -->
            <div class="destination-card shine group flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_20px_45px_rgba(38,25,18,0.13)] transition-all duration-300">
                <div class="relative h-64 w-full overflow-hidden">
                    <img alt="Gunung Bromo Jawa Timur Sunrise" class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $settings->get('destinations.bromo', 'https://commons.wikimedia.org/wiki/Special:FilePath/Mount_Bromo_at_sunrise%2C_showing_its_volcanoes_and_Mount_Semeru_%28background%29.jpg?width=1280') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm font-bold shadow-md">
                                Best Deal
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-surface/90 text-on-surface backdrop-blur-md font-label-sm text-label-sm font-semibold">
                                MLG / SUB
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-xs uppercase tracking-wider font-semibold text-primary-fixed">Jawa Timur</span>
                            <h3 class="font-headline-md text-headline-md font-bold text-white leading-tight">Gunung Bromo</h3>
                            <p class="font-label-sm text-label-sm text-neutral-200 mt-0.5 truncate">Pesona Lautan Pasir &amp; Sunrise</p>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between bg-surface-container-lowest">
                        <div class="flex items-center justify-between pb-4 border-b border-surface-container">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai Dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 850.000</span>
                            </div>
                            <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-base">flight_takeoff</span>
                                <span class="">1j 30m (CGK)</span>
                            </div>
                        </div>
                        <button class="mt-4 w-full py-2.5 px-4 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:-translate-y-0.5">
                            <span class="">Cari Penerbangan</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </div>
            </div>

            <!-- Card 4: Candi Borobudur -->
            <div class="destination-card shine group flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_20px_45px_rgba(38,25,18,0.13)] transition-all duration-300">
                <div class="relative h-64 w-full overflow-hidden">
                    <img alt="Candi Borobudur Magelang" class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $settings->get('destinations.borobudur', 'https://commons.wikimedia.org/wiki/Special:FilePath/Borobudur%2C_Java%2C_Indonesia%2C_20220817_1013_8739.jpg?width=1280') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-tertiary text-on-tertiary font-label-sm text-label-sm font-bold shadow-md">
                                Budaya
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-surface/90 text-on-surface backdrop-blur-md font-label-sm text-label-sm font-semibold">
                                YIA / JOG
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-xs uppercase tracking-wider font-semibold text-primary-fixed">Jawa Tengah</span>
                            <h3 class="font-headline-md text-headline-md font-bold text-white leading-tight">Borobudur</h3>
                            <p class="font-label-sm text-label-sm text-neutral-200 mt-0.5 truncate">Kemegahan Warisan Budaya Dunia</p>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between bg-surface-container-lowest">
                        <div class="flex items-center justify-between pb-4 border-b border-surface-container">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai Dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 650.000</span>
                            </div>
                            <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-base">flight_takeoff</span>
                                <span class="">1j 10m (CGK)</span>
                            </div>
                        </div>
                        <button class="mt-4 w-full py-2.5 px-4 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:-translate-y-0.5">
                            <span class="">Cari Penerbangan</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </div>
            </div>

            </div>

        </div>
    </section>

    <!-- Section: Katalog Lengkap Destinasi Indonesia (Grid 8 Destinasi Populer) -->
    <section id="catalogSection" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 w-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-8 border-b border-surface-container-high">
            <div>
                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface font-bold tracking-tight">
                    Katalog Destinasi Nusantara
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                    Menampilkan <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed font-bold">{{ 12 + $destinations->count() }} destinasi aktif</span> dengan koneksi langsung GoZay
                </p>
            </div>
            <div class="flex items-center gap-3 mt-4 sm:mt-0">
                <span class="font-label-sm text-label-sm text-on-surface-variant">Tampilan:</span>
                <button aria-label="Grid view" class="p-2 rounded-lg bg-surface-container text-primary flex items-center">
                    <span class="material-symbols-outlined text-xl">grid_view</span>
                </button>
                <button aria-label="List view" class="p-2 rounded-lg bg-surface-container-low text-on-surface-variant hover:text-on-surface flex items-center">
                    <span class="material-symbols-outlined text-xl">view_list</span>
                </button>
            </div>
        </div>

        <!-- 8 Destination Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative gzy-cards-target">
            <div class="gzy-sk-overlay grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" aria-hidden="true">
                @for($skn = 0; $skn < 8; $skn++)
                <div class="gzy-sk-card rounded-2xl overflow-hidden">
                    <div class="gzy-sk-block h-48 w-full"></div>
                    <div class="p-5 space-y-3">
                        <div class="gzy-sk-block h-3 w-2/3 rounded-full"></div>
                        <div class="gzy-sk-block h-5 w-4/5 rounded-full"></div>
                        <div class="gzy-sk-block h-3 w-1/2 rounded-full"></div>
                        <div class="gzy-sk-block h-9 w-full rounded-xl"></div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Item 1: Bali (DPS) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Exotic Balinese temple overlooking the ocean during a golden sunset with traditional tiered Meru shrines and tranquil turquoise waters in Bali Indonesia, captured in warm orange and aero blue lighting." src="{{ $settings->get('destinations.bali', 'https://commons.wikimedia.org/wiki/Special:FilePath/Tanah-Lot_Bali_Indonesia_Pura-Tanah-Lot-01.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">DPS</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Pantai &amp; Seni
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Denpasar, Bali</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 1j 50m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Pulau Dewata Bali
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Penerbangan harian frekuensi tinggi ke pusat surfing, pantai eksotis, dan budaya luhur.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 820.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 2: Yogyakarta (YIA) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Prambanan temple complex in Yogyakarta Java during morning mist with towering stone towers, manicured green lawns, and warm sunrise glow with an atmospheric orange hue." src="{{ $settings->get('destinations.yogyakarta', 'https://commons.wikimedia.org/wiki/Special:FilePath/Yogyakarta_Indonesia_Prambanan-temple-complex-02.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">YIA</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Budaya &amp; Kuliner
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Kulon Progo, DIY</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 1j 15m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Yogyakarta Istimewa
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Pusat kebudayaan Mataram, keraton bersejarah, kuliner legendaris gudeg, dan jalanan Malioboro.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 565.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 3: Bunaken & Manado (MDC) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Undersea diving paradise in Bunaken National Park Manado with colorful pristine coral walls, green sea turtle swimming in transparent azure waters, illuminated by soft tropical sun rays." src="{{ $settings->get('destinations.bunaken', 'https://commons.wikimedia.org/wiki/Special:FilePath/Sunset_at_Bunaken_Island%2C_Sulawesi%2C_2016.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">MDC</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Taman Laut &amp; Selam
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Manado, Sulawesi Utara</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 3j 20m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Bunaken &amp; Manado
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Surganya penyelam dengan dinding karang raksasa dan kekayaan fauna laut tropis langka.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 1.850.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 4: Lombok & Mandalika (LOP) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Serene panoramic view of Tanjung Aan bay in Lombok with turquoise coastal shoreline, rolling hills, white sand beach, and sunny tropical climate with light aero orange skies." src="{{ $settings->get('destinations.lombok', 'https://commons.wikimedia.org/wiki/Special:FilePath/Tanjung_Aan%2C_Lombok.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">LOP</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Pantai &amp; Otomotif
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Lombok Tengah, NTB</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 2j 00m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Lombok &amp; Mandalika
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Sirkuit balap internasional berpadu dengan pasir merica pantai Kuta Lombok dan Gili Trawangan.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 780.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 5: Danau Toba & Medan (KNO) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Majestic Lake Toba vista viewed from tele tower viewpoint showing green volcanic ridges, deep blue lake water, and dramatic clouds with warm sunset reflections in North Sumatra." src="{{ $settings->get('destinations.toba', 'https://commons.wikimedia.org/wiki/Special:FilePath/Panorama_view_Lake_Toba%2C_North_Sumatra%2C_Indonesia.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">KNO</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Danau Vulkanik
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Medan &amp; Toba, Sumut</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 2j 15m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Danau Toba &amp; Medan
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Kaldera vulkanik terbesar di Asia Tenggara serta surga ragam kuliner peranakan di Medan.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 920.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 6: Belitung (TJQ) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Giant granite boulders on white sandy beach of Tanjung Tinggi Belitung surrounded by calm clear turquoise sea and warm sunlight, inspiring coastal serenity." src="{{ $settings->get('destinations.belitung', 'https://commons.wikimedia.org/wiki/Special:FilePath/Pantai_Tanjung_Tinggi.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">TJQ</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Pantai Granit
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Tanjung Pandan, Babel</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 1j 05m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Negeri Laskar Pelangi
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Keajaiban batu granit raksasa, mercusuar legendaris Pulau Lengkuas, dan kelezatan mie Belitung.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 620.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 7: Padang & Bukittinggi (PDG) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Scenic view of Jam Gadang tower in Bukittinggi West Sumatra with traditional Rumah Gadang architecture roofs against Mount Singgalang and blue sky during afternoon daylight." src="{{ $settings->get('destinations.padang', 'https://commons.wikimedia.org/wiki/Special:FilePath/Jam_Gadang%2C_Bukittinggi%2C_2016-02-12_01.jpg?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">PDG</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Kuliner &amp; Ngarai
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Padang, Sumatera Barat</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 1j 45m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Padang &amp; Bukittinggi
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Eksplorasi Ngarai Sianok, Lembah Harau, dan surga kuliner rendang asli Minangkabau.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 880.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Item 8: Banda Neira & Ambon (AMQ) -->
            <div data-page="1" class="destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Fort Belgica historical fortress overlooking the volcanic peak of Gunung Api Banda in Banda Neira Maluku at golden hour with serene deep sea surrounding the historic spice island." src="{{ $settings->get('destinations.banda', 'https://commons.wikimedia.org/wiki/Special:FilePath/Fort_Belgica_01.JPG?width=1280') }}">
                        <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                            <span class="">AMQ</span>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                            Sejarah Rempah
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                                <span class="">Ambon &amp; Maluku Tengah</span>
                                <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> 3j 30m</span>
                            </div>
                            <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                                Banda Neira &amp; Ambon
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                                Jejak sejarah pala dunia, benteng kuno kolonial, dan laut tenang kaya lumba-lumba.
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                                <span class="font-headline-md text-headline-md text-primary font-bold">Rp 2.450.000</span>
                            </div>
                            <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                                Pesan Tiket
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Halaman 2: Destinasi dinamis dari database (airports) -->
            @php($destTypes = ['Jakarta' => 'Gateway & Kuliner', 'Surabaya' => 'Kota Pahlawan', 'Denpasar' => 'Pintu Gerbang Bali', 'Medan' => 'Gerbang Sumatra', 'Makassar' => 'Pesisir & Sejarah', 'Yogyakarta' => 'Kota Budaya', 'Padang' => 'Khas Minang', 'Pontianak' => 'Kota Khatulistiwa', 'Manado' => 'Gerbang Bunaken'])
            @foreach($destinations as $di => $d)
            <div data-page="2" class="hidden destination-card shine bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(38,25,18,0.07)] hover:shadow-[0_18px_40px_rgba(38,25,18,0.12)] transition-all flex flex-col group">
                <div class="relative h-48 w-full overflow-hidden">
                    <img class="card-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="{{ $d->city }} {{ $d->name }}" src="{{ $d->image }}" alt="{{ $d->city }}">
                    <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-primary">pin_drop</span>
                        <span class="">{{ $d->code }}</span>
                    </div>
                    <div class="absolute bottom-3 left-3 bg-primary/80 backdrop-blur-sm text-on-primary px-2 py-0.5 rounded font-label-sm text-label-sm">
                        {{ $destTypes[$d->city] ?? 'Pusat & Transit' }}
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-1 justify-between">
                    <div>
                        <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1">
                            <span class="">{{ $d->city }}, Indonesia</span>
                            <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-xs">schedule</span> {{ 1 + $di % 4 }}j {{ 5 + $di % 5 * 10 }}m</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md font-bold text-on-surface group-hover:text-primary transition-colors">
                            {{ $d->city }} ({{ $d->code }})
                        </h3>
                        <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mt-1">
                            Penerbangan langsung harian GoZay melayani kota ini dengan jadwal fleksibel dan tarif terbaik.
                        </p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-surface-container flex items-center justify-between">
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">Mulai dari</span>
                            <span class="font-headline-md text-headline-md text-primary font-bold">Rp {{ number_format(450000 + $di % 5 * 130000, 0, ',', '.') }}</span>
                        </div>
                        <button class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm hover:-translate-y-0.5">
                            Pesan Tiket
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            </div>

        </div>
    </section>

    <!-- Section: Paginasi & Muat Lebih Banyak -->
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-8 pb-12 w-full flex flex-col items-center">
        <!-- Load More Button -->
        <button class="px-8 py-3.5 rounded-full bg-surface-container-low text-primary font-label-md text-label-md font-bold hover:bg-primary-fixed transition-all flex items-center gap-2 shadow-sm mb-8 hover:-translate-y-0.5" id="loadMoreBtn">
            <span class="">Muat 12 Destinasi Lainnya</span>
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </button>

        <!-- Numeric Pagination Controls -->
        @php($totalPages = ($destinations->isNotEmpty() ? 2 : 1))
        <nav aria-label="Paginasi Destinasi" id="paginationNav" class="flex items-center gap-1.5 bg-surface-container-lowest p-2 rounded-xl shadow-sm">
            <button type="button" aria-label="Sebelumnya" id="prevPageBtn" class="w-10 h-10 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors disabled:opacity-40" disabled="">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            @for($pg = 1; $pg <= $totalPages; $pg++)
            <button type="button" data-page-btn="{{ $pg }}" class="pagination-btn w-10 h-10 rounded-lg font-label-md text-label-md font-medium flex items-center justify-center transition-colors {{ $pg === 1 ? 'bg-primary-container text-on-primary font-bold shadow-sm' : 'text-on-surface hover:bg-surface-container' }}">
                {{ $pg }}
            </button>
            @endfor
            <button type="button" aria-label="Selanjutnya" id="nextPageBtn" class="w-10 h-10 rounded-lg flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors disabled:opacity-40" @if($totalPages <= 1) disabled="" @endif>
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="9 6 15 12 9 18"></polyline>
                </svg>
            </button>
        </nav>
    </section>

</div>
@endsection

@push('scripts')
<script>
(function(){
  const cards = Array.from(document.querySelectorAll('.destination-card'));
  const search = document.getElementById('destInput');
  const region = document.getElementById('regionSelect');
  const type = document.getElementById('typeSelect');
  const sort = document.getElementById('sortSelect');
  const quick = document.getElementById('quickFilterSelect');
  const loadMoreBtn = document.getElementById('loadMoreBtn');

  function text(card){ return card.innerText.toLowerCase(); }

  function applyFilters(){
    const q = (search?.value || '').trim().toLowerCase();
    const r = region?.value || 'all';
    const t = type?.value || 'all';
    const qf = quick?.value || 'all';

    cards.forEach(card => {
      const hay = text(card);
      let visible = !q || hay.includes(q);

      if(r !== 'all'){
        const map = {
          'jawa-bali':['jawa','bali','yogyakarta','jawa tengah','jawa timur','lombok'],
          'sumatra':['sumatra','medan','toba','belitung','padang'],
          'nusa-tenggara':['nusa tenggara','lombok','labuan bajo'],
          'sulawesi':['sulawesi','manado'],
          'maluku-papua':['maluku','papua','raja ampat','ambon','banda'],
          'kalimantan':['kalimantan']
        };
        visible = visible && (map[r] || []).some(x => hay.includes(x));
      }

      if(t !== 'all'){
        const map = {
          'pantai':['pantai','bahari','laut','tropis','selam','granit'],
          'budaya':['budaya','sejarah','warisan','keraton'],
          'gunung':['gunung','alam','bromo','vulkanik','petualangan'],
          'kuliner':['kuliner','makanan','rendang','gudeg']
        };
        visible = visible && (map[t] || []).some(x => hay.includes(x));
      }

      if(qf !== 'all'){
        const map = {
          'pantai':['pantai','laut','bahari'],
          'budaya':['budaya','sejarah'],
          'alam':['alam','gunung','vulkanik','petualangan'],
          'promo':['promo','best deal'],
          'baru':['rute baru']
        };
        visible = visible && (map[qf] || []).some(x => hay.includes(x));
      }

      card.style.display = visible ? '' : 'none';
    });
  }

  [search, region, type, quick].forEach(el => {
    if(el) el.addEventListener(el.tagName === 'INPUT' ? 'input' : 'change', applyFilters);
  });

  // Catalog grid (for sorting) - only in the catalog section, featured stays pinned.
  const catGrid = document.querySelector('#catalogSection .grid');

  if(sort && catGrid){
    sort.addEventListener('change', () => {
      const visible = Array.from(catGrid.querySelectorAll('.destination-card'))
        .filter(c => c.style.display !== 'none' && !c.classList.contains('hidden'));
      if(sort.value === 'cheap'){
        visible.sort((a,b) => {
          const pa = +(a.innerText.match(/Rp\s*([\d.]+)/)?.[1] || '999999999').replace(/\./g,'');
          const pb = +(b.innerText.match(/Rp\s*([\d.]+)/)?.[1] || '999999999').replace(/\./g,'');
          return pa-pb;
        });
      } else if(sort.value === 'populer'){
        visible.sort((a,b) => text(b).includes('populer') - text(a).includes('populer'));
      } else {
        visible.sort((a,b) => text(b).includes('promo') - text(a).includes('promo'));
      }
      visible.forEach(c => catGrid.appendChild(c));
    });
  }

  // --- Pagination ---
  const pageEls = Array.from(document.querySelectorAll('[data-page]'));
  const pageBtns = Array.from(document.querySelectorAll('[data-page-btn]'));
  const prevBtn = document.getElementById('prevPageBtn');
  const nextBtn = document.getElementById('nextPageBtn');
  const totalPages = Math.max(1, pageBtns.length);
  let currentPage = 1;

  function redrawLoadMore(){
    if(!loadMoreBtn) return;
    if(currentPage >= totalPages){
      loadMoreBtn.innerHTML = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg><span>Semua destinasi telah ditampilkan</span>';
      loadMoreBtn.classList.add('opacity-70','pointer-events-none');
    } else {
      const nextCount = pageEls.filter(el => Number(el.dataset.page) === currentPage + 1 && el.classList.contains('destination-card')).length;
      loadMoreBtn.innerHTML = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg><span>Muat ' + nextCount + ' Destinasi Lainnya</span>';
      loadMoreBtn.classList.remove('opacity-70','pointer-events-none');
    }
  }

  function setPage(p){
    if(p < 1) p = 1;
    if(p > totalPages) p = totalPages;
    currentPage = p;
    pageEls.forEach(el => el.classList.toggle('hidden', Number(el.dataset.page) !== currentPage));
    pageBtns.forEach(btn => {
      const active = Number(btn.dataset.pageBtn) === currentPage;
      btn.classList.toggle('bg-primary-container', active);
      btn.classList.toggle('text-on-primary', active);
      btn.classList.toggle('font-bold', active);
      btn.classList.toggle('shadow-sm', active);
      btn.classList.toggle('text-on-surface', !active);
      btn.classList.toggle('hover:bg-surface-container', !active);
    });
    if(prevBtn) prevBtn.disabled = currentPage <= 1;
    if(nextBtn) nextBtn.disabled = currentPage >= totalPages;
    redrawLoadMore();

    scrollToTopSection();
  }

  function scrollToTopSection(){
    const catSection = document.getElementById('catalogSection');
    if(!catSection) return;
    const top = catSection.getBoundingClientRect().top + window.scrollY - 90;
    window.scrollTo({ top, behavior: 'smooth' });
  }

  pageBtns.forEach(btn => btn.addEventListener('click', () => setPage(Number(btn.dataset.pageBtn))));
  if(prevBtn) prevBtn.addEventListener('click', () => setPage(currentPage - 1));
  if(nextBtn) nextBtn.addEventListener('click', () => setPage(currentPage + 1));

  if(loadMoreBtn){
    loadMoreBtn.addEventListener('click', () => {
      if(currentPage < totalPages){
        setPage(currentPage + 1);
      }
    });
  }
  setPage(1);

  const skOverlays = document.querySelectorAll('.gzy-sk-overlay');
  if (skOverlays.length) {
    document.body.classList.add('gzy-skel-active');
    let revealed = false;
    const reveal = () => {
      if (revealed) return;
      revealed = true;
      document.body.classList.remove('gzy-skel-active');
    };
    window.addEventListener('load', reveal);
    setTimeout(reveal, 4000);
  }
})();
</script>
</div>
</div>
</div>
@endpush