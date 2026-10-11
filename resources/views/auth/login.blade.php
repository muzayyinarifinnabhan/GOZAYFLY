<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GoZay - Masuk</title>

    <!-- Favicon (Logo GoZay) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet"
    >

    <script>
        tailwind.config = {
            darkMode: "class",

            theme: {
                extend: {

                    colors: {
                        primary: "#FF7A00",
                        "primary-dark": "#E56600",

                        "primary-container": "#FF7A00",

                        secondary: "#E56600",
                        "secondary-container": "#FF7A00",

                        "on-primary": "#ffffff",
                        "on-primary-container": "#ffffff",
                        "on-secondary": "#ffffff",

                        background: "#FFF9F5",
                        surface: "#FFFFFF",
                        "surface-bright": "#FFFFFF",

                        "surface-container-lowest": "#FFFFFF",
                        "surface-container-low": "#FFF5EE",
                        "surface-container": "#F9EEE7",
                        "surface-container-high": "#F4E6DD",

                        "on-surface": "#171717",
                        "on-surface-variant": "#6B625D",

                        outline: "#A89E97",
                        "outline-variant": "#DDD3CC",

                        error: "#BA1A1A"
                    },

                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.75rem",
                        xl: "1rem",
                        "2xl": "1.25rem",
                        full: "9999px"
                    },

                    fontFamily: {
                        sans: ["Plus Jakarta Sans", "sans-serif"]
                    }
                }
            }
        };
    </script>


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

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(255, 122, 0, 0.12),
                    transparent 30%
                ),

                radial-gradient(
                    circle at 90% 90%,
                    rgba(255, 159, 67, 0.10),
                    transparent 30%
                ),

                #FFF9F5;

            color: #171717;
        }


        .fade-in {
            animation:
                fadeIn 0.8s ease-out forwards;

            opacity: 0;

            transform:
                translateY(10px);
        }


        .delay-1 {
            animation-delay:
                0.1s;
        }


        .delay-2 {
            animation-delay:
                0.2s;
        }


        .delay-3 {
            animation-delay:
                0.3s;
        }


        @keyframes fadeIn {

            to {
                opacity: 1;

                transform:
                    translateY(0);
            }

        }


        /* =========================
           INPUT FOCUS
        ========================== */

        .custom-input {
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }


        .custom-input:focus-within {

            border-color:
                #FF7A00;

            box-shadow:
                0 0 0 4px
                rgba(255, 122, 0, 0.10);

            transform:
                translateY(-1px);
        }


        .custom-input:focus-within
        .input-icon {

            color:
                #FF7A00;
        }


        .input-icon {
            transition:
                color 0.2s ease;
        }


        /* State error dari validasi Laravel */
        .custom-input.is-invalid {
            border-color: #ef4444;

            box-shadow:
                0 0 0 4px
                rgba(239, 68, 68, 0.10);
        }


        /* =========================
           LOGIN BUTTON
        ========================== */

        .login-button {

            background:
                linear-gradient(
                    110deg,
                    #FF6900,
                    #FF7A00,
                    #FF9A3D
                );

            background-size:
                200% auto;

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-position 0.4s ease;
        }


        .login-button:hover {

            background-position:
                right center;

            transform:
                translateY(-2px);

            box-shadow:
                0 14px 30px
                rgba(255, 122, 0, 0.25);
        }


        .login-button:active {
            transform:
                translateY(0);
        }


        /* =========================
           LOGO
        ========================== */

        .brand-logo {

            transition:
                transform 0.25s ease;
        }


        .brand-logo:hover {

            transform:
                scale(1.03);
        }


        /* =========================
           IMAGE
        ========================== */

        .travel-image {

            transition:
                transform 0.8s ease;
        }


        .travel-panel:hover
        .travel-image {

            transform:
                scale(1.04);
        }


    </style>

</head>


<body
    class="min-h-screen
           w-full
           font-sans
           text-on-surface"
