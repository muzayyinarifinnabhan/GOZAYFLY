@php
    $classLabels = ['first' => 'First Class', 'business' => 'Business Class', 'premium_economy' => 'Premium Economy', 'economy' => 'Economy Class'];
    $rows = $rows ?? collect();
    $firstRow = $rows->first();
    $cols = $firstRow ? $firstRow->pluck('seat_col')->sort()->values() : collect();
    $leftCols = (int) ceil($cols->count() / 2);
    $colLeft = $cols->take($leftCols);
    $colRight = $cols->skip($leftCols)->values();

    // Urutan kelas: First -> Business -> Premium Economy -> Economy
    $classOrder = ['first' => 0, 'business' => 1, 'premium_economy' => 2, 'economy' => 3];
    $seatClasses = $rows->flatten()->pluck('class')->unique()
        ->reject(fn ($c) => !isset($classLabels[$c]))
        ->sortBy(fn ($c) => $classOrder[$c] ?? 99)
        ->values();

    // Kelompokkan kursi per kelas (per baris)
    $classPanels = [];
    foreach ($seatClasses as $sc) {
        $classRows = [];
        foreach ($rows as $row => $seats) {
            $filtered = $seats->where('class', $sc)->sortBy('seat_col')->values();
            if ($filtered->isEmpty()) {
                continue;
            }
            $classRows[] = [
                'row' => $row,
                'left' => $filtered->take($leftCols),
                'right' => $filtered->splice($leftCols)->values(),
            ];
        }
        $classPanels[$sc] = $classRows;
    }

    $defaultClass = $seatClasses->first() ?? 'economy';
    $gridTemplate = 'repeat(' . $colLeft->count() . ', var(--seat-w)) var(--aisle-w) repeat(' . $colRight->count() . ', var(--seat-w))';
    $maxPassengers = max(1, min(9, $flight->availableSeatsCount()));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kursi - {{ $flight->flight_number }} | GoZay Airlines</title>

    <!-- Favicon (Logo GoZay) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,300..700,0..1,-50..200&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    },

                    colors: {
                        go: {
                            orange: '#FF6B1A',
                            orangeDark: '#E95508',
                            orangeLight: '#FFF1E8',

                            navy: '#16213E',
                            navyLight: '#25345B',

                            cream: '#FAFAF9',
                            border: '#E7E5E4',

                            muted: '#78716C',
                            success: '#16A34A',
                            danger: '#E5E7EB'
                        }
                    },

                    boxShadow: {
                        soft: '0 10px 40px rgba(22, 33, 62, 0.07)',
                        card: '0 20px 60px rgba(22, 33, 62, 0.08)',
                        orange: '0 12px 30px rgba(255, 107, 26, 0.22)'
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at 10% 10%, rgba(255, 107, 26, .055), transparent 25%),
                radial-gradient(circle at 90% 20%, rgba(65, 91, 162, .045), transparent 25%),
                #FAFAF9;
            color: #16213E;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }

        /* ========================= SEAT ========================= */
        :root {
            --seat-w: 48px;
            --seat-h: 52px;
            --aisle-w: 36px;
            --seat-gap: 8px;
        }
        .seat {
            position: relative;
            width: var(--seat-w);
            height: var(--seat-h);
            border-radius: 12px 12px 8px 8px;
            border: 1.5px solid #D6D3D1;
            background: #FFFFFF;
            color: #57534E;
            transition: all .2s ease;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,.035);
        }
        .seat::before {
            content: "";
            position: absolute;
            left: 7px;
            right: 7px;
            top: -4px;
            height: 7px;
            border-radius: 5px 5px 2px 2px;
            background: inherit;
            border: inherit;
            border-bottom: none;
        }
        .seat:hover:not(:disabled):not(.selected) {
            transform: translateY(-3px);
            border-color: #FF6B1A;
            color: #FF6B1A;
            box-shadow: 0 8px 18px rgba(255, 107, 26, .16);
        }
        .seat.selected {
            background: #FF6B1A;
            border-color: #FF6B1A;
            color: white;
            box-shadow: 0 8px 18px rgba(255, 107, 26, .25);
        }
        .seat.selected::before {
            background: #FF6B1A;
            border-color: #FF6B1A;
        }
        .seat.occupied {
            background: #E7E5E4;
            border-color: #E7E5E4;
            color: #A8A29E;
            cursor: not-allowed;
            box-shadow: none;
        }
        .seat.occupied::before {
            background: #E7E5E4;
            border-color: #E7E5E4;
        }
        .seat-label {
            position: relative;
            z-index: 2;
            font-size: 11px;
            font-weight: 700;
        }

        /* ========================= AIRPLANE ========================= */
        .airplane {
            position: relative;
            max-width: 480px;
            margin: auto;
            padding: 26px 28px 34px;
            background: white;
            border: 1px solid #E7E5E4;
            border-radius: 42% 42% 28px 28px / 10% 10% 4% 4%;
            box-shadow: 0 25px 60px rgba(22, 33, 62, .08), inset 0 0 0 1px rgba(255,255,255,.7);
            overflow: hidden;
        }
        .airplane::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 75%;
            height: 100%;
            border-left: 1px dashed #E7E5E4;
            border-right: 1px dashed #E7E5E4;
            pointer-events: none;
        }
        .cockpit {
            position: relative;
            z-index: 2;
            width: 120px;
            height: 45px;
            margin: 0 auto 20px;
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            border-radius: 50% 50% 15px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748B;
        }
        .seat-row {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: {{ $gridTemplate }};
            justify-content: center;
            align-items: center;
            gap: var(--seat-gap);
            margin-bottom: 13px;
        }
        .aisle-number {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #A8A29E;
            font-size: 10px;
            font-weight: 700;
        }
        .class-divider {
            position: relative;
            z-index: 2;
            margin: 22px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #A8A29E;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .class-divider::before,
        .class-divider::after {
            content: "";
            height: 1px;
            background: #E7E5E4;
            flex: 1;
        }

        .glass {
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }
        .summary-card {
            background: white;
            border: 1px solid #E7E5E4;
            box-shadow: 0 20px 60px rgba(22, 33, 62, .07);
        }
        .progress-line { background: #E7E5E4; }
        .progress-active { background: linear-gradient(90deg, #FF6B1A, #FF8A4C); }

        /* ========================= PASSENGER CARD ========================= */
        .passenger-card { transition: all .2s ease; }
        .passenger-card.active { border-color: #FF6B1A; box-shadow: 0 8px 30px rgba(255, 107, 26, .10); }
        .passenger-card.has-seat { background: #FFFBF8; }

        /* ========================= MOBILE ========================= */
        @media (max-width: 640px) {
            :root {
                --seat-w: 38px;
                --seat-h: 44px;
                --aisle-w: 26px;
                --seat-gap: 5px;
            }
            .seat { border-radius: 9px 9px 6px 6px; }
            .seat::before { left: 5px; right: 5px; }
            .seat-label { font-size: 9px; }
            .airplane { padding: 22px 12px 30px; border-radius: 30% 30% 24px 24px; }
        }
    </style>
</head>

<body>

    @include('partials.skeleton')

    @include('partials.flash')

    <!-- ========================================================= -->
    <!-- HEADER -->
    <!-- ========================================================= -->

    <header class="sticky top-0 z-50 glass border-b border-stone-200/70">
        <div class="relative max-w-7xl mx-auto px-5 md:px-8 h-[76px] flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('logo.png') }}" alt="GoZay Airlines" class="h-10 w-auto"/>
            </a>
            <nav class="hidden md:flex items-center gap-8 absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('home') }}" class="text-sm font-semibold tracking-wide py-2 border-b-2 {{ request()->routeIs('home') ? 'text-go-orange border-go-orange' : 'text-go-navy border-transparent hover:text-go-orange transition-colors' }}">Home</a>
                <a href="{{ route('search.results') }}" class="text-sm font-semibold tracking-wide py-2 border-b-2 {{ request()->routeIs('search.results') || request()->routeIs('flights.*') ? 'text-go-orange border-go-orange' : 'text-go-navy border-transparent hover:text-go-orange transition-colors' }}">Penerbangan</a>
                <a href="{{ route('home') }}#destinasi" class="text-sm font-semibold tracking-wide py-2 border-b-2 text-go-navy border-transparent hover:text-go-orange transition-colors">Destinasi</a>
                <a href="{{ route('home') }}#promo" class="text-sm font-semibold tracking-wide py-2 border-b-2 text-go-navy border-transparent hover:text-go-orange transition-colors">Penawaran</a>
            </nav>
            <div class="flex items-center gap-2.5 text-stone-500">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[17px] text-emerald-600">lock</span>
                </div>
                <div class="hidden sm:block">
                    <p class="text-[10px] uppercase tracking-wider font-bold text-stone-400">Transaksi</p>
                    <p class="text-xs font-bold text-go-navy">Pembayaran Aman</p>
                </div>
            </div>
        </div>
    </header>


    <!-- ========================================================= -->
    <!-- MAIN -->
    <!-- ========================================================= -->

    <main class="max-w-7xl mx-auto px-5 md:px-8 py-8 md:py-12">

<div data-sk-zone>
<div data-sk-skeleton aria-hidden="true" class="space-y-8">
    <!-- Progress Bar Skeleton -->
    <section class="max-w-3xl mx-auto mb-10 md:mb-14">
        <div class="relative">
            <div class="absolute left-[12%] right-[12%] top-5 h-1 rounded-full gk-skel"></div>
            <div class="relative flex justify-between">
                @for($i = 0; $i < 4; $i++)
                    <div class="flex flex-col items-center gap-2">
                        <div class="gk-skel gsk-circle" style="width:40px;height:40px"></div>
                        <div class="gk-skel gsk-line" style="width:50px;height:10px"></div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Page Header Skeleton -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5">
            <div>
                <div class="gk-skel gsk-pill" style="width:120px;height:36px;margin-bottom:12px"></div>
                <div class="gk-skel gsk-line-2xl" style="width:200px;height:40px;margin-bottom:8px"></div>
                <div class="gk-skel gsk-line" style="width:300px;height:16px"></div>
            </div>
            <div class="gk-skel gsk-field" style="width:250px;height:54px"></div>
        </div>
    </div>

    <!-- Passenger Count Skeleton -->
    <div class="bg-white border border-stone-200 rounded-3xl shadow-soft p-5 md:p-6 mb-7">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <div class="gk-skel gsk-icon" style="width:44px;height:44px;border-radius:16px"></div>
                <div>
                    <div class="gk-skel gsk-line-md" style="width:140px;height:20px;margin-bottom:6px"></div>
                    <div class="gk-skel gsk-line-sm" style="width:200px;height:12px"></div>
                </div>
            </div>
            <div class="gk-skel gsk-field" style="width:80px;height:48px;border-radius:12px"></div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-7 lg:gap-9 items-start">
        <!-- Left Side -->
        <section class="lg:col-span-8 space-y-6">
            <!-- Flight Info Skeleton -->
            <div class="bg-white rounded-3xl border border-stone-200 shadow-soft p-5 md:p-7 mb-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="flex items-center gap-4">
                        <div class="gk-skel gsk-icon" style="width:48px;height:48px;border-radius:16px"></div>
                        <div>
                            <div class="gk-skel gsk-line-md" style="width:150px;height:20px;margin-bottom:6px"></div>
                            <div class="gk-skel gsk-line-sm" style="width:200px;height:12px"></div>
                        </div>
                    </div>
                    <div class="gk-skel gsk-field" style="width:120px;height:48px;border-radius:12px"></div>
                </div>
            </div>

            <!-- Passengers Skeleton -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="gk-skel gsk-line-xl" style="width:140px;height:28px;margin-bottom:6px"></div>
                        <div class="gk-skel gsk-line-sm" style="width:180px;height:12px"></div>
                    </div>
                    <div class="gk-skel gsk-pill" style="width:100px;height:36px"></div>
                </div>
                @for($i = 0; $i < 3; $i++)
                    <div class="gk-skel gsk-card" style="border-radius:16px;padding:16px;margin-bottom:12px">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="gk-skel gsk-avatar" style="width:40px;height:40px;border-radius:50%"></div>
                                <div class="min-w-0">
                                    <div class="gk-skel gsk-line-sm" style="width:80px;height:12px;margin-bottom:4px"></div>
                                    <div class="gk-skel gsk-line-xs" style="width:60px;height:10px"></div>
                                </div>
                            </div>
                            <div class="gk-skel gsk-btn" style="width:80px;height:32px;border-radius:12px"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Seat Map Skeleton -->
            <div class="bg-white rounded-3xl border border-stone-200 shadow-soft p-5 md:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
                    <div>
                        <div class="gk-skel gsk-line-xl" style="width:140px;height:28px;margin-bottom:6px"></div>
                        <div class="gk-skel gsk-line-sm" style="width:160px;height:12px"></div>
                    </div>
                    <div class="flex items-center gap-3 bg-stone-50 rounded-2xl px-4 py-3">
                        <div class="gk-skel gsk-avatar" style="width:36px;height:36px;border-radius:50%"></div>
                        <div>
                            <div class="gk-skel gsk-line-xs" style="width:60px;height:10px;margin-bottom:4px"></div>
                            <div class="gk-skel gsk-line-sm" style="width:80px;height:12px"></div>
                        </div>
                    </div>
                </div>

                <!-- Legend Skeleton -->
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-8 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                    @for($i = 0; $i < 3; $i++)
                        <div class="flex items-center gap-2">
                            <div class="gk-skel" style="width:20px;height:20px;border-radius:8px"></div>
                            <div class="gk-skel gsk-line-xs" style="width:60px;height:10px"></div>
                        </div>
                    @endfor
                </div>

                <!-- Airplane Skeleton -->
                <div class="gk-skel" style="max-width:480px;margin:0 auto;padding:26px 28px 34px;border-radius:42% 42% 28px 28px/10% 10% 4% 4%;border:1px solid #E7E5E4">
                    <div class="gk-skel gsk-icon" style="width:120px;height:45px;border-radius:50% 50% 15px 15px;margin:0 auto 20px"></div>
                    @for($r = 0; $r < 3; $r++)
                        <div class="gk-skel" style="display:grid;grid-template-columns:repeat(3,48px) 36px repeat(3,48px);gap:8px;justify-content:center;margin-bottom:13px">
                            @for($c = 0; $c < 7; $c++)
                                <div class="gk-skel" style="width:48px;height:52px;border-radius:12px 12px 8px 8px"></div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Right Sidebar Skeleton -->
        <aside class="lg:col-span-4">
            <div class="gk-skel gsk-card" style="border-radius:24px;padding:24px;position:sticky;top:24px">
                <div class="flex items-start justify-between pb-5 border-b border-stone-100 mb-5">
                    <div>
                        <div class="gk-skel gsk-line-xs" style="width:80px;height:10px;margin-bottom:8px"></div>
                        <div class="gk-skel gsk-line-xl" style="width:120px;height:24px;margin-bottom:6px"></div>
                    </div>
                    <div class="gk-skel gsk-icon" style="width:40px;height:40px;border-radius:16px"></div>
                </div>
                <div class="py-5 border-b border-stone-100">
                    <div class="flex justify-between items-center mb-3">
                        <div class="gk-skel gsk-line-sm" style="width:80px;height:12px"></div>
                        <div class="gk-skel gsk-line-md" style="width:80px;height:20px"></div>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="gk-skel gsk-line-sm" style="width:100px;height:12px"></div>
                        <div class="gk-skel gsk-line-sm" style="width:100px;height:12px"></div>
                    </div>
                </div>
                <div class="py-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="gk-skel gsk-line-sm" style="width:100px;height:12px"></div>
                        <div class="gk-skel gsk-pill" style="width:60px;height:24px"></div>
                    </div>
                    @for($i = 0; $i < 3; $i++)
                        <div class="gk-skel" style="border-radius:16px;border:1px solid #E7E5E4;padding:12px;margin-bottom:8px"></div>
                    @endfor
                </div>
                <div class="space-y-3 pb-5 border-t border-stone-100 pt-5">
                    @for($i = 0; $i < 2; $i++)
                        <div class="flex justify-between items-center py-2">
                            <div class="gk-skel gsk-line-sm" style="width:120px;height:12px"></div>
                            <div class="gk-skel gsk-line-md" style="width:80px;height:16px"></div>
                        </div>
                    @endfor
                </div>
                <div class="border-t border-stone-100 pt-5 pb-5">
                    <div class="flex items-end justify-between">
                        <div>
                            <div class="gk-skel gsk-line-sm" style="width:60px;height:12px;margin-bottom:4px"></div>
                            <div class="gk-skel gsk-line-xs" style="width:80px;height:10px"></div>
                        </div>
                        <div class="gk-skel gsk-line-xl" style="width:100px;height:28px"></div>
                    </div>
                </div>
                <div class="mt-5 flex items-center justify-center gap-2 text-[9px] font-semibold text-stone-400">
                    <div class="gk-skel gsk-icon" style="width:14px;height:14px;border-radius:50%"></div>
                    <div class="gk-skel gsk-line-xs" style="width:80px;height:10px"></div>
                </div>
            </div>
        </aside>
    </div>
</div>
</div>

<div data-sk-content>

        <!-- ===================================================== -->
        <!-- PROGRESS -->
        <!-- ===================================================== -->

        <section class="max-w-3xl mx-auto mb-10 md:mb-14">
            <div class="relative">
                <div class="absolute left-[12%] right-[12%] top-5 h-1 rounded-full progress-line"></div>
                <div class="absolute left-[12%] top-5 w-[50%] h-1 rounded-full progress-active"></div>
                <div class="relative flex justify-between">
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-go-orange text-white flex items-center justify-center shadow-orange ring-4 ring-stone-50">
                            <span class="material-symbols-outlined text-[19px]">check</span>
                        </div>
                        <span class="text-[10px] md:text-xs font-bold text-stone-400">Cari</span>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-go-orange text-white flex items-center justify-center shadow-orange ring-4 ring-stone-50">
                            <span class="material-symbols-outlined text-[19px]">check</span>
                        </div>
                        <span class="text-[10px] md:text-xs font-bold text-stone-400">Pilih</span>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-go-orange text-white flex items-center justify-center font-bold text-sm shadow-orange ring-4 ring-stone-50">3</div>
                        <span class="text-[10px] md:text-xs font-extrabold text-go-orange">Kursi</span>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-stone-200 text-stone-400 flex items-center justify-center font-bold text-sm ring-4 ring-stone-50">4</div>
                        <span class="text-[10px] md:text-xs font-bold text-stone-400">Bayar</span>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===================================================== -->
        <!-- PAGE HEADER -->
        <!-- ===================================================== -->

        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-5">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-go-orangeLight text-go-orange text-[10px] font-extrabold uppercase tracking-wider mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-go-orange"></span>
                        Seat Selection
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-[-0.04em] text-go-navy">Pilih Kursi Anda</h1>
                    <p class="mt-2 text-sm md:text-base text-stone-500 max-w-xl">Pilih kursi untuk setiap penumpang sebelum melanjutkan ke pembayaran.</p>
                </div>

                <div class="flex items-center gap-4 bg-white border border-stone-200 rounded-2xl px-4 py-3 shadow-sm">
                    <div class="text-right">
                        <p class="text-[10px] uppercase tracking-wider text-stone-400 font-bold">{{ $flight->origin->code }}</p>
                        <p class="text-sm font-extrabold text-go-navy">{{ $flight->origin->city }}</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-go-orange text-[19px]">flight</span>
                        <span class="text-[9px] text-stone-400 font-bold">{{ $flight->duration_label }}</span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-stone-400 font-bold">{{ $flight->destination->code }}</p>
                        <p class="text-sm font-extrabold text-go-navy">{{ $flight->destination->city }}</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- ===================================================== -->
        <!-- PASSENGER COUNT -->
        <!-- ===================================================== -->

        <div class="bg-white border border-stone-200 rounded-3xl shadow-soft p-5 md:p-6 mb-7">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-2xl bg-go-orangeLight flex items-center justify-center">
                        <span class="material-symbols-outlined text-go-orange">groups</span>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-go-navy">Berapa orang yang terbang?</h2>
                        <p class="text-xs text-stone-400 mt-1">Pilih jumlah penumpang yang akan melakukan perjalanan.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <label for="passenger-count" class="text-xs font-bold text-stone-500">Jumlah Penumpang</label>
                    <select id="passenger-count" class="w-24 bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm font-extrabold text-go-navy outline-none focus:border-go-orange focus:ring-4 focus:ring-orange-100">
                        @for ($i = 1; $i <= $maxPassengers; $i++)
                            <option value="{{ $i }}" @selected($i === 1)>{{ $i }} Orang</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>


        <!-- ===================================================== -->
        <!-- GRID -->
        <!-- ===================================================== -->

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-7 lg:gap-9 items-start">

            <!-- ================================================= -->
            <!-- LEFT -->
            <!-- ================================================= -->

            <section class="lg:col-span-8">

                <!-- Flight Info -->
                <div class="bg-white rounded-3xl border border-stone-200 shadow-soft p-5 md:p-7 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-go-orangeLight flex items-center justify-center">
                                <span class="material-symbols-outlined text-go-orange">flight_takeoff</span>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-extrabold text-go-navy">{{ $flight->origin->city }}</span>
                                    <span class="text-xs font-bold text-stone-400">{{ $flight->origin->code }}</span>
                                    <span class="material-symbols-outlined text-[16px] text-stone-400">arrow_forward</span>
                                    <span class="font-extrabold text-go-navy">{{ $flight->destination->city }}</span>
                                    <span class="text-xs font-bold text-stone-400">{{ $flight->destination->code }}</span>
                                </div>
                                <p class="text-xs text-stone-400 mt-1">{{ $flight->departure_date->translatedFormat('l, d F Y') }} · {{ $flight->airline->name }} · {{ $flight->flight_number }}</p>
                            </div>
                        </div>

                        <!-- Class -->
                        <div class="relative">
                            <label for="seat-class" class="block text-[9px] uppercase tracking-wider font-extrabold text-stone-400 mb-1.5">Kelas penerbangan</label>
                            <select id="seat-class" class="appearance-none w-full md:w-48 bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 pr-10 text-xs font-bold text-go-navy outline-none focus:border-go-orange focus:ring-4 focus:ring-orange-100">
                                <option value="economy" @selected($defaultClass === 'economy')>Economy Class</option>
                                <option value="premium_economy" @selected($defaultClass === 'premium_economy')>Premium Economy</option>
                                <option value="business" @selected($defaultClass === 'business')>Business Class</option>
                                <option value="first" @selected($defaultClass === 'first')>First Class</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-3 bottom-3 text-stone-400 text-[18px] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                </div>


                <!-- ================================================= -->
                <!-- PASSENGERS -->
                <!-- ================================================= -->

                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-extrabold text-go-navy">Daftar Penumpang</h2>
                            <p class="text-xs text-stone-400 mt-1">Pilih penumpang terlebih dahulu, lalu pilih kursinya.</p>
                        </div>
                        <span id="passenger-total-label" class="px-3 py-1.5 rounded-full bg-go-orangeLight text-go-orange text-[10px] font-extrabold">1 Penumpang</span>
                    </div>
                    <div id="passenger-list" class="space-y-3"></div>
                </div>


                <!-- ================================================= -->
                <!-- SEAT MAP -->
                <!-- ================================================= -->

                <div class="bg-white rounded-3xl border border-stone-200 shadow-soft p-5 md:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
                        <div>
                            <h2 class="text-xl font-extrabold tracking-tight text-go-navy">Pilih tempat duduk</h2>
                            <p id="seat-instruction" class="text-xs text-stone-400 mt-1">Pilih penumpang terlebih dahulu.</p>
                        </div>
                        <div id="active-passenger-badge" class="flex items-center gap-3 bg-stone-50 rounded-2xl px-4 py-3">
                            <div class="w-9 h-9 rounded-full bg-go-orangeLight flex items-center justify-center">
                                <span class="material-symbols-outlined text-go-orange text-[18px]">person</span>
                            </div>
                            <div>
                                <p class="text-[9px] uppercase tracking-wider text-stone-400 font-bold">Penumpang</p>
                                <p id="active-passenger-name" class="text-xs font-extrabold text-go-navy">Penumpang 1</p>
                            </div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-8 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-md bg-white border border-stone-300"></div>
                            <span class="text-[10px] font-bold text-stone-500">Tersedia</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-md bg-go-orange"></div>
                            <span class="text-[10px] font-bold text-stone-500">Terpilih</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-md bg-stone-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-[13px]">close</span>
                            </div>
                            <span class="text-[10px] font-bold text-stone-500">Terisi</span>
                        </div>
                    </div>

                    <!-- ================================================= -->
                    <!-- AIRPLANE -->
                    <!-- ================================================= -->

                    <div class="airplane">

                        <!-- Cockpit -->
                        <div class="cockpit">
                            <span class="material-symbols-outlined text-[23px]">flight</span>
                        </div>

                        @forelse ($seatClasses as $sc)
                            <div class="seat-panel" data-class-panel="{{ $sc }}" @if ($sc !== $defaultClass) style="display:none;" @endif>
                                <div class="class-divider">{{ $classLabels[$sc] }}</div>

                                @foreach ($classPanels[$sc] as $r)
                                    <div class="seat-row">
                                        @foreach ($r['left'] as $seat)
                                            @if ($seat->available)
                                                <button type="button" class="seat" data-seat="{{ $seat->seat_number }}" data-id="{{ $seat->id }}" data-price="{{ $seat->price }}">
                                                    <span class="seat-label">{{ $seat->seat_number }}</span>
                                                </button>
                                            @else
                                                <button type="button" class="seat occupied" disabled title="Terisi">
                                                    <span class="material-symbols-outlined text-[16px]">close</span>
                                                </button>
                                            @endif
                                        @endforeach

                                        <div class="aisle-number">{{ $r['row'] }}</div>

                                        @foreach ($r['right'] as $seat)
                                            @if ($seat->available)
                                                <button type="button" class="seat" data-seat="{{ $seat->seat_number }}" data-id="{{ $seat->id }}" data-price="{{ $seat->price }}">
                                                    <span class="seat-label">{{ $seat->seat_number }}</span>
                                                </button>
                                            @else
                                                <button type="button" class="seat occupied" disabled title="Terisi">
                                                    <span class="material-symbols-outlined text-[16px]">close</span>
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <p class="text-center text-xs text-stone-400 py-10">Belum ada data kursi untuk penerbangan ini.</p>
                        @endforelse

                        <!-- Tail -->
                        <div class="mt-8 relative z-10 flex justify-center">
                            <div class="px-5 py-2 rounded-full bg-stone-50 border border-stone-200 text-[9px] font-extrabold uppercase tracking-[.16em] text-stone-400">Tail</div>
                        </div>
                    </div>

                </div>

            </section>


            <!-- ================================================= -->
            <!-- RIGHT -->
            <!-- ================================================= -->

            <aside class="lg:col-span-4">
                <div class="summary-card rounded-3xl p-6 md:p-7 lg:sticky lg:top-24">

                    <!-- Header -->
                    <div class="flex items-start justify-between pb-5 border-b border-stone-100">
                        <div>
                            <p class="text-[9px] uppercase tracking-[.15em] font-extrabold text-go-orange mb-1">Booking Summary</p>
                            <h2 class="text-xl font-extrabold tracking-tight text-go-navy">Ringkasan Pemesanan</h2>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-go-orangeLight flex items-center justify-center">
                            <span class="material-symbols-outlined text-go-orange">receipt_long</span>
                        </div>
                    </div>

                    <!-- Flight -->
                    <div class="py-5 border-b border-stone-100">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-semibold text-stone-500">Penerbangan</span>
                            <span id="flight-price-label" class="text-sm font-extrabold text-go-navy">Rp {{ number_format($flight->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg font-extrabold text-go-navy">{{ $flight->origin->code }}</p>
                                <p class="text-[10px] text-stone-400">{{ $flight->origin->city }}</p>
                            </div>
                            <div class="flex-1 mx-4 flex items-center">
                                <div class="h-px bg-stone-200 flex-1"></div>
                                <div class="w-8 h-8 rounded-full bg-go-orangeLight flex items-center justify-center mx-2">
                                    <span class="material-symbols-outlined text-go-orange text-[16px]">flight</span>
                                </div>
                                <div class="h-px bg-stone-200 flex-1"></div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-extrabold text-go-navy">{{ $flight->destination->code }}</p>
                                <p class="text-[10px] text-stone-400">{{ $flight->destination->city }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- ================================================= -->
                    <!-- PASSENGER SUMMARY -->
                    <!-- ================================================= -->

                    <div class="py-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-stone-500">Penumpang & Kursi</span>
                            <span id="seat-count" class="px-2 py-1 rounded-full bg-go-orangeLight text-go-orange text-[9px] font-extrabold">0 Kursi</span>
                        </div>
                        <div id="summary-passengers" class="space-y-3"></div>
                    </div>

                    <!-- Price -->
                    <div class="space-y-3 pb-5 border-t border-stone-100 pt-5">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-stone-500">Harga penerbangan</span>
                            <span id="flight-price" class="text-xs font-bold text-go-navy">Rp {{ number_format($flight->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-stone-500">Biaya kursi</span>
                            <span id="seat-price" class="text-xs font-bold text-go-navy">Rp 0</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-stone-100 pt-5 pb-5">
                        <div class="flex items-end justify-between">
                            <div>
                                <p class="text-xs font-semibold text-stone-500">Total Harga</p>
                                <p class="text-[9px] text-stone-400 mt-1">Termasuk pajak & biaya</p>
                            </div>
                            <p id="total-price" class="text-2xl font-extrabold tracking-tight text-go-orange">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- CTA -->
                    <form method="GET" action="{{ route('bookings.create', $flight) }}" id="continue-form">
                        @csrf
                        <div id="selected-seats-container"></div>
                        <button id="continue-button" type="submit" class="w-full h-14 rounded-2xl bg-go-orange hover:bg-go-orangeDark text-white font-extrabold text-xs flex items-center justify-center gap-2 shadow-orange transition-all duration-200 hover:-translate-y-0.5">
                            Lanjutkan ke Pembayaran
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Secure -->
                    <div class="mt-5 flex items-center justify-center gap-2 text-[9px] font-semibold text-stone-400">
                        <span class="material-symbols-outlined text-[14px] text-emerald-500">verified_user</span>
                        Data dan pembayaran Anda aman
                    </div>

                </div>
            </aside>

        </div>

    </div>
</div>
    </main>

    <!-- ========================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ========================================================= -->

    <script>
        /*
        ============================================================
        DATA
        ============================================================
        */
        const isLoggedIn = {{ auth()->check() ? 1 : 0 }};
        const FLIGHT_PRICE = {{ $flight->price }};
        const MAX_PASSENGERS = {{ $maxPassengers }};
        const seatData = {};   // id => { seat, price }

        let passengers = [{ id: 1, name: "Penumpang 1", seat: null }];
        let activePassengerId = 1;

        document.querySelectorAll('.seat[data-id]').forEach(btn => {
            seatData[btn.dataset.id] = { seat: btn.dataset.seat, price: Number(btn.dataset.price) };
        });

        const dataSeatMap = {};   // nomor kursi => id
        Object.keys(seatData).forEach(id => { dataSeatMap[seatData[id].seat] = id; });

        /*
        ============================================================
        ELEMENT
        ============================================================
        */
        const passengerCount = document.getElementById("passenger-count");
        const passengerList = document.getElementById("passenger-list");
        const summaryPassengers = document.getElementById("summary-passengers");
        const seatCount = document.getElementById("seat-count");
        const seatPrice = document.getElementById("seat-price");
        const flightPrice = document.getElementById("flight-price");
        const flightPriceLabel = document.getElementById("flight-price-label");
        const totalPrice = document.getElementById("total-price");
        const passengerTotalLabel = document.getElementById("passenger-total-label");
        const activePassengerName = document.getElementById("active-passenger-name");
        const seatInstruction = document.getElementById("seat-instruction");

        /*
        ============================================================
        FORMAT RUPIAH
        ============================================================
        */
        function formatRupiah(number) {
            return "Rp " + new Intl.NumberFormat("id-ID", { maximumFractionDigits: 0 }).format(number);
        }

        /*
        ============================================================
        BUAT PENUMPANG
        ============================================================
        */
        function createPassengers(count) {
            const oldPassengers = [...passengers];
            passengers = [];

            for (let i = 1; i <= count; i++) {
                const oldPassenger = oldPassengers.find(p => p.id === i);
                passengers.push({
                    id: i,
                    name: oldPassenger ? oldPassenger.name : `Penumpang ${i}`,
                    seat: oldPassenger ? oldPassenger.seat : null
                });
            }

            if (!passengers.some(p => p.id === activePassengerId)) {
                activePassengerId = passengers[0].id;
            }

            renderPassengers();
            renderSummary();
            updateSeatDisplay();
            updatePrice();
        }

        /*
        ============================================================
        RENDER PASSENGER CARD
        ============================================================
        */
        function renderPassengers() {
            passengerList.innerHTML = "";

            passengers.forEach(passenger => {
                const isActive = passenger.id === activePassengerId;
                const hasSeat = passenger.seat !== null;

                const card = document.createElement("div");
                card.className = `passenger-card ${isActive ? "active" : ""} ${hasSeat ? "has-seat" : ""} bg-white border border-stone-200 rounded-2xl p-4 cursor-pointer`;

                card.innerHTML = `
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 shrink-0 rounded-full ${hasSeat ? "bg-go-orange text-white" : "bg-go-orangeLight text-go-orange"} flex items-center justify-center">
                                <span class="material-symbols-outlined text-[19px]">person</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[9px] uppercase tracking-wider text-stone-400 font-bold">Penumpang ${passenger.id}</p>
                                <p class="text-xs font-extrabold text-go-navy truncate">${passenger.name}</p>
                                ${hasSeat
                                    ? `<p class="text-[10px] text-go-orange font-bold mt-1">Kursi ${passenger.seat}</p>`
                                    : `<p class="text-[10px] text-stone-400 font-semibold mt-1">Belum memilih kursi</p>`}
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            ${hasSeat
                                ? `<button type="button" class="cancel-seat-btn h-9 px-3 rounded-xl border border-red-100 bg-red-50 text-red-500 text-[10px] font-extrabold hover:bg-red-100 transition" data-passenger-id="${passenger.id}">
                                     <span class="material-symbols-outlined text-[15px] align-middle">close</span>
                                     <span class="hidden sm:inline">Batalkan Kursi</span>
                                   </button>`
                                : `<span class="px-3 py-2 rounded-xl bg-stone-100 text-stone-400 text-[9px] font-extrabold">Pilih Kursi</span>`}
                            <span class="material-symbols-outlined text-stone-300">chevron_right</span>
                        </div>
                    </div>`;

                card.addEventListener("click", function(event) {
                    if (event.target.closest(".cancel-seat-btn")) return;
                    activePassengerId = passenger.id;
                    renderPassengers();
                    updateSeatDisplay();
                });

                const cancelButton = card.querySelector(".cancel-seat-btn");
                if (cancelButton) {
                    cancelButton.addEventListener("click", function(event) {
                        event.stopPropagation();
                        cancelSeat(passenger.id);
                    });
                }

                passengerList.appendChild(card);
            });
        }

        /*
        ============================================================
        RENDER SUMMARY KANAN
        ============================================================
        */
        function renderSummary() {
            summaryPassengers.innerHTML = "";
            let selectedCount = 0;

            passengers.forEach(passenger => {
                if (passenger.seat) selectedCount++;

                const item = document.createElement("div");
                item.className = "rounded-2xl border border-stone-200 bg-stone-50 p-3";

                item.innerHTML = `
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 shrink-0 rounded-xl ${passenger.seat ? "bg-go-orange text-white" : "bg-white text-stone-400"} flex items-center justify-center">
                                <span class="material-symbols-outlined text-[17px]">person</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[9px] uppercase tracking-wider font-extrabold text-stone-400">Penumpang ${passenger.id}</p>
                                <p class="text-xs font-extrabold text-go-navy truncate">${passenger.name}</p>
                                ${passenger.seat
                                    ? `<p class="text-[10px] text-go-orange font-extrabold mt-0.5">Kursi ${passenger.seat}</p>`
                                    : `<p class="text-[10px] text-stone-400 font-semibold mt-0.5">Belum pilih kursi</p>`}
                            </div>
                        </div>
                        ${passenger.seat
                            ? `<button type="button" class="summary-cancel-btn shrink-0 px-2.5 py-2 rounded-lg text-[9px] font-extrabold text-red-500 bg-red-50 hover:bg-red-100 transition" data-passenger-id="${passenger.id}">Batal</button>`
                            : `<button type="button" class="summary-select-btn shrink-0 px-2.5 py-2 rounded-lg text-[9px] font-extrabold text-go-orange bg-go-orangeLight hover:bg-orange-100 transition" data-passenger-id="${passenger.id}">Pilih</button>`}
                    </div>`;

                const selectButton = item.querySelector(".summary-select-btn");
                if (selectButton) {
                    selectButton.addEventListener("click", function() {
                        activePassengerId = passenger.id;
                        renderPassengers();
                        updateSeatDisplay();
                        window.scrollTo({ top: document.querySelector(".airplane").offsetTop - 120, behavior: "smooth" });
                    });
                }

                const cancelButton = item.querySelector(".summary-cancel-btn");
                if (cancelButton) {
                    cancelButton.addEventListener("click", function() {
                        cancelSeat(passenger.id);
                    });
                }

                summaryPassengers.appendChild(item);
            });

            seatCount.textContent = `${selectedCount} Kursi`;
        }

        /*
        ============================================================
        UPDATE SEAT DISPLAY
        ============================================================
        */
        function updateSeatDisplay() {
            const activePassenger = passengers.find(p => p.id === activePassengerId);
            if (!activePassenger) return;

            activePassengerName.textContent = activePassenger.name;

            if (activePassenger.seat) {
                seatInstruction.textContent = `Kursi ${activePassenger.seat} sedang dipilih oleh ${activePassenger.name}. Klik kursi lain untuk menggantinya.`;
            } else {
                seatInstruction.textContent = `Pilih kursi untuk ${activePassenger.name}.`;
            }

            document.querySelectorAll(".seat[data-id]").forEach(seat => {
                seat.classList.remove("selected", "occupied");
                delete seat.dataset.originalSeat;
            });

            passengers.forEach(passenger => {
                if (!passenger.seat) return;
                const seatElement = document.querySelector(`.seat[data-seat="${passenger.seat}"]`);
                if (!seatElement) return;

                if (passenger.id === activePassengerId) {
                    seatElement.classList.add("selected");
                } else {
                    seatElement.classList.add("occupied");
                    seatElement.dataset.originalSeat = passenger.seat;
                }
            });

            renderPassengers();
        }

        /*
        ============================================================
        CANCEL SEAT
        ============================================================
        */
        function cancelSeat(passengerId) {
            const passenger = passengers.find(p => p.id === passengerId);
            if (!passenger || !passenger.seat) return;

            const oldSeat = passenger.seat;
            passenger.seat = null;
            activePassengerId = passengerId;

            renderPassengers();
            renderSummary();
            updateSeatDisplay();
            updatePrice();

            showToast(`Kursi ${oldSeat} untuk ${passenger.name} berhasil dibatalkan.`);
        }

        /*
        ============================================================
        SEAT CLICK
        ============================================================
        */
        document.querySelectorAll('.seat[data-id]').forEach(seat => {
            seat.addEventListener("click", function() {
                const activePassenger = passengers.find(p => p.id === activePassengerId);
                if (!activePassenger) return;

                const seatId = seat.dataset.id;
                const seatNumber = seat.dataset.seat;

                const seatOwner = passengers.find(p => p.seat === seatNumber && p.id !== activePassengerId);
                if (seatOwner) {
                    showToast(`Kursi ${seatNumber} sudah dipilih oleh ${seatOwner.name}.`);
                    return;
                }

                activePassenger.seat = seatNumber;

                renderPassengers();
                renderSummary();
                updateSeatDisplay();
                updatePrice();

                showToast(`Kursi ${seatNumber} dipilih untuk ${activePassenger.name}.`);
            });
        });

        /*
        ============================================================
        PASSENGER COUNT CHANGE
        ============================================================
        */
        passengerCount.addEventListener("change", function() {
            createPassengers(parseInt(this.value));
        });

        /*
        ============================================================
        PRICE
        ============================================================
        */
        function updatePrice() {
            const passengerAmount = passengers.length;
            const selectedSeats = passengers.filter(p => p.seat !== null).length;

            const flightTotal = FLIGHT_PRICE * passengerAmount;
            const seatTotal = passengers.reduce((sum, p) => {
                if (!p.seat) return sum;
                const id = dataSeatMap[p.seat];
                return id && seatData[id] ? sum + seatData[id].price : sum;
            }, 0);

            flightPrice.textContent = formatRupiah(flightTotal);
            flightPriceLabel.textContent = formatRupiah(flightTotal);
            seatPrice.textContent = formatRupiah(seatTotal);
            totalPrice.textContent = formatRupiah(flightTotal + seatTotal);
            passengerTotalLabel.textContent = `${passengerAmount} Penumpang`;
        }

        /*
        ============================================================
        TOAST
        ============================================================
        */
        function showToast(message) {
            const existingToast = document.getElementById("gozay-toast");
            if (existingToast) existingToast.remove();

            const toast = document.createElement("div");
            toast.id = "gozay-toast";
            toast.className = "fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] bg-go-navy text-white px-5 py-3 rounded-2xl shadow-2xl text-xs font-bold flex items-center gap-2";
            toast.innerHTML = `
                <span class="material-symbols-outlined text-[17px] text-orange-300">info</span>
                ${message}`;
            document.body.appendChild(toast);

            setTimeout(() => toast.remove(), 2500);
        }

        /*
        ============================================================
        CONTINUE PAYMENT
        ============================================================
        */
        document.getElementById("continue-form").addEventListener("submit", function(e) {
            const unselectedPassengers = passengers.filter(p => !p.seat);
            if (unselectedPassengers.length > 0) {
                e.preventDefault();
                const names = unselectedPassengers.map(p => p.name).join(", ");
                alert(`Silakan pilih kursi untuk:\n\n${names}`);
                return;
            }

            if (!isLoggedIn) {
                e.preventDefault();
                if (window.Swal) {
                    Swal.fire({ icon: 'warning', title: 'Silakan login dahulu', text: 'Anda harus login untuk melanjutkan pemesanan.' })
                        .then(() => { window.location.href = '{{ route('login') }}'; });
                } else {
                    window.location.href = '{{ route('login') }}';
                }
                return;
            }

            const hiddenContainer = document.getElementById("selected-seats-container");
            hiddenContainer.innerHTML = "";
            passengers.forEach(p => {
                const id = dataSeatMap[p.seat];
                if (!id) return;
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "seats[]";
                input.value = id;
                hiddenContainer.appendChild(input);
            });
        });

        /*
        ============================================================
        CLASS FILTER
        ============================================================
        */
        document.getElementById("seat-class").addEventListener("change", function() {
            const value = this.value;
            document.querySelectorAll(".seat-panel").forEach(panel => {
                panel.style.display = panel.getAttribute("data-class-panel") === value ? "" : "none";
            });
        });

        /*
        ============================================================
        INITIALIZE
        ============================================================
        */
        createPassengers(1);
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
