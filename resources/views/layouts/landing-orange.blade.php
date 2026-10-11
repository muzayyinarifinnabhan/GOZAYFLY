<!DOCTYPE html>
<html class="light" lang="id" style="">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}"/>
    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "on-primary-fixed-variant": "#783100",
                            "secondary-container": "#98b1fe",
                            "surface-container-low": "#fff1eb",
                            "surface-dim": "#eed5ca",
                            "secondary": "#415ba2",
                            "error": "#BA1A1A",
                            "surface-container-high": "#fde3d8",
                            "on-background": "#261912",
                            "primary-fixed-dim": "#ffb691",
                            "surface-bright": "#fff8f6",
                            "inverse-surface": "#3c2d26",
                            "tertiary-container": "#979ca1",
                            "on-secondary": "#ffffff",
                            "inverse-primary": "#ffb691",
                            "primary": "#9e4300",
                            "on-tertiary-fixed-variant": "#42474c",
                            "surface-variant": "#f7ddd2",
                            "surface-container": "#ffeae0",
                            "on-secondary-fixed-variant": "#274388",
                            "error-container": "#ffdad6",
                            "primary-container": "#ff7000",
                            "on-primary-fixed": "#341100",
                            "tertiary-fixed-dim": "#c2c7cc",
                            "on-secondary-container": "#264187",
                            "on-tertiary": "#ffffff",
                            "outline": "#747684",
                            "on-surface": "#1C1B1B",
                            "on-tertiary-container": "#2f3438",
                            "tertiary-fixed": "#dfe3e8",
                            "secondary-fixed": "#dbe1ff",
                            "on-secondary-fixed": "#00184a",
                            "background": "#fff8f6",
                            "inverse-on-surface": "#ffede6",
                            "on-surface-variant": "#594236",
                            "surface-tint": "#9e4300",
                            "surface": "#FCF9F8",
                            "outline-variant": "#e1c0b0",
                            "surface-container-highest": "#f7ddd2",
                            "secondary-fixed-dim": "#b3c5ff",
                            "surface-container-lowest": "#ffffff",
                            "on-tertiary-fixed": "#171c20",
                            "primary-fixed": "#ffdbcb",
                            "on-error-container": "#93000a",
                            "on-primary": "#ffffff",
                            "tertiary": "#5a5f63",
                            "on-primary-container": "#592300",
                            "on-error": "#ffffff"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "full": "9999px"
                        },
                        "spacing": {
                            "stack-lg": "48px",
                            "stack-md": "24px",
                            "stack-sm": "12px",
                            "gutter-desktop": "24px",
                            "margin-desktop": "40px",
                            "container-max": "1280px",
                            "base": "8px",
                            "margin-mobile": "20px"
                        },
                        "fontFamily": {
                            "body-md": ["Plus Jakarta Sans"],
                            "label-sm": ["Plus Jakarta Sans"],
                            "display-lg": ["Plus Jakarta Sans"],
                            "headline-lg-mobile": ["Plus Jakarta Sans"],
                            "headline-lg": ["Plus Jakarta Sans"],
                            "label-md": ["Plus Jakarta Sans"],
                            "headline-md": ["Plus Jakarta Sans"],
                            "body-lg": ["Plus Jakarta Sans"]
                        },
                        "fontSize": {
                            "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                            "label-sm": ["12px", {"lineHeight": "1", "fontWeight": "500"}],
                            "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                            "headline-lg-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                            "headline-lg": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                            "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                            "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                            "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}]
                        }
                    },
                },
            }
        } catch (_e) {}
    </script>
    <title>@yield('title', 'GoZay - Terbang Lebih Sering, Bayar Lebih Sedikit')</title>

    <style>
        .nav-main-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            transition: color .2s ease;
        }
        .nav-main-link::after {
            content: "";
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 14px;
            height: 3px;
            border-radius: 999px;
            background: #FF7000;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .2s ease;
        }
        .nav-main-link.active {
            color: #9E4300 !important;
        }
        .nav-main-link.active::after {
            transform: scaleX(1);
        }
        .nav-main-link:hover {
            color: #9E4300 !important;
        }
        @media (max-width: 767px) {
            #mobileNav {
                top: 100%;
            }
        }
    </style>

    @include('partials.flash')
    @stack('styles')
