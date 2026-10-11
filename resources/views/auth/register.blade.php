<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun GoZay - Fly More, Pay Less</title>

    <meta
        name="description"
        content="Buat akun GoZay dan nikmati pengalaman booking penerbangan yang cepat, aman, dan nyaman."
    >

    <meta name="theme-color" content="#FF7A00">

    <!-- Favicon (Logo GoZay) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0"
        rel="stylesheet"
    >

    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#FF7A00",
                        "primary-dark": "#E56600",

                        secondary: "#FF9F43",
                        "secondary-dark": "#E67E22",

                        ink: "#171717",
                        muted: "#737373",

                        soft: "#FFF8F2"
                    },

                    fontFamily: {
                        jakarta: ["Plus Jakarta Sans", "sans-serif"]
                    },

                    boxShadow: {
                        premium:
                            "0 30px 80px rgba(255, 122, 0, 0.12)",

                        card:
                            "0 20px 60px rgba(23, 23, 23, 0.10)"
                    }
                }
            }
        };
    </script>


    <!-- ==============================
         CUSTOM CSS
    =============================== -->
    <style>

        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            margin: 0;

            font-family:
                "Plus Jakarta Sans",
                sans-serif;

            color: #171717;

            background:
                radial-gradient(
                    circle at 0% 0%,
                    rgba(255, 122, 0, 0.16),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 100% 100%,
                    rgba(255, 159, 67, 0.13),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #fff8f2 0%,
                    #ffffff 48%,
                    #fff5eb 100%
                );

            overflow-x: hidden;
        }


        .material-symbols-outlined {
            font-variation-settings:
                "FILL" 0,
                "wght" 400,
                "GRAD" 0,
                "opsz" 24;
        }


        /* ==============================
           BACKGROUND
        =============================== */

        .orb {
            position: fixed;

            border-radius: 9999px;

            pointer-events: none;

            filter: blur(90px);

            z-index: -1;
        }


        .orb-orange {
            width: 430px;
            height: 430px;

            top: -190px;
            left: -130px;

            background:
                rgba(255, 122, 0, 0.15);
        }


        .orb-light {
            width: 430px;
            height: 430px;

            right: -160px;
            bottom: -190px;

            background:
                rgba(255, 178, 102, 0.16);
        }


        /* ==============================
           GLASS
        =============================== */

        .glass {
            background:
                rgba(255, 255, 255, 0.82);

            backdrop-filter:
                blur(24px);

            -webkit-backdrop-filter:
                blur(24px);

            border:
                1px solid rgba(255, 255, 255, 0.85);
        }


        /* ==============================
           HERO IMAGE
        =============================== */

        .hero-image {
            transition:
                transform 0.8s ease;
        }


        .hero-panel:hover .hero-image {
            transform:
                scale(1.04);
        }


        /* ==============================
           INPUT
        =============================== */

        .input-wrapper {
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;

            border:
                1px solid #e5e7eb;
        }


        .input-wrapper:focus-within {
            border-color:
                #FF7A00;

            box-shadow:
                0 0 0 4px
                rgba(255, 122, 0, 0.11),

                0 10px 30px
                rgba(255, 122, 0, 0.07);

            transform:
                translateY(-1px);
        }


        .input-wrapper:focus-within
        .input-icon {
            color:
                #FF7A00;
        }


        .input-icon {
            transition:
                color 0.2s ease;
        }


        /* State error dari validasi Laravel */
        .input-wrapper.is-invalid {
            border-color: #ef4444;

            box-shadow:
                0 0 0 4px
                rgba(239, 68, 68, 0.10);
        }


        /* ==============================
           CTA BUTTON
        =============================== */

        .cta-button {

            background:
                linear-gradient(
                    110deg,
                    #FF6A00 0%,
                    #FF7A00 35%,
                    #FF922E 70%,
                    #FFB15C 100%
                );

            background-size:
                200% auto;

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-position 0.4s ease;
        }


        .cta-button:hover {

            background-position:
                right center;

            transform:
                translateY(-2px);

            box-shadow:
                0 18px 38px
                rgba(255, 122, 0, 0.25);
        }


        .cta-button:active {
            transform:
                translateY(0);
        }


        /* ==============================
           SOCIAL BUTTON
        =============================== */

        .social-button {

            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }


        .social-button:hover {

            transform:
                translateY(-2px);

            background:
                #fffaf5;

            border-color:
                #fed7aa;

            box-shadow:
                0 10px 25px
                rgba(255, 122, 0, 0.08);
        }


        /* ==============================
           BADGE
        =============================== */

        .badge {

            backdrop-filter:
                blur(12px);

            -webkit-backdrop-filter:
                blur(12px);
        }


        /* ==============================
           ANIMATION
        =============================== */

        .fade-up {

            animation:
                fadeUp 0.7s ease both;
        }


        .fade-up-delay-1 {
            animation-delay:
                0.1s;
        }


        .fade-up-delay-2 {
            animation-delay:
                0.2s;
        }


        .fade-up-delay-3 {
            animation-delay:
                0.3s;
        }


        @keyframes fadeUp {

            from {
                opacity: 0;
                transform:
                    translateY(18px);
            }

            to {
                opacity: 1;
                transform:
                    translateY(0);
            }

        }


        /* ==============================
           MOBILE
        =============================== */

        @media (max-width: 767px) {

            .orb {
                filter:
                    blur(70px);
            }

        }


    </style>

