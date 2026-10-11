<!DOCTYPE html>
<html class="light" lang="id" style="">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}"/>
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
                            "on-tertiary-fixed-variant": "#42474b",
                            "surface-container-low": "#f6f3f2",
                            "surface": "#fcf9f8",
                            "inverse-on-surface": "#f3f0ef",
                            "on-secondary": "#ffffff",
                            "tertiary-fixed": "#dfe3e8",
                            "inverse-surface": "#313030",
                            "primary-container": "#003a9b",
                            "primary": "#00266c",
                            "on-error-container": "#93000a",
                            "outline-variant": "#c4c6d4",
                            "surface-tint": "#3159b9",
                            "on-tertiary-fixed": "#171c20",
                            "secondary-container": "#fd6c00",
                            "background": "#fcf9f8",
                            "surface-container": "#f0edec",
                            "outline": "#747684",
                            "error-container": "#ffdad6",
                            "on-background": "#1c1b1b",
                            "surface-variant": "#e5e2e1",
                            "on-primary-fixed-variant": "#0d3fa0",
                            "primary-fixed-dim": "#b3c5ff",
                            "secondary": "#9f4200",
                            "error": "#ba1a1a",
                            "primary-fixed": "#dbe1ff",
                            "on-secondary-container": "#562000",
                            "tertiary-container": "#3d4246",
                            "on-primary-container": "#8fabff",
                            "surface-container-lowest": "#ffffff",
                            "secondary-fixed-dim": "#ffb692",
                            "on-secondary-fixed": "#341100",
                            "on-surface": "#1c1b1b",
                            "secondary-fixed": "#ffdbcb",
                            "on-primary": "#ffffff",
                            "surface-bright": "#fcf9f8",
                            "on-secondary-fixed-variant": "#7a3000",
                            "on-surface-variant": "#434652",
                            "surface-container-highest": "#e5e2e1",
                            "surface-dim": "#dcd9d9",
                            "on-tertiary-container": "#aaaeb3",
                            "on-error": "#ffffff",
                            "on-primary-fixed": "#00184a",
                            "tertiary": "#272c30",
                            "tertiary-fixed-dim": "#c3c7cc",
                            "surface-container-high": "#ebe7e7",
                            "inverse-primary": "#b3c5ff",
                            "on-tertiary": "#ffffff"
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

    @include('partials.flash')
</head>
<body class="bg-background text-on-background font-body-md selection:bg-secondary-container/30">
@include('partials.skeleton')
@php($settings = $settings ?? collect())

<!-- Header (TopNavBar): tinggi bar & posisi konten selalu tetap saat halaman di-scroll -->
<header id="site-header" class="fixed top-0 inset-x-0 z-50 bg-surface/80 backdrop-blur-xl shadow-sm border-b border-outline-variant/10 transition-colors duration-300">
    <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto relative">
        <div class="flex items-center gap-8">
            <a class="flex items-center" href="{{ route('home') }}">
                <img src="{{ asset('logo.png') }}" alt="GoZay" class="h-10 w-auto"/>
            </a>
            <nav class="hidden md:flex items-center space-x-8 absolute left-1/2 -translate-x-1/2">
                <a class="font-label-md text-label-md {{ request()->routeIs('home') ? 'text-primary border-b-2 border-secondary-container py-2 opacity-90' : 'text-on-surface-variant hover:text-primary transition-colors duration-200' }}" href="{{ route('home') }}">Home</a>
                <a class="font-label-md text-label-md {{ request()->routeIs('search.results') || request()->routeIs('flights.*') ? 'text-primary border-b-2 border-secondary-container py-2' : 'text-on-surface-variant hover:text-primary transition-colors duration-200' }}" href="{{ route('search.results') }}">Penerbangan</a>
                <a class="font-label-md text-label-md {{ request()->routeIs('destinations.index') ? 'text-primary border-b-2 border-secondary-container py-2' : 'text-on-surface-variant hover:text-primary transition-colors duration-200' }}" href="{{ route('destinations.index') }}">Destinasi</a>
                <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="{{ route('home') }}#promo">Penawaran</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            @guest
                <a class="hidden sm:block px-6 py-2.5 font-label-md font-medium text-primary hover:bg-primary/5 transition-colors duration-200 rounded-xl" href="{{ route('login') }}">Masuk</a>
                <a class="px-6 py-2.5 font-label-md font-semibold bg-secondary-container text-on-secondary hover:opacity-90 transition-all rounded-xl shadow-md" href="{{ route('register') }}">Daftar</a>
            @else
                <a class="hidden sm:block px-6 py-2.5 font-label-md font-semibold text-primary hover:bg-primary/5 transition-colors duration-200 rounded-xl"
                   href="{{ route('bookings.index') }}">Perjalanan Saya</a>
                <a href="{{ route('profile.edit') }}" title="Profil" class="hidden sm:flex w-10 h-10 items-center justify-center rounded-full text-primary hover:bg-primary/5 transition-colors duration-200">
                    <span class="material-symbols-outlined">account_circle</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 font-label-md font-semibold bg-secondary-container text-on-secondary hover:opacity-90 transition-all rounded-xl shadow-md">Keluar</button>
                </form>
            @endguest
            <button id="mobile-menu-btn" class="md:hidden p-2 text-on-surface-variant hover:text-primary transition-colors duration-200" aria-label="Menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    <!-- Mobile Nav -->
    <nav id="mobile-menu" class="hidden md:hidden bg-surface border-t border-outline-variant/10 px-margin-mobile py-6 space-y-1 shadow-lg">
        <a class="block py-3 font-label-md text-label-md font-medium text-primary border-b-2 border-secondary-container" href="{{ route('home') }}">Home</a>
        <a class="block py-3 font-label-md text-label-md {{ request()->routeIs('search.results') || request()->routeIs('flights.*') ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-primary transition-colors duration-200' }}" href="{{ route('search.results') }}">Penerbangan</a>
        <a class="block py-3 font-label-md text-label-md {{ request()->routeIs('destinations.index') ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-primary transition-colors duration-200' }}" href="{{ route('destinations.index') }}">Destinasi</a>
        <a class="block py-3 font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="{{ route('home') }}#promo">Penawaran</a>
        <a class="block py-3 font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="{{ route('bookings.index') }}">Perjalanan Saya</a>
        <a class="block py-3 font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="{{ route('profile.edit') }}">Profil</a>
    </nav>
</header>

<main class="pt-20">
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
        <p class="font-label-sm text-slate-500">© {{ date('Y') }} {{ $settings->get('contact.copyright', 'GoZay. Terbang Lebih Sering, Bayar Lebih Sedikit.') }}</p>
        <div class="flex gap-6">
            <span class="material-symbols-outlined text-slate-500">payments</span>
            <span class="material-symbols-outlined text-slate-500">credit_card</span>
            <span class="material-symbols-outlined text-slate-500">account_balance</span>
        </div>
    </div>
</footer>

<script>
    // Header: saat scroll hanya latar & bayangan yang berubah.
    // Tinggi bar (h-20) dan posisi logo/navbar/tombol tidak diutak-atik,
    // sehingga konten header tetap diam & sejajar (tidak ikut turun/bergeser).
    window.addEventListener('scroll', () => {
        const header = document.getElementById('site-header');
        if (!header) return;
        const scrolled = window.scrollY > 50;
        header.classList.toggle('bg-white/95', scrolled);
        header.classList.toggle('shadow-md', scrolled);
        header.classList.toggle('shadow-sm', !scrolled);
        header.classList.toggle('bg-surface/80', !scrolled);
    }, { passive: true });

    // Mobile menu toggle
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            const icon = menuBtn.querySelector('.material-symbols-outlined');
            if (icon) icon.textContent = mobileMenu.classList.contains('hidden') ? 'menu' : 'close';
        });
    }

    // Smooth scroll to home sections without changing the URL (stays "home")
    document.querySelectorAll('a[href^="' + window.location.origin + '/#"], a[href$="#destinasi"], a[href$="#promo"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const hash = link.getAttribute('href').split('#')[1];
            const target = document.getElementById(hash);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    const icon = menuBtn && menuBtn.querySelector('.material-symbols-outlined');
                    if (icon) icon.textContent = 'menu';
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

    // Klik panah dropdown / area sekitar <select> ikut membuka pilihan.
    // (panah arrow_drop_down diberi pointer-events-none, jadi tanpa handler ini
    //  klik pada panah tidak men-trigger dropdown native.)
    const wireSelectDropdowns = () => {
        document.querySelectorAll('#search-form .flex.items-center').forEach(wrapper => {
            const select = wrapper.querySelector('select');
            if (!select) return;
            wrapper.classList.add('cursor-pointer', 'select-none');
            wrapper.addEventListener('click', (e) => {
                if (e.target.closest('select')) return; // klik di select = perilaku native
                if (!select || select.disabled) return;
                if (typeof select.showPicker === 'function') {
                    select.showPicker();
                } else {
                    select.focus();
                }
            });
        });
    };
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', wireSelectDropdowns);
    } else {
        wireSelectDropdowns();
    }

    // Tab switching logic for search widget
    const setSectionEnabled = (root, on) => {
        if (!root) return;
        root.querySelectorAll('input, select, textarea, button').forEach(el => { el.disabled = !on; });
    };
    const singleSection = document.getElementById('route-single');
    const multiSection = document.getElementById('route-multi');
    const returnWrap = document.getElementById('return-row-wrap');
    const applyTrip = (trip) => {
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