</head>
<body class="bg-background text-on-background font-body-md selection:bg-primary-container/30">
@include('partials.skeleton')
@php($settings = $settings ?? collect())

<!-- Header (TopNavBar): tinggi bar & posisi konten selalu tetap saat halaman di-scroll -->
<header class="fixed top-0 left-0 w-full z-50 bg-[#FFFCFA] border-b border-slate-200/80">
    <div class="h-20 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex items-center justify-between relative">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center shrink-0" aria-label="GoZay Home">
            <img src="{{ asset('logo.png') }}" alt="GoZay Logo" class="h-10 w-auto object-contain">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center absolute left-1/2 -translate-x-1/2 h-full gap-1">
            <a href="{{ route('home') }}" data-path="home"
               class="nav-main-link px-5 py-2 font-label-md text-label-md font-medium {{ request()->routeIs('home') ? 'active text-[#9E4300]' : 'text-[#45454D]' }}">
                Home
            </a>
            <a href="{{ route('search.results') }}" data-path="penerbangan"
               class="nav-main-link px-5 py-2 font-label-md text-label-md font-medium {{ request()->routeIs('search.results') || request()->routeIs('flights.*') ? 'active text-[#9E4300]' : 'text-[#45454D]' }}">
                Penerbangan
            </a>
            <a href="{{ route('destinations.index') }}" data-path="destinasi"
               class="nav-main-link {{ request()->routeIs('destinations.index') ? 'active' : '' }} px-5 py-2 font-label-md text-label-md font-medium text-[#9E4300]">
                Destinasi
            </a>
            <a href="{{ route('home') }}#promo" data-path="penawaran"
               class="nav-main-link px-5 py-2 font-label-md text-label-md font-medium text-[#45454D]">
                Penawaran
            </a>
        </nav>

        <!-- Auth -->
        <div class="hidden md:flex items-center gap-4 shrink-0">
            @guest
                <a href="{{ route('login') }}" data-path="masuk"
                   class="px-6 py-2.5 font-label-md font-medium text-[#9E4300] hover:text-[#FF7000] transition-colors rounded-xl">
                    Masuk
                </a>
                <a href="{{ route('register') }}" data-path="daftar"
                   class="px-6 py-2.5 font-label-md font-semibold rounded-xl bg-[#FF7000] text-white shadow-[0_5px_12px_rgba(255,112,0,0.18)] hover:bg-[#eb6200] hover:-translate-y-0.5 transition-all">
                    Daftar
                </a>
            @else
                <a href="{{ route('bookings.index') }}"
                   class="px-6 py-2.5 font-label-md font-medium text-[#9E4300] hover:text-[#FF7000] transition-colors rounded-xl">
                    Perjalanan Saya
                </a>
                <a href="{{ route('profile.edit') }}" title="Profil"
                    class="hidden sm:flex w-10 h-10 items-center justify-center rounded-full text-[#9E4300] hover:text-[#FF7000] transition-colors">
                    <span class="material-symbols-outlined">account_circle</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="px-6 py-2.5 font-label-md font-semibold rounded-xl bg-[#FF7000] text-white shadow-[0_5px_12px_rgba(255,112,0,0.18)] hover:bg-[#eb6200] hover:-translate-y-0.5 transition-all">
                        Keluar
                    </button>
                </form>
            @endguest
        </div>

        <!-- Mobile -->
        <button id="mobileMenuBtn" aria-label="Buka menu"
        class="md:hidden p-2.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors duration-200">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <line x1="4" y1="6" x2="20" y2="6"></line>
            <line x1="4" y1="12" x2="20" y2="12"></line>
            <line x1="4" y1="18" x2="20" y2="18"></line>
        </svg>
    </button>
    </div>

    <div id="mobileNav" class="hidden md:hidden absolute top-full left-0 right-0 bg-[#FFFCFA] border-b border-slate-200 shadow-lg">
        <nav class="p-4 grid gap-1">
            <a href="{{ route('home') }}" class="mobile-link px-4 py-3 rounded-xl font-semibold text-[#9E4300] hover:bg-slate-100">Home</a>
            <a href="{{ route('search.results') }}" class="mobile-link px-4 py-3 rounded-xl hover:bg-slate-100">Penerbangan</a>
            <a href="{{ route('destinations.index') }}" class="mobile-link px-4 py-3 rounded-xl {{ request()->routeIs('destinations.index') ? 'font-semibold text-[#9E4300]' : 'hover:bg-slate-100' }}">Destinasi</a>
            <a href="{{ route('home') }}#promo" class="mobile-link px-4 py-3 rounded-xl hover:bg-slate-100">Penawaran</a>
            <div class="h-px bg-slate-200 my-2"></div>
            @guest
                <a href="{{ route('login') }}" class="mobile-link px-4 py-3 rounded-xl font-semibold text-[#9E4300] hover:bg-slate-100">Masuk</a>
                <a href="{{ route('register') }}" class="mobile-link px-4 py-3 rounded-xl bg-[#FF7000] text-white font-semibold">Daftar</a>
            @else
                <a href="{{ route('bookings.index') }}" class="mobile-link px-4 py-3 rounded-xl hover:bg-slate-100">Perjalanan Saya</a>
                <a href="{{ route('profile.edit') }}" class="mobile-link px-4 py-3 rounded-xl hover:bg-slate-100">Profil</a>
            @endguest
        </nav>
    </div>