>
@include('partials.skeleton')


    <!-- =====================================
         MAIN LAYOUT
    ====================================== -->

    <main
        class="min-h-screen
               flex
               w-full
               flex-col
               md:flex-row"
    >


        <!-- =====================================
             LEFT / LOGIN
        ====================================== -->

        <section
            class="flex
                   w-full
                   flex-col
                   items-center
                   justify-center
                   px-5
                   py-10
                   sm:px-8
                   md:w-1/2
                   md:px-10
                   lg:px-16
                   xl:px-20"
        >

            <div
                class="w-full
                       max-w-[440px]"
            >


                <!-- =================================
                     HEADER
                ================================== -->

                <div
                    class="mb-10
                           text-center
                           md:text-left
                           fade-in"
                >


                    <!-- LOGO -->

                    <div
                        class="mb-7
                               flex
                               items-center
                               justify-center
                               md:justify-start"
                    >

                        <a
                            href="{{ route('home') }}"
                            class="brand-logo
                                   inline-flex
                                   items-center"
                            aria-label="GoZay"
                        >

                            <img
                                src="{{ asset('logo.png') }}"
                                alt="GoZay Logo"
                                class="h-10
                                       w-auto
                                       object-contain"
                            >

                        </a>

                    </div>


                    <!-- PESAN FLASH -->

                    @if ($errors->any())
                        <div
                            class="mb-4 flex items-start gap-2 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600"
                        >
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @elseif (session('error'))
                        <div
                            class="mb-4 flex items-start gap-2 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600"
                        >
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            <span>{{ session('error') }}</span>
                        </div>
                    @elseif (session('status'))
                        <div
                            class="mb-4 flex items-start gap-2 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-600"
                        >
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif


                    <!-- TITLE -->

                    <h1
                        class="mb-2
                               text-2xl
                               font-bold
                               tracking-tight
                               text-slate-900
                               sm:text-3xl"
                    >
                        Selamat Datang Kembali
                    </h1>


                    <p
                        class="text-sm
                               leading-6
                               text-slate-500
                               sm:text-base"
                    >
                        Masuk ke akun GoZay Anda untuk
                        melanjutkan perjalanan.
                    </p>

                </div>



                <!-- =================================
                     LOGIN FORM
                     (POST ke route login GoZay)
                ================================== -->

                <form
                    action="{{ route('login') }}"
                    class="flex
                           flex-col
                           gap-6
                           fade-in
                           delay-1"
                    method="POST"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div
                        class="flex
                               flex-col
                               gap-2"
                    >

                        <label
                            class="ml-1
                                   text-xs
                                   font-semibold
                                   text-slate-600"
                            for="email"
                        >
                            Alamat Email
                        </label>


                        <div
                            class="custom-input
                                   @error('email') is-invalid @enderror
                                   relative
                                   flex
                                   items-center
                                   rounded-2xl
                                   border
                                   border-slate-200
                                   bg-white
                                   shadow-sm"
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
                                id="email"
                                name="email"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                type="email"
                            >

                        </div>

                        @error('email')
                            <p class="ml-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror

                    </div>



                    <!-- PASSWORD -->

                    <div
                        class="flex
                               flex-col
                               gap-2"
                    >

                        <div
                            class="ml-1
                                   flex
                                   items-center
                                   justify-between"
                        >

                            <label
                                class="text-xs
                                       font-semibold
                                       text-slate-600"
                                for="password"
                            >
                                Kata Sandi
                            </label>


                            <a
                                class="text-xs
                                       font-semibold
                                       text-primary
                                       transition-colors
                                       hover:text-primary-dark
                                       hover:underline"
                                href="{{ route('password.request') }}"
                            >
                                Lupa Kata Sandi?
                            </a>

                        </div>


                        <div
                            class="custom-input
                                   @error('password') is-invalid @enderror
                                   relative
                                   flex
                                   items-center
                                   rounded-2xl
                                   border
                                   border-slate-200
                                   bg-white
                                   shadow-sm"
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
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                type="password"
                            >

                        </div>

                        @error('password')
                            <p class="ml-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror

                    </div>



                    <!-- LOGIN BUTTON -->

                    <button
                        class="login-button
                               mt-1
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
                        type="submit"
                    >

                        Masuk Sekarang

                        <span
                            class="material-symbols-outlined"
                            style="font-size: 20px;"
                        >
                            arrow_forward
                        </span>

                    </button>

                </form>



                <!-- =================================
                     REGISTER
                ================================== -->

                <div
                    class="mt-8
                           text-center
                           fade-in
                           delay-2"
                >

                    <p
                        class="text-sm
                               text-slate-500"
                    >

                        Belum punya akun?

                        <a
                            class="ml-1
                                   font-bold
                                   text-primary
                                   transition-colors
                                   hover:text-primary-dark
                                   hover:underline"
                            href="{{ route('register') }}"
                        >
                            Daftar di sini
                        </a>

                    </p>

                </div>


            </div>

        </section>



        <!-- =====================================
             RIGHT / IMAGE
        ====================================== -->

        <section
            class="travel-panel
                   relative
                   hidden
                   min-h-screen
                   w-full
                   overflow-hidden
                   md:block
                   md:w-1/2"
        >


            <!-- IMAGE -->

            <img
                src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1600&q=80"
                alt="Pemandangan dari jendela pesawat"
                class="travel-image
                       absolute
                       inset-0
                       h-full
                       w-full
                       object-cover"
            >


            <!-- ORANGE OVERLAY -->

            <div
                class="absolute
                       inset-0
                       bg-gradient-to-r
                       from-[#FF7A00]/45
                       via-[#D95F00]/15
                       to-transparent
                       mix-blend-multiply"
            ></div>


            <!-- DARK BOTTOM GRADIENT -->

            <div
                class="absolute
                       inset-0
                       bg-gradient-to-t
                       from-black/70
                       via-transparent
                       to-black/10"
            ></div>



            <!-- =================================
                 QUOTE CARD
            ================================== -->

            <div
                class="absolute
                       bottom-10
                       left-10
                       right-10
                       z-10
                       max-w-md
                       rounded-3xl
                       border
                       border-white/25
                       bg-white/15
                       p-7
                       shadow-2xl
                       backdrop-blur-xl
                       fade-in
                       delay-3"
            >

                <div
                    class="mb-4
                           flex
                           h-10
                           w-10
                           items-center
                           justify-center
                           rounded-xl
                           bg-orange-500/20
                           text-orange-200"
                >

                    <span
                        class="material-symbols-outlined"
                    >
                        flight
                    </span>

                </div>


                <p
                    class="text-xl
                           font-bold
                           leading-relaxed
                           text-white
                           lg:text-2xl"
                >
                    "Setiap perjalanan besar dimulai
                    dengan satu langkah kecil.
                    GoZay membawa Anda melintasi
                    cakrawala dengan kenyamanan
                    premium."
                </p>


                <div
                    class="mt-5
                           flex
                           items-center
                           gap-2"
                >

                    <span
                        class="h-2
                               w-2
                               rounded-full
                               bg-orange-400"
                    ></span>


                    <span
                        class="text-xs
                               font-semibold
                               text-white/70"
                    >
                        Fly More, Pay Less
                    </span>

                </div>

            </div>

        </section>

    </main>


</body>
</html>