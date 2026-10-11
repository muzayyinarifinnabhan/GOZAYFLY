<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi OTP - GoZay</title>

    <meta name="theme-color" content="#FF7A00">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght@300;400;500;600;700"
        rel="stylesheet"
    >

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: "Plus Jakarta Sans", sans-serif;

            color: #181818;

            background:
                radial-gradient(
                    circle at 8% 0%,
                    rgba(255, 122, 0, 0.13),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 95% 100%,
                    rgba(255, 174, 107, 0.12),
                    transparent 32%
                ),
                #FFF9F5;
        }

        button,
        input {
            font-family: inherit;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page {
            min-height: 100vh;

            display: flex;
            flex-direction: column;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            position: relative;

            flex: 1;

            width: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding: 28px 24px 30px;
        }


        /* =====================================================
           TOP BAR
        ===================================================== */

        .top-bar {
            width: 100%;
            max-width: 1180px;

            display: flex;
            justify-content: flex-start;

            margin-bottom: 12px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 9px 12px 9px 6px;

            border-radius: 11px;

            color: #716A65;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none;

            transition:
                color 0.2s ease,
                background 0.2s ease,
                transform 0.2s ease;
        }

        .back-button:hover {
            color: #FF7A00;

            background: rgba(255, 122, 0, 0.07);

            transform: translateX(-3px);
        }

        .back-button .material-symbols-outlined {
            font-size: 20px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            width: 100%;

            flex: 1;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo-wrapper {
            margin-bottom: 28px;
        }

        .logo {
            display: inline-flex;

            align-items: center;
            justify-content: center;
        }

        .logo img {
            display: block;

            width: auto;
            height: 58px;

            object-fit: contain;
        }


        /* =====================================================
           OTP CARD
        ===================================================== */

        .otp-card {
            width: 100%;
            max-width: 540px;

            padding: 40px;

            border:
                1px solid
                rgba(232, 222, 215, 0.9);

            border-radius: 28px;

            background:
                rgba(255, 255, 255, 0.97);

            box-shadow:
                0 30px 80px rgba(91, 52, 27, 0.09),
                0 8px 25px rgba(91, 52, 27, 0.05);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            text-align: center;

            margin-bottom: 30px;
        }


        /* =====================================================
           FLASH / DEV ALERT
        ===================================================== */

        .flash-alert {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.6;
            text-align: center;
        }

        .flash-alert.success {
            background: #EDFBF0;
            border: 1px solid #BFE8CC;
            color: #15803D;
        }

        .flash-alert.error {
            background: #FEF2F2;
            border: 1px solid #F5C2C2;
            color: #DC2626;
        }

        .flash-alert.info {
            background: #FFF1E5;
            border: 1px solid #FFCFA3;
            color: #D95F00;
        }


        /* =====================================================
           VERIFIED ICON
        ===================================================== */

        .verified-icon {
            width: 66px;
            height: 66px;

            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #FFF3E7,
                    #FFE4CC
                );

            box-shadow:
                0 10px 25px
                rgba(255, 122, 0, 0.10);
        }

        .verified-icon span {
            color: #FF7A00;

            font-size: 32px;

            font-variation-settings:
                'FILL' 1,
                'wght' 600;
        }


        /* =====================================================
           TITLE
        ===================================================== */

        .title {
            margin: 0;

            color: #181818;

            font-size: 27px;

            line-height: 1.3;

            font-weight: 800;

            letter-spacing: -0.025em;
        }


        /* =====================================================
           DESCRIPTION
           DIBESARKAN AGAR TIDAK TERLALU KECIL
        ===================================================== */

        .description {
            max-width: 455px;

            margin: 14px auto 0;

            color: #625B56;

            font-size: 15px;

            line-height: 1.75;

            font-weight: 500;

            letter-spacing: -0.005em;
        }

        .description strong {
            color: #25211F;

            font-weight: 800;
        }


        /* =====================================================
           OTP CONTAINER
        ===================================================== */

        .otp-container {
            width: 100%;

            display: grid;

            grid-template-columns:
                repeat(6, minmax(0, 1fr));

            gap: 12px;

            margin-top: 8px;
        }


        /* =====================================================
           OTP INPUT
        ===================================================== */

        .otp-input {
            position: relative;

            width: 100%;
            min-width: 0;

            height: 68px;

            padding: 0;

            border:
                1.5px solid
                #E8DED7;

            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    #FFFFFF 0%,
                    #FFF9F5 100%
                );

            color: #181818;

            font-size: 26px;

            font-weight: 800;

            text-align: center;

            outline: none;

            caret-color: #FF7A00;

            box-shadow:
                0 4px 12px
                rgba(75, 42, 20, 0.04),

                inset 0 1px 0
                rgba(255, 255, 255, 0.8);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease,
                transform 0.2s ease;
        }

        .otp-input:hover {
            border-color: #FFB978;

            background: #FFFFFF;

            box-shadow:
                0 7px 18px
                rgba(255, 122, 0, 0.08);
        }

        .otp-input:focus {
            border-color: #FF7A00;

            background:
                linear-gradient(
                    145deg,
                    #FFFFFF,
                    #FFF5EC
                );

            box-shadow:
                0 0 0 4px
                rgba(255, 122, 0, 0.10),

                0 10px 24px
                rgba(255, 122, 0, 0.12);

            transform:
                translateY(-3px)
                scale(1.025);
        }

        .otp-input.filled {
            border-color: #FF963D;

            background:
                linear-gradient(
                    145deg,
                    #FFFFFF,
                    #FFF3E8
                );

            box-shadow:
                0 6px 16px
                rgba(255, 122, 0, 0.09);
        }

        .otp-input.error {
            border-color: #EF4444;

            background: #FFF5F5;

            box-shadow:
                0 0 0 4px
                rgba(239, 68, 68, 0.08);

            animation: otpShake 0.3s ease;
        }

        @keyframes otpShake {
            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-3px);
            }
        }


        /* =====================================================
           ERROR
        ===================================================== */

        .error-message {
            display: none;

            margin: 11px 0 0;

            color: #EF4444;

            font-size: 12px;

            font-weight: 700;

            text-align: center;
        }


        /* =====================================================
           VERIFY BUTTON
        ===================================================== */

        .verify-button {
            width: 100%;

            min-height: 56px;

            margin-top: 26px;

            border: 0;

            border-radius: 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            background:
                linear-gradient(
                    110deg,
                    #FF6800,
                    #FF7A00,
                    #FF9B45
                );

            color: #FFFFFF;

            font-size: 14px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 14px 30px
                rgba(255, 122, 0, 0.20);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                opacity 0.2s ease;
        }

        .verify-button:hover:not(:disabled) {
            transform: translateY(-2px);

            box-shadow:
                0 18px 38px
                rgba(255, 122, 0, 0.28);
        }

        .verify-button:active:not(:disabled) {
            transform: translateY(0);
        }

        .verify-button:disabled {
            opacity: 0.55;

            cursor: not-allowed;

            box-shadow: none;
        }

        .verify-button.success {
            background: #22C55E;

            box-shadow:
                0 14px 30px
                rgba(34, 197, 94, 0.20);
        }


        /* =====================================================
           RESEND
        ===================================================== */

        .resend-section {
            margin-top: 28px;

            padding-top: 23px;

            border-top:
                1px solid
                #E8DED7;

            text-align: center;
        }

        .resend-title {
            margin: 0;

            color: #716A65;

            font-size: 12px;

            font-weight: 600;
        }

        .resend-row {
            margin-top: 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            flex-wrap: wrap;
        }

        .resend-button {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 0;

            border: 0;

            background: transparent;

            color: #FF7A00;

            font-size: 13px;

            font-weight: 800;

            cursor: pointer;
        }

        .resend-button:hover:not(:disabled) {
            color: #E56600;

            text-decoration: underline;
        }

        .resend-button:disabled {
            opacity: 0.45;

            cursor: not-allowed;
        }

        .timer {
            padding: 6px 10px;

            border-radius: 999px;

            background: #FFF0E3;

            color: #D95F00;

            font-size: 11px;

            font-weight: 800;
        }


        /* =====================================================
           SUPPORT
        ===================================================== */

        .support {
            width: 100%;
            max-width: 540px;

            margin-top: 15px;

            display: flex;

            justify-content: flex-end;
        }

        .support a {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            color: #716A65;

            font-size: 12px;

            font-weight: 600;

            text-decoration: none;

            transition: color 0.2s ease;
        }

        .support a:hover {
            color: #FF7A00;
        }

        .support .material-symbols-outlined {
            font-size: 16px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            width: 100%;

            padding: 0 20px 22px;

            text-align: center;
        }

        .footer p {
            margin: 0;

            color:
                rgba(113, 106, 101, 0.62);

            font-size: 10px;

            line-height: 1.6;
        }


        /* =====================================================
           ANIMATION
        ===================================================== */

        .fade-up {
            opacity: 0;

            transform:
                translateY(12px);

            animation:
                fadeUp 0.55s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.08s;
        }

        .delay-2 {
            animation-delay: 0.16s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;

                transform:
                    translateY(0);
            }
        }


        /* =====================================================
           SPINNER
        ===================================================== */

        .spin {
            animation:
                spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 700px) {

            .main {
                padding:
                    22px 16px 25px;
            }

            .content {
                justify-content:
                    flex-start;
            }

            .top-bar {
                margin-bottom:
                    22px;
            }

            .logo-wrapper {
                margin-bottom:
                    24px;
            }

            .logo img {
                height:
                    50px;
            }

            .otp-card {
                padding:
                    32px 24px;

                border-radius:
                    23px;
            }

            .title {
                font-size:
                    24px;
            }

            .description {
                max-width:
                    430px;

                font-size:
                    14px;

                line-height:
                    1.7;
            }

            .otp-container {
                gap:
                    8px;
            }

            .otp-input {
                height:
                    58px;

                border-radius:
                    15px;

                font-size:
                    22px;
            }

            .support {
                justify-content:
                    center;
            }
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 420px) {

            .main {
                padding:
                    18px 12px 20px;
            }

            .top-bar {
                margin-bottom:
                    18px;
            }

            .back-button {
                font-size:
                    11px;
            }

            .logo-wrapper {
                margin-bottom:
                    20px;
            }

            .logo img {
                height:
                    44px;
            }

            .otp-card {
                padding:
                    26px 15px;

                border-radius:
                    20px;
            }

            .verified-icon {
                width:
                    54px;

                height:
                    54px;

                margin-bottom:
                    15px;

                border-radius:
                    17px;
            }

            .verified-icon span {
                font-size:
                    27px;
            }

            .title {
                font-size:
                    21px;
            }

            /* TEKS DESKRIPSI TETAP TERBACA */

            .description {
                max-width:
                    100%;

                margin-top:
                    12px;

                font-size:
                    13px;

                line-height:
                    1.7;

                font-weight:
                    500;
            }

            .otp-container {
                gap:
                    6px;

                margin-top:
                    8px;
            }

            .otp-input {
                height:
                    53px;

                border-radius:
                    13px;

                font-size:
                    20px;
            }

            .otp-input:focus {
                transform:
                    translateY(-2px)
                    scale(1.015);
            }

            .verify-button {
                min-height:
                    52px;

                margin-top:
                    20px;

                border-radius:
                    14px;

                font-size:
                    12px;
            }

            .resend-section {
                margin-top:
                    22px;

                padding-top:
                    18px;
            }

            .resend-title {
                font-size:
                    11px;
            }

            .resend-button {
                font-size:
                    11px;
            }

            .timer {
                font-size:
                    10px;
            }

            .support {
                margin-top:
                    13px;
            }

            .support a {
                font-size:
                    11px;
            }

            .footer {
                padding-bottom:
                    16px;
            }
        }


        /* =====================================================
           VERY SMALL MOBILE
        ===================================================== */

        @media (max-width: 350px) {

            .otp-card {
                padding:
                    23px 11px;
            }

            .title {
                font-size:
                    19px;
            }

            .description {
                font-size:
                    12px;
            }

            .otp-container {
                gap:
                    4px;
            }

            .otp-input {
                height:
                    48px;

                border-radius:
                    11px;

                font-size:
                    18px;
            }
        }


        /* =====================================================
           SHORT DESKTOP
        ===================================================== */

        @media (
            min-width: 701px
        ) and (
            max-height: 780px
        ) {

            .main {
                padding-top:
                    14px;

                padding-bottom:
                    15px;
            }

            .top-bar {
                margin-bottom:
                    4px;
            }

            .logo-wrapper {
                margin-bottom:
                    15px;
            }

            .logo img {
                height:
                    42px;
            }

            .otp-card {
                padding:
                    27px 34px;
            }

            .header {
                margin-bottom:
                    20px;
            }

            .verified-icon {
                width:
                    50px;

                height:
                    50px;

                margin-bottom:
                    11px;
            }

            .verified-icon span {
                font-size:
                    25px;
            }

            .title {
                font-size:
                    22px;
            }

            .description {
                margin-top:
                    7px;

                font-size:
                    13px;

                line-height:
                    1.6;
            }

            .otp-input {
                height:
                    54px;

                font-size:
                    22px;
            }

            .verify-button {
                min-height:
                    49px;

                margin-top:
                    18px;
            }

            .resend-section {
                margin-top:
                    18px;

                padding-top:
                    15px;
            }

            .support {
                margin-top:
                    9px;
            }

            .footer {
                padding-bottom:
                    10px;
            }
        }

    </style>

</head>


<body>

@include('partials.skeleton')

<div class="page">


    <!-- =====================================================
         MAIN
    ====================================================== -->

    <main class="main">


        <!-- =================================================
             BACK BUTTON
        ================================================== -->

        <div class="top-bar">

            <a
                href="{{ route('login') }}"
                class="back-button"
            >

                <span class="material-symbols-outlined">
                    arrow_back
                </span>

                Kembali ke Masuk

            </a>

        </div>



        <!-- =================================================
             CONTENT
        ================================================== -->

        <div class="content">


            <!-- =================================================
                 LOGO
            ================================================== -->

            <div class="logo-wrapper fade-up">

                <a
                    href="{{ route('home') }}"
                    class="logo"
                    aria-label="GoZay"
                >

                    <img
                        src="{{ asset('logo.png') }}"
                        alt="GoZay"
                    >

                </a>

            </div>



            <!-- =================================================
                 OTP CARD
            ================================================== -->

            <section class="otp-card fade-up delay-1">


                <!-- =================================================
                     HEADER
                ================================================== -->

                <div class="header">


                    <div class="verified-icon">

                        <span class="material-symbols-outlined">
                            verified_user
                        </span>

                    </div>


                    <h1 class="title">
                        Verifikasi Akun Anda
                    </h1>


                    <!--
                        TEKS INI SUDAH DIPERBESAR
                        DAN DIBUAT LEBIH MUDAH DIBACA
                    -->

                    <p class="description">

                        Kami telah mengirimkan
                        <strong>6 digit kode verifikasi</strong>
                        ke

                        <strong>
                            {{ $email }}
                        </strong>.

                        Silakan masukkan kode tersebut
                        pada kolom di bawah untuk
                        melanjutkan.

                    </p>

                </div>


                @if (session('success'))
                    <div class="flash-alert success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="flash-alert error">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="flash-alert success">
                        {{ session('status') }}
                    </div>
                @endif


                <!-- =================================================
                     OTP FORM
                ================================================== -->

                <form
                    id="otp-form"
                    method="POST"
                    action="{{ route('otp.verify') }}"
                    novalidate
                >

                    @csrf

                    <input
                        type="hidden"
                        name="email"
                        value="{{ $email }}"
                    >

                    <input
                        type="hidden"
                        name="otp"
                        id="otp-hidden"
                        value=""
                    >

                    <div
                        class="otp-container"
                        id="otp-container"
                    >

                        @php($oldOtp = old('otp', ''))
                        @php($hasError = $errors->has('otp'))

                        @for ($i = 0; $i < 6; $i++)
                            <input
                                id="otp-{{ $i + 1 }}"
                                class="otp-input @if($hasError) error @endif"
                                type="text"
                                inputmode="numeric"
                                maxlength="1"
                                @if ($i === 0) autocomplete="one-time-code" @endif
                                aria-label="Digit OTP {{ $i + 1 }}"
                                value="{{ mb_substr($oldOtp, $i, 1) }}"
                                @if ($i === 0) autofocus @endif
                            >
                        @endfor

                    </div>


                    <p
                        id="otp-error"
                        class="error-message"
                        @if ($hasError) style="display:block;" @endif
                    >
                        {{ $errors->first('otp') ?: 'Masukkan kode OTP 6 digit.' }}
                    </p>



                    <!-- =================================================
                         VERIFY BUTTON
                    ================================================== -->

                    <button
                        id="verify-button"
                        class="verify-button"
                        type="submit"
                        @if (!old('otp') || mb_strlen(old('otp')) !== 6) disabled @endif
                    >

                        <span>
                            Verifikasi &amp; Lanjutkan
                        </span>

                        <span
                            class="material-symbols-outlined"
                            style="font-size:19px;"
                        >
                            arrow_forward
                        </span>

                    </button>

                </form>



                <!-- =================================================
                     RESEND
                ================================================== -->

                <div class="resend-section">

                    <p class="resend-title">
                        Tidak menerima kode?
                    </p>


                    <form
                        id="resend-form"
                        method="POST"
                        action="{{ route('otp.resend') }}"
                        style="margin:0;"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="email"
                            value="{{ $email }}"
                        >

                        <div class="resend-row">

                            <button
                                id="resend-button"
                                class="resend-button"
                                type="submit"
                                disabled
                            >

                                <span
                                    class="material-symbols-outlined"
                                    style="font-size:16px;"
                                >
                                    refresh
                                </span>

                                Kirim Ulang Kode

                            </button>


                            <span
                                id="timer"
                                class="timer"
                            >
                                00:59
                            </span>

                        </div>

                    </form>

                </div>


            </section>



            <!-- =================================================
                 SUPPORT
            ================================================== -->

            <div class="support fade-up delay-2">

                <a href="{{ route('home') }}#kontak">

                    <span class="material-symbols-outlined">
                        help
                    </span>

                    Hubungi Dukungan

                </a>

            </div>


        </div>


    </main>



    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer class="footer">

        <p>
            © {{ date('Y') }} GoZay Airlines.
            Fly More, Pay Less.
            Verifikasi OTP Aman.
        </p>

    </footer>


</div>



<script>

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const otpInputs = Array.from(
        document.querySelectorAll(".otp-input")
    );

    const form = document.getElementById(
        "otp-form"
    );

    const verifyButton = document.getElementById(
        "verify-button"
    );

    const resendButton = document.getElementById(
        "resend-button"
    );

    const timerElement = document.getElementById(
        "timer"
    );

    const errorElement = document.getElementById(
        "otp-error"
    );

    const otpHidden = document.getElementById(
        "otp-hidden"
    );


    /* =====================================================
       GET OTP
    ===================================================== */

    function getOTP() {

        return otpInputs
            .map(input => input.value)
            .join("");

    }


    /* =====================================================
       UPDATE VERIFY BUTTON
    ===================================================== */

    function updateVerifyButton() {

        verifyButton.disabled =
            getOTP().length !== 6;

    }


    /* =====================================================
       UPDATE INPUT STATE
    ===================================================== */

    function updateInputState(input) {

        if (input.value) {

            input.classList.add("filled");

        } else {

            input.classList.remove("filled");

        }

    }


    /* =====================================================
       CLEAR ERROR
    ===================================================== */

    function clearError() {

        errorElement.style.display = "none";

        otpInputs.forEach(input => {

            input.classList.remove("error");

        });

    }


    /* =====================================================
       INPUT HANDLING
    ===================================================== */

    otpInputs.forEach((input, index) => {


        input.addEventListener(
            "input",
            event => {

                clearError();

                let value =
                    event.target.value.replace(
                        /\D/g,
                        ""
                    );


                if (value.length > 1) {

                    const digits =
                        value.slice(0, 6).split("");

                    digits.forEach(
                        (digit, digitIndex) => {

                            if (
                                otpInputs[digitIndex]
                            ) {

                                otpInputs[
                                    digitIndex
                                ].value = digit;

                                updateInputState(
                                    otpInputs[
                                        digitIndex
                                    ]
                                );

                            }

                        }
                    );


                    const firstEmpty =
                        otpInputs.findIndex(
                            input => !input.value
                        );


                    if (firstEmpty === -1) {

                        otpInputs[5].focus();

                    } else {

                        otpInputs[
                            firstEmpty
                        ].focus();

                    }

                } else {

                    input.value =
                        value.slice(0, 1);

                    updateInputState(input);


                    if (
                        value &&
                        index <
                        otpInputs.length - 1
                    ) {

                        otpInputs[
                            index + 1
                        ].focus();

                    }

                }


                updateVerifyButton();

            }
        );


        /* =================================================
           KEYBOARD NAVIGATION
        ================================================== */

        input.addEventListener(
            "keydown",
            event => {


                if (
                    event.key === "Backspace"
                ) {

                    if (
                        !input.value &&
                        index > 0
                    ) {

                        otpInputs[
                            index - 1
                        ].value = "";

                        updateInputState(
                            otpInputs[
                                index - 1
                            ]
                        );

                        otpInputs[
                            index - 1
                        ].focus();

                    }

                }


                if (
                    event.key === "ArrowLeft" &&
                    index > 0
                ) {

                    event.preventDefault();

                    otpInputs[
                        index - 1
                    ].focus();

                }


                if (
                    event.key === "ArrowRight" &&
                    index <
                    otpInputs.length - 1
                ) {

                    event.preventDefault();

                    otpInputs[
                        index + 1
                    ].focus();

                }

            }
        );


        /* =================================================
           PASTE OTP
        ================================================== */

        input.addEventListener(
            "paste",
            event => {

                event.preventDefault();


                const pasted =
                    (
                        event.clipboardData ||
                        window.clipboardData
                    )
                    .getData("text")
                    .replace(/\D/g, "")
                    .slice(0, 6);


                if (!pasted) {
                    return;
                }


                pasted
                    .split("")
                    .forEach(
                        (digit, digitIndex) => {

                            if (
                                otpInputs[
                                    digitIndex
                                ]
                            ) {

                                otpInputs[
                                    digitIndex
                                ].value = digit;

                                updateInputState(
                                    otpInputs[
                                        digitIndex
                                    ]
                                );

                            }

                        }
                    );


                const lastIndex =
                    Math.min(
                        pasted.length,
                        6
                    ) - 1;


                otpInputs[
                    Math.max(lastIndex, 0)
                ].focus();


                clearError();

                updateVerifyButton();

            }
        );

    });


    /* =====================================================
       COUNTDOWN
    ===================================================== */

    let countdown = null;

    let secondsLeft = 59;


    function updateTimer() {

        const minutes =
            Math.floor(
                secondsLeft / 60
            );

        const seconds =
            secondsLeft % 60;


        timerElement.textContent =
            `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;

    }


    function startCountdown() {

        clearInterval(countdown);

        secondsLeft = 59;

        resendButton.disabled = true;

        timerElement.style.display =
            "inline-block";

        updateTimer();


        countdown =
            setInterval(() => {

                secondsLeft--;

                updateTimer();


                if (secondsLeft <= 0) {

                    clearInterval(countdown);

                    resendButton.disabled =
                        false;

                    timerElement.style.display =
                        "none";

                }

            }, 1000);

    }


    startCountdown();


    /* =====================================================
       RESEND OTP
    ===================================================== */

    resendButton.addEventListener(
        "click",
        () => {

            if (resendButton.disabled) {
                return;
            }


            otpInputs.forEach(input => {

                input.value = "";

                updateInputState(input);

            });


            clearError();

            updateVerifyButton();

            otpInputs[0].focus();

            startCountdown();

            /*
                Form ini mengirim POST ke route otp.resend
                (Laravel) sehingga kode baru dikirim ulang
                oleh server sebelum halaman di-refresh.
            */

        }
    );


    /* =====================================================
       VERIFY OTP
    ===================================================== */

    form.addEventListener(
        "submit",
        event => {

            const otp = getOTP();


            if (otp.length !== 6) {

                event.preventDefault();

                errorElement.style.display =
                    "block";


                otpInputs.forEach(input => {

                    input.classList.add(
                        "error"
                    );

                });


                return;

            }


            /*
                Isi hidden field lalu biarkan form
                submit ke route otp.verify (POST + CSRF).
            */

            otpHidden.value = otp;

            verifyButton.disabled = true;


            verifyButton.innerHTML = `

                <span
                    class="material-symbols-outlined spin"
                >
                    progress_activity
                </span>

                Memverifikasi...

            `;

        }
    );


    /* =====================================================
       AUTO FOCUS
    ===================================================== */

    window.addEventListener(
        "load",
        () => {

            setTimeout(() => {

                otpInputs[0].focus();

            }, 300);

        }
    );

</script>

</body>

</html>