</header>

<main class="w-full pt-20 bg-background">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-tertiary border-t border-outline-variant/20 pt-10 pb-8 mt-12">
    <div class="flex flex-col md:flex-row justify-between items-start px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-12">
        <div class="max-w-xs">
            <div class="flex items-center gap-2 mb-6">
                <img src="{{ asset('logo.png') }}" alt="GoZay" class="h-9 w-auto"/>
            </div>
            <p class="font-body-md text-slate-300 mb-8">{{ $settings->get('contact.tagline', 'Mendefinisikan ulang pengalaman perjalanan domestik melalui teknologi, keterjangkauan, dan layanan prima.') }}</p>
            <div class="flex gap-4">
                <a class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-primary-500 transition-colors" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5H15.5c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12Z"/></svg>
                </a>
                <a class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-primary-500 transition-colors" href="#">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-12 flex-grow">
            <div>
                <h4 class="font-label-md text-label-md text-white mb-6 uppercase tracking-wider">Perusahaan</h4>
                <ul class="space-y-4">
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="#">Tentang Kami</a></li>
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="#">Karir</a></li>
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="#">Pers</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-label-md text-label-md text-white mb-6 uppercase tracking-wider">Penerbangan</h4>
                <ul class="space-y-4">
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="{{ route('search.results') }}">Cari Jadwal</a></li>
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="{{ route('bookings.index') }}">Riwayat Pemesanan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-label-md text-label-md text-white mb-6 uppercase tracking-wider">Bantuan</h4>
                <ul class="space-y-4">
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="#">Pusat Bantuan</a></li>
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="#">Kontak</a></li>
                    <li><a class="font-body-md text-slate-400 hover:text-[#ffb692] transition-colors" href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="font-label-sm text-slate-500">Â© {{ date('Y') }} {{ $settings->get('contact.copyright', 'GoZay. Terbang Lebih Sering, Bayar Lebih Sedikit.') }}</p>
        <div class="flex gap-6">
            <span class="material-symbols-outlined text-slate-500">payments</span>
            <span class="material-symbols-outlined text-slate-500">credit_card</span>
            <span class="material-symbols-outlined text-slate-500">account_balance</span>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const menuBtn = document.getElementById('mobileMenuBtn');
    const mobileNav = document.getElementById('mobileNav');
    if (menuBtn && mobileNav) {
        menuBtn.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });
        document.querySelectorAll('.mobile-link').forEach(link =>
            link.addEventListener('click', () => mobileNav.classList.add('hidden'))
        );
    }

    // Smooth scroll to home sections without changing the URL (stays "home")
    document.querySelectorAll('a[href^="' + window.location.origin + '/#"], a[href$="#destinasi"], a[href$="#promo"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const hash = link.getAttribute('href').split('#')[1];
            const target = document.getElementById(hash);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
                if (mobileNav && mobileNav.classList && !mobileNav.classList.contains('hidden')) {
                    mobileNav.classList.add('hidden');
                }
            }
        });
    });

    // Open native date picker for the "Berangkat - Pulang" field
    window.openDatePicker = function (el) {
        const input = el.querySelector('input[type="date"]');
        if (input && typeof input.showPicker === 'function') {
            input.showPicker();
        } else if (input) {
            input.focus();
        }
    };

    // Tab switching logic for search widget
    const setSectionEnabled = (root, on) => {
        if (!root) return;
        root.querySelectorAll('input, select, textarea, button').forEach(el => { el.disabled = !on; });
    };
    const singleSection = document.getElementById('route-single');
    const multiSection = document.getElementById('route-multi');
    const returnWrap = document.getElementById('return-row-wrap');
    const applyTrip = (trip) => {
        if (!singleSection || !multiSection) return;
        const isMulti = trip === 'multi';
        const isRound = trip === 'round';
        if (isMulti) {
            multiSection.classList.remove('hidden');
            singleSection.classList.add('hidden');
        } else {
            multiSection.classList.add('hidden');
            singleSection.classList.remove('hidden');
        }
        // Nonaktifkan bagian yang tidak aktif supaya field-nya TIDAK ikut terkirim
        // (hindari leg_origin[] kosong & duplikat passengers/seat_class yang menimpa pilihan user).
        setSectionEnabled(multiSection, isMulti);
        setSectionEnabled(singleSection, !isMulti);
        if (returnWrap) {
            setSectionEnabled(returnWrap, isRound);
            returnWrap.classList.toggle('hidden', !isRound);
        }
    };

    const tabs = document.querySelectorAll('.search-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => {
                t.classList.remove('text-primary', 'border-secondary-container');
                t.classList.add('text-on-surface-variant', 'border-transparent');
            });
            tab.classList.add('text-primary', 'border-secondary-container');
            tab.classList.remove('text-on-surface-variant', 'border-transparent');
            applyTrip(tab.dataset.trip);
        });
    });
    applyTrip('round');

    // Cegah rute asal & tujuan di kota yang sama (mis. Jakarta CGK -> Jakarta HLP)
    const searchForm = document.getElementById('search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            const sections = [document.getElementById('route-single'), document.getElementById('route-multi')];
            for (const section of sections) {
                if (!section || section.classList.contains('hidden')) continue;
                const origins = Array.from(section.querySelectorAll('select[name="origin"], select[name="leg_origin[]"]'));
                const dests = Array.from(section.querySelectorAll('select[name="destination"], select[name="leg_destination[]"]'));
                for (let i = 0; i < origins.length; i++) {
                    const oc = origins[i].selectedOptions[0]?.dataset.city;
                    const dc = dests[i]?.selectedOptions[0]?.dataset.city;
                    if (oc && oc === dc) {
                        e.preventDefault();
                        alert('Kota asal dan kota tujuan tidak boleh sama.');
                        return;
                    }
                }
            }
        });
    }

    // Multi-city: add new leg row
    const addLegBtn = document.getElementById('add-leg');
    const legs = document.getElementById('multi-legs');
    if (legs) {
        const updateLegs = () => {
            const legList = legs.querySelectorAll('.multi-leg');
            legList.forEach((leg, i) => {
                leg.classList.toggle('first-leg', i === 0);
            });
            legList.forEach(leg => {
                const btn = leg.querySelector('.remove-leg');
                if (btn) btn.style.visibility = legList.length > 1 ? 'visible' : 'hidden';
            });
        };
        legs.addEventListener('click', (e) => {
            const btn = e.target.closest('.remove-leg');
            if (btn) {
                const row = btn.closest('.multi-leg');
                if (row && legs.querySelectorAll('.multi-leg').length > 1) {
                    row.remove();
                    updateLegs();
                }
            }
        });
        if (addLegBtn) {
            addLegBtn.addEventListener('click', () => {
                const first = legs.querySelector('.multi-leg');
                if (!first) return;
                const clone = first.cloneNode(true);
                clone.querySelectorAll('select').forEach(s => { s.selectedIndex = 0; });
                legs.appendChild(clone);
                updateLegs();
            });
        }
        updateLegs();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>