</head>


<body class="min-h-screen">

@include('partials.skeleton')


    <!-- =====================================
         BACKGROUND DECORATION
    ====================================== -->

    <div class="orb orb-orange"></div>

    <div class="orb orb-light"></div>


    <!-- =====================================
         NAVBAR
    ====================================== -->

    <header
        class="fixed left-0 right-0 top-0 z-50"
    >

        <div
            class="mx-auto max-w-7xl
                   px-4 sm:px-6 lg:px-8"
        >

            <div
                class="mt-4 flex h-16
                       items-center justify-between
                       rounded-2xl
                       border border-white/80
                       bg-white/80
                       px-4
                       shadow-sm
                       backdrop-blur-xl
                       sm:px-6"
            >


                <!-- LOGO -->

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-2.5"
                    aria-label="GoZay Home"
                >

                    <img
                        src="{{ asset('logo.png') }}"
                        alt="GoZay Logo"
                        class="h-8 w-auto"
                    >

                </a>


                <!-- LOGIN -->

                <div
                    class="flex items-center gap-3 text-sm"
                >

                    <span
                        class="hidden
                               text-slate-500
                               sm:inline"
                    >
                        Sudah punya akun?
                    </span>


                    <a
                        href="{{ route('login') }}"
                        class="rounded-xl
                               bg-slate-900
                               px-4 py-2.5
                               font-semibold
                               text-white
                               transition
                               hover:bg-primary"
                    >
                        Masuk
                    </a>

                </div>

            </div>

        </div>

    </header>



    <!-- =====================================
         MAIN
    ====================================== -->

    <main
        class="px-4 pb-12
               pt-28
               sm:px-6
               lg:px-8"
    >

        <div
            class="mx-auto max-w-6xl"
        >


            <!-- =====================================
                 MAIN CARD
            ====================================== -->

            <div
                class="glass
                       overflow-hidden
                       rounded-[30px]
                       shadow-premium
                       lg:grid
                       lg:grid-cols-[0.9fr_1.1fr]"
            >


                <!-- =====================================
                     HERO SECTION
                ====================================== -->

                <section
                    class="hero-panel
                           relative
                           min-h-[340px]
                           overflow-hidden
                           lg:min-h-[760px]"
                >


                    <!-- HERO IMAGE -->

                    <img
                        src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1600&q=80"
                        alt="Pemandangan dari jendela pesawat"
                        class="hero-image
                               absolute
                               inset-0
                               h-full
                               w-full
                               object-cover"
                    >


                    <!-- DARK OVERLAY -->

                    <div
                        class="absolute
                               inset-0
                               bg-gradient-to-b
                               from-black/10
                               via-[#3A1800]/25
                               to-[#1E0B00]/95"
                    ></div>


                    <!-- ORANGE GLOW -->

                    <div
                        class="absolute
                               -right-24
                               -top-24
                               h-72
                               w-72
                               rounded-full
                               bg-orange-400/10
                               blur-3xl"
                    ></div>


                    <!-- HERO CONTENT -->

                    <div
                        class="relative
                               z-10
                               flex
                               h-full
                               min-h-[340px]
                               flex-col
                               justify-between
                               p-6
                               sm:p-8
                               lg:min-h-[760px]
                               lg:p-10"
                    >


                        <!-- HERO TOP -->

                        <div
                            class="flex
                                   items-center
                                   justify-between"
                        >


                            <!-- BRAND BADGE -->

                            <div
                                class="badge
                                       inline-flex
                                       items-center
                                       gap-2
                                       rounded-full
                                       border
                                       border-white/20
                                       bg-white/10
                                       px-3.5
                                       py-2
                                       text-xs
                                       font-semibold
                                       text-white"
                            >

                                <span
                                    class="material-symbols-outlined
                                           text-[17px]"
                                >
                                    flight_takeoff
                                </span>

                                GoZay Travel

                            </div>


                            <!-- STATUS -->

                            <div
                                class="badge
                                       hidden
                                       items-center
                                       gap-2
                                       rounded-full
                                       border
                                       border-white/20
                                       bg-white/10
                                       px-3.5
                                       py-2
                                       text-xs
                                       font-medium
                                       text-white/90
                                       sm:flex"
                            >

                                <span
                                    class="h-2
                                           w-2
                                           rounded-full
                                           bg-emerald-400"
                                ></span>

                                Perjalanan dimulai

                            </div>

                        </div>



                        <!-- HERO BOTTOM -->

                        <div
                            class="max-w-xl"
                        >


                            <!-- SMALL BADGE -->

                            <div
                                class="fade-up
                                       mb-4
                                       inline-flex
                                       items-center
                                       gap-2
                                       rounded-full
                                       bg-orange-500/20
                                       px-3
                                       py-1.5
                                       text-xs
                                       font-semibold
                                       text-orange-100
                                       backdrop-blur-md"
                            >

                                <span
                                    class="material-symbols-outlined
                                           text-[16px]"
                                >
                                    public
                                </span>

                                Terbang lebih jauh

                            </div>


                            <!-- TITLE -->

                            <h1
                                class="fade-up-delay-1
                                       text-3xl
                                       font-extrabold
                                       leading-tight
                                       tracking-tight
                                       text-white
                                       sm:text-4xl
                                       lg:text-5xl"
                            >

                                Mulai perjalanan

                                <span
                                    class="text-orange-300"
                                >
                                    global
                                </span>

                                Anda.

                            </h1>


                            <!-- DESCRIPTION -->

                            <p
                                class="fade-up-delay-2
                                       mt-4
                                       max-w-lg
                                       text-sm
                                       leading-7
                                       text-white/75
                                       sm:text-base"
                            >

                                Bergabung dengan GoZay dan temukan
                                pengalaman booking penerbangan yang
                                cepat, aman, dan nyaman ke berbagai
                                destinasi.

                            </p>


                            <!-- STATS -->

                            <div
                                class="fade-up-delay-3
                                       mt-7
                                       grid
                                       max-w-lg
                                       grid-cols-3
                                       gap-2
                                       sm:gap-3"
                            >


                                <!-- STAT 1 -->

                                <div
                                    class="rounded-2xl
                                           border
                                           border-white/15
                                           bg-white/10
                                           p-3
                                           backdrop-blur-md
                                           sm:p-4"
                                >

                                    <div
                                        class="text-lg
                                               font-extrabold
                                               text-white
                                               sm:text-xl"
                                    >
                                        500+
                                    </div>

                                    <div
                                        class="mt-1
                                               text-[10px]
                                               font-medium
                                               text-white/60
                                               sm:text-xs"
                                    >
                                        Destinasi
                                    </div>

                                </div>


                                <!-- STAT 2 -->

                                <div
                                    class="rounded-2xl
                                           border
                                           border-white/15
                                           bg-white/10
                                           p-3
                                           backdrop-blur-md
                                           sm:p-4"
                                >

                                    <div
                                        class="text-lg
                                               font-extrabold
                                               text-white
                                               sm:text-xl"
                                    >
                                        10
                                    </div>

                                    <div
                                        class="mt-1
                                               text-[10px]
                                               font-medium
                                               text-white/60
                                               sm:text-xs"
                                    >
                                        Maskapai
                                    </div>

                                </div>


                                <!-- STAT 3 -->

                                <div
                                    class="rounded-2xl
                                           border
                                           border-white/15
                                           bg-white/10
                                           p-3
                                           backdrop-blur-md
                                           sm:p-4"
                                >

                                    <div
                                        class="text-lg
                                               font-extrabold
                                               text-white
                                               sm:text-xl"
                                    >
                                        24/7
                                    </div>

                                    <div
                                        class="mt-1
                                               text-[10px]
                                               font-medium
                                               text-white/60
                                               sm:text-xs"
                                    >
                                        Support
                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                </section>



                <!-- =====================================
                     REGISTER SECTION
                ====================================== -->

                <section
                    class="bg-white/90
                           p-6
                           sm:p-9
                           lg:p-12"
                >

                    <div
                        class="mx-auto max-w-xl"
                    >


                        <!-- =================================
                             FORM HEADER
                        ================================== -->

                        <div
                            class="mb-7"
                        >


                            <!-- STEP INDICATOR -->

                            <div
                                class="mb-5
                                       flex
                                       items-center
                                       gap-3"
                            >

                                <!-- STEP 1 -->

                                <div
                                    class="flex
                                           items-center
                                           gap-2"
                                >

                                    <span
                                        class="flex
                                               h-7
                                               w-7
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-primary
                                               text-xs
                                               font-bold
                                               text-white"
                                    >
                                        1
                                    </span>

                                    <span
                                        class="text-xs
                                               font-bold
                                               text-slate-800"
                                    >
                                        Buat akun
                                    </span>

                                </div>


                                <!-- LINE -->

                                <div
                                    class="h-px
                                           flex-1
                                           bg-slate-200"
                                ></div>


                                <!-- STEP 2 -->

                                <div
                                    class="flex
                                           items-center
                                           gap-2"
                                >

                                    <span
                                        class="flex
                                               h-7
                                               w-7
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-slate-100
                                               text-xs
                                               font-bold
                                               text-slate-400"
                                    >
                                        2
                                    </span>

                                    <span
                                        class="hidden
                                               text-xs
                                               font-semibold
                                               text-slate-400
                                               sm:inline"
                                    >
                                        Verifikasi
                                    </span>

                                </div>

                            </div>



                            <!-- SMALL TITLE -->

                            <p
                                class="mb-2
                                       text-sm
                                       font-bold
                                       tracking-wide
                                       text-primary"
                            >
                                SELAMAT DATANG DI GOZAY
                            </p>


                            <!-- TITLE -->

                            <h2
                                class="text-3xl
                                       font-extrabold
                                       tracking-tight
                                       text-slate-900"
                            >
                                Buat akun baru
                            </h2>


                            <!-- DESCRIPTION -->

                            <p
                                class="mt-2
                                       text-sm
                                       leading-6
                                       text-slate-500"
                            >
                                Lengkapi data diri Anda untuk memulai
                                perjalanan bersama GoZay.
                            </p>

                        </div>



                        <!-- =================================
                             FORM
                             (submitted ke Laravel: route register)
                        ================================== -->

                        <form
                            id="registerForm"
                            method="POST"
                            action="{{ route('register') }}"
                            class="space-y-5"
                            novalidate
                        >

                            @csrf

                            <!-- Hidden: Laravel mewajibkan konfirmasi password,
                                 nilai disinkron otomatis oleh JS sebelum submit -->
                            <input type="hidden" name="password_confirmation" id="password_confirmation" value="">


                            <!-- =============================
                                 NAME
                            ============================== -->

                            <div>

                                <label
                                    for="name"
                                    class="mb-2
                                           block
                                           text-sm
                                           font-semibold
                                           text-slate-700"
                                >
                                    Nama Lengkap
                                </label>


                                <div
                                    class="input-wrapper
                                           @error('name') is-invalid @enderror
                                           relative
                                           flex
                                           items-center
                                           rounded-2xl
                                           bg-slate-50/70"
                                >

                                    <span
                                        class="input-icon
                                               material-symbols-outlined
                                               pointer-events-none
                                               absolute
                                               left-4
                                               text-slate-400"
                                    >
                                        person
                                    </span>


                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        autocomplete="name"
                                        placeholder="Masukkan nama lengkap"
                                        value="{{ old('name') }}"
                                        class="w-full
                                               rounded-2xl
                                               border-0
                                               bg-transparent
                                               py-4
                                               pl-12
                                               pr-4
                                               text-sm
                                               font-medium
                                               text-slate-900
                                               outline-none
                                               placeholder:text-slate-400
                                               focus:ring-0"
                                    >

                                </div>

                                @error('name')
                                    <p class="mt-1.5 px-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror

                            </div>



                            <!-- =============================
                                 NIK
                            ============================== -->

                            <div>

                                <label
                                    for="nik"
                                    class="mb-2
                                           block
                                           text-sm
                                           font-semibold
                                           text-slate-700"
                                >

                                    NIK

                                    <span
                                        class="font-normal
                                               text-slate-400"
                                    >
                                        (16 digit)
                                    </span>

                                </label>


                                <div
                                    class="input-wrapper
                                           @error('nik') is-invalid @enderror
                                           relative
                                           flex
                                           items-center
                                           rounded-2xl
                                           bg-slate-50/70"
                                >

                                    <span
                                        class="input-icon
                                               material-symbols-outlined
                                               pointer-events-none
                                               absolute
                                               left-4
                                               text-slate-400"
                                    >
                                        badge
                                    </span>


                                    <input
                                        id="nik"
                                        name="nik"
                                        type="text"
                                        inputmode="numeric"
                                        maxlength="16"
                                        autocomplete="off"
                                        placeholder="Masukkan 16 digit NIK"
                                        value="{{ old('nik') }}"
                                        class="w-full
                                               rounded-2xl
                                               border-0
                                               bg-transparent
                                               py-4
                                               pl-12
                                               pr-4
                                               text-sm
                                               font-medium
                                               text-slate-900
                                               outline-none
                                               placeholder:text-slate-400
                                               focus:ring-0"
                                    >

                                </div>

                                @error('nik')
                                    <p class="mt-1.5 px-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror

                            </div>



                            <!-- =============================
                                 EMAIL
                            ============================== -->

                            <div>

                                <label
                                    for="email"
                                    class="mb-2
                                           block
                                           text-sm
                                           font-semibold
                                           text-slate-700"
                                >
                                    Alamat Email
                                </label>


                                <div
                                    class="input-wrapper
                                           @error('email') is-invalid @enderror
                                           relative
                                           flex
                                           items-center
                                           rounded-2xl
                                           bg-slate-50/70"
                                >

                                    <span
                                        class="input-icon
                                               material-symbols-outlined
                                               pointer-events-none
                                               absolute
                                               left-4
                                               text-slate-400"
                                    >
                                        mail
                                    </span>


                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        placeholder="nama@email.com"
                                        value="{{ old('email') }}"
                                        class="w-full
                                               rounded-2xl
                                               border-0
                                               bg-transparent
                                               py-4
                                               pl-12
                                               pr-4
                                               text-sm
                                               font-medium
                                               text-slate-900
                                               outline-none
                                               placeholder:text-slate-400
                                               focus:ring-0"
                                    >

                                </div>

                                @error('email')
                                    <p class="mt-1.5 px-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror

                            </div>



                            <!-- =============================
                                 PHONE
                            ============================== -->

                            <div>

                                <label
                                    for="phone"
                                    class="mb-2
                                           block
                                           text-sm
                                           font-semibold
                                           text-slate-700"
                                >
                                    Nomor Telepon
                                </label>


                                <div
                                    class="input-wrapper
                                           @error('phone') is-invalid @enderror
                                           relative
                                           flex
                                           items-center
                                           rounded-2xl
                                           bg-slate-50/70"
                                >

                                    <span
                                        class="input-icon
                                               material-symbols-outlined
                                               pointer-events-none
                                               absolute
                                               left-4
                                               text-slate-400"
                                    >
                                        call
                                    </span>


                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        autocomplete="tel"
                                        placeholder="0812 3456 7890"
                                        value="{{ old('phone') }}"
                                        class="w-full
                                               rounded-2xl
                                               border-0
                                               bg-transparent
                                               py-4
                                               pl-12
                                               pr-4
                                               text-sm
                                               font-medium
                                               text-slate-900
                                               outline-none
                                               placeholder:text-slate-400
                                               focus:ring-0"
                                    >

                                </div>

                                @error('phone')
                                    <p class="mt-1.5 px-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror

                            </div>



                            <!-- =============================
                                 PASSWORD
                            ============================== -->

                            <div>

                                <label
                                    for="password"
                                    class="mb-2
                                           block
                                           text-sm
                                           font-semibold
                                           text-slate-700"
                                >
                                    Kata Sandi
                                </label>


                                <div
                                    class="input-wrapper
                                           @error('password') is-invalid @enderror
                                           relative
                                           flex
                                           items-center
                                           rounded-2xl
                                           bg-slate-50/70"
                                >

                                    <span
                                        class="input-icon
                                               material-symbols-outlined
                                               pointer-events-none
                                               absolute
                                               left-4
                                               text-slate-400"
                                    >
                                        lock
                                    </span>


                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="new-password"
                                        placeholder="Minimal 8 karakter"
                                        class="w-full
                                               rounded-2xl
                                               border-0
                                               bg-transparent
                                               py-4
                                               pl-12
                                               pr-12
                                               text-sm
                                               font-medium
                                               text-slate-900
                                               outline-none
                                               placeholder:text-slate-400
                                               focus:ring-0"
                                    >


                                    <!-- PASSWORD TOGGLE -->

                                    <button
                                        type="button"
                                        id="togglePassword"
                                        aria-label="Tampilkan password"
                                        class="absolute
                                               right-4
                                               text-slate-400
                                               transition
                                               hover:text-primary"
                                    >

                                        <span
                                            id="passwordIcon"
                                            class="material-symbols-outlined"
                                        >
                                            visibility
                                        </span>

                                    </button>

                                </div>

                                @error('password')
                                    <p class="mt-1.5 px-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror


                                <!-- PASSWORD STRENGTH -->

                                <div
                                    class="mt-2
                                           flex
                                           items-center
                                           gap-2"
                                >

                                    <div
                                        class="h-1.5
                                               flex-1
                                               overflow-hidden
                                               rounded-full
                                               bg-slate-100"
                                    >

                                        <div
                                            id="passwordStrengthBar"
                                            class="h-full
                                                   w-0
                                                   rounded-full
                                                   bg-slate-300
                                                   transition-all"
                                        ></div>

                                    </div>


                                    <span
                                        id="passwordStrength"
                                        class="text-[11px]
                                               font-bold
                                               whitespace-nowrap
                                               text-slate-400"
                                    >
                                        Password -
                                    </span>

                                </div>


                                <p
                                    class="mt-2
                                           px-1
                                           text-xs
                                           text-slate-400"
                                >
                                    Gunakan minimal 8 karakter dengan
                                    kombinasi angka dan huruf.
                                </p>

                            </div>



                            <!-- =============================
                                 TERMS
                            ============================== -->

                            <div
                                class="@error('terms') !mb-2 @enderror
                                       flex
                                       items-start
                                       gap-3
                                       pt-1"
                            >

                                <input
                                    id="terms"
                                    name="terms"
                                    type="checkbox"
                                    @checked(old('terms'))
                                    class="mt-1
                                           h-4
                                           w-4
                                           rounded
                                           border-slate-300
                                           text-primary
                                           focus:ring-primary"
                                >


                                <label
                                    for="terms"
                                    class="text-xs
                                           leading-5
                                           text-slate-500"
                                >

                                    Saya setuju dengan

                                    <a
                                        href="#"
                                        class="font-bold
                                               text-primary
                                               hover:underline"
                                    >
                                        Syarat &amp; Ketentuan
                                    </a>

                                    serta

                                    <a
                                        href="#"
                                        class="font-bold
                                               text-primary
                                               hover:underline"
                                    >
                                        Kebijakan Privasi
                                    </a>

                                    GoZay.

                                </label>

                            </div>

                            @error('terms')
                                <p class="mt-1 px-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror



                            <!-- =============================
                                 SUBMIT
                            ============================== -->

                            <button
                                type="submit"
                                class="cta-button
                                       flex
                                       w-full
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-2xl
                                       py-4
                                       text-sm
                                       font-extrabold
                                       text-white
                                       shadow-lg"
                            >

                                <span>
                                    Daftar Sekarang
                                </span>


                                <span
                                    class="material-symbols-outlined
                                           text-[20px]"
                                >
                                    arrow_forward
                                </span>

                            </button>


                        </form>



                        <!-- =================================
                             LOGIN LINK
                        ================================== -->

                        <p
                            class="mt-7
                                   text-center
                                   text-sm
                                   text-slate-500"
                        >

                            Sudah punya akun?

                            <a
                                href="{{ route('login') }}"
                                class="font-extrabold
                                       text-primary
                                       hover:underline"
                            >
                                Masuk di sini
                            </a>

                        </p>


                    </div>

                </section>

            </div>

        </div>

    </main>



    <!-- =====================================
         FOOTER
    ====================================== -->

    <footer
        class="px-5
               pb-8
               sm:px-8"
    >

        <div
            class="mx-auto
                   flex
                   max-w-6xl
                   flex-col
                   items-center
                   justify-between
                   gap-4
                   text-xs
                   text-slate-400
                   sm:flex-row"
        >

            <p>
                © 2026 GoZay. Fly More, Pay Less.
            </p>


            <div
                class="flex
                       items-center
                       gap-5"
            >

                <a
                    href="{{ route('home') }}"
                    class="transition
                           hover:text-primary"
                >
                    Bantuan
                </a>


                <a
                    href="#"
                    class="transition
                           hover:text-primary"
                >
                    Keamanan
                </a>


                <a
                    href="#"
                    class="transition
                           hover:text-primary"
                >
                    Bahasa Indonesia
                </a>

            </div>

        </div>

    </footer>



    <!-- =====================================
         JAVASCRIPT
    ====================================== -->

    <script>


        /* ==================================
           PASSWORD TOGGLE
        ================================== */

        const passwordInput =
            document.getElementById(
                "password"
            );


        const togglePassword =
            document.getElementById(
                "togglePassword"
            );


        const passwordIcon =
            document.getElementById(
                "passwordIcon"
            );


        togglePassword.addEventListener(
            "click",
            () => {

                const isPassword =
                    passwordInput.type ===
                    "password";


                passwordInput.type =
                    isPassword
                        ? "text"
                        : "password";


                passwordIcon.textContent =
                    isPassword
                        ? "visibility_off"
                        : "visibility";


                togglePassword.setAttribute(
                    "aria-label",

                    isPassword
                        ? "Sembunyikan password"
                        : "Tampilkan password"
                );

            }
        );



        /* ==================================
           NIK VALIDATION
        ================================== */

        const nikInput =
            document.getElementById(
                "nik"
            );


        nikInput.addEventListener(
            "input",
            () => {

                nikInput.value =
                    nikInput.value
                        .replace(
                            /\D/g,
                            ""
                        )
                        .slice(
                            0,
                            16
                        );

            }
        );



        /* ==================================
           PHONE VALIDATION
        ================================== */

        const phoneInput =
            document.getElementById(
                "phone"
            );


        phoneInput.addEventListener(
            "input",
            () => {

                phoneInput.value =
                    phoneInput.value
                        .replace(
                            /[^\d+\s-]/g,
                            ""
                        );

            }
        );



        /* ==================================
           PASSWORD STRENGTH
        ================================== */

        const strengthBar =
            document.getElementById(
                "passwordStrengthBar"
            );


        const strengthText =
            document.getElementById(
                "passwordStrength"
            );


        passwordInput.addEventListener(
            "input",
            () => {

                const password =
                    passwordInput.value;


                let score = 0;


                if (
                    password.length >= 8
                ) {
                    score++;
                }


                if (
                    /[A-Z]/.test(password)
                ) {
                    score++;
                }


                if (
                    /[0-9]/.test(password)
                ) {
                    score++;
                }


                if (
                    /[^A-Za-z0-9]/.test(
                        password
                    )
                ) {
                    score++;
                }


                const states = {

                    0: {
                        width: "0%",
                        text: "Password -",
                        bar: "bg-slate-300",
                        textColor:
                            "text-slate-400"
                    },

                    1: {
                        width: "25%",
                        text: "Password lemah",
                        bar: "bg-red-400",
                        textColor:
                            "text-red-500"
                    },

                    2: {
                        width: "50%",
                        text: "Password sedang",
                        bar: "bg-orange-400",
                        textColor:
                            "text-orange-500"
                    },

                    3: {
                        width: "75%",
                        text: "Password bagus",
                        bar: "bg-orange-500",
                        textColor:
                            "text-orange-600"
                    },

                    4: {
                        width: "100%",
                        text: "Password kuat",
                        bar: "bg-emerald-500",
                        textColor:
                            "text-emerald-500"
                    }

                };


                const state =
                    states[score];


                strengthBar.style.width =
                    state.width;


                strengthBar.className =
                    `h-full rounded-full transition-all ${state.bar}`;


                strengthText.textContent =
                    state.text;


                strengthText.className =
                    `text-[11px] font-bold whitespace-nowrap ${state.textColor}`;

            }
        );



        /* ==================================
           FORM SUBMIT
           (validasi di sisi klien; jika valid,
            form dikirim ke Laravel - POST route register)
        ================================== */

        const registerForm =
            document.getElementById(
                "registerForm"
            );


        const passwordConfirmation =
            document.getElementById(
                "password_confirmation"
            );


        registerForm.addEventListener(
            "submit",
            (event) => {

                const name =
                    document
                        .getElementById(
                            "name"
                        )
                        .value
                        .trim();


                const nik =
                    document
                        .getElementById(
                            "nik"
                        )
                        .value
                        .trim();


                const email =
                    document
                        .getElementById(
                            "email"
                        )
                        .value
                        .trim();


                const phone =
                    document
                        .getElementById(
                            "phone"
                        )
                        .value
                        .trim();


                const password =
                    passwordInput.value;


                const terms =
                    document
                        .getElementById(
                            "terms"
                        )
                        .checked;



                /* NAME */

                if (!name) {

                    alert(
                        "Silakan masukkan nama lengkap."
                    );

                    document
                        .getElementById(
                            "name"
                        )
                        .focus();

                    event.preventDefault();

                    return;
                }



                /* NIK */

                if (
                    nik.length !== 16
                ) {

                    alert(
                        "NIK harus terdiri dari 16 digit."
                    );

                    nikInput.focus();

                    event.preventDefault();

                    return;
                }



                /* EMAIL */

                if (!email) {

                    alert(
                        "Silakan masukkan alamat email."
                    );

                    document
                        .getElementById(
                            "email"
                        )
                        .focus();

                    event.preventDefault();

                    return;
                }



                /* PHONE */

                if (!phone) {

                    alert(
                        "Silakan masukkan nomor telepon."
                    );

                    phoneInput.focus();

                    event.preventDefault();

                    return;
                }



                /* PASSWORD */

                if (
                    password.length < 8
                ) {

                    alert(
                        "Kata sandi minimal 8 karakter."
                    );

                    passwordInput.focus();

                    event.preventDefault();

                    return;
                }



                /* TERMS */

                if (!terms) {

                    alert(
                        "Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi."
                    );

                    document
                        .getElementById(
                            "terms"
                        )
                        .focus();

                    event.preventDefault();

                    return;
                }



                /* ==================================
                   VALIDASI LOLOS.
                   Sinkron konfirmasi password lalu
                   biarkan form dikirim ke Laravel
                   (POST /register -> validasi server
                    -> kirim OTP -> halaman verifikasi).
                ================================== */

                passwordConfirmation.value =
                    password;

            }
        );

    </script>


</body>
</html>