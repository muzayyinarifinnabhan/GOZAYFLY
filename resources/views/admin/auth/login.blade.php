<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Admin GoZay - Login</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#f7ddd2",
                        "surface-container-high": "#fde3d8",
                        "surface-container-low": "#fff1eb",
                        "on-error-container": "#93000a",
                        "primary-container": "#ff7000",
                        "inverse-on-surface": "#ffede6",
                        "surface-tint": "#9e4300",
                        "outline-variant": "#e1c0b0",
                        "secondary-fixed-dim": "#b3c5ff",
                        "on-surface": "#1C1B1B",
                        "on-secondary": "#ffffff",
                        "secondary-fixed": "#dbe1ff",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#42474c",
                        "primary-fixed-dim": "#ffb691",
                        "primary": "#9e4300",
                        "error-container": "#ffdad6",
                        "error": "#BA1A1A",
                        "on-secondary-container": "#264187",
                        "background": "#fff8f6",
                        "on-primary-container": "#592300",
                        "tertiary-container": "#979ca1",
                        "on-error": "#ffffff",
                        "surface": "#FCF9F8",
                        "tertiary-fixed": "#dfe3e8",
                        "surface-container": "#ffeae0",
                        "secondary": "#415ba2",
                        "on-primary-fixed": "#341100",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#00184a",
                        "on-surface-variant": "#594236",
                        "on-tertiary-container": "#2f3438",
                        "on-secondary-fixed-variant": "#274388",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#ffb691",
                        "primary-fixed": "#ffdbcb",
                        "surface-container-highest": "#f7ddd2",
                        "on-tertiary-fixed": "#171c20",
                        "outline": "#747684",
                        "on-primary-fixed-variant": "#783100",
                        "inverse-surface": "#3c2d26",
                        "surface-dim": "#eed5ca",
                        "surface-bright": "#fff8f6",
                        "tertiary-fixed-dim": "#c2c7cc",
                        "on-background": "#261912",
                        "tertiary": "#5a5f63",
                        "secondary-container": "#98b1fe"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-desktop": "40px",
                        "gutter-desktop": "24px",
                        "container-max": "1280px",
                        "margin-mobile": "20px",
                        "base": "8px"
                    },
                    "fontFamily": {
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.2", "fontWeight": "700" }],
                        "label-md": ["14px", { "lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "1", "fontWeight": "500" }],
                        "body-md": ["16px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "1.2", "fontWeight": "700" }]
                    }
                },
            },
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .ambient-shadow {
            box-shadow: 0 20px 40px rgba(0, 38, 108, 0.05);
        }
    </style>
    @include('partials.flash')
</head>
<body class="bg-slate-50 min-h-screen font-body-md text-on-surface antialiased">
@include('partials.skeleton')
<main class="min-h-screen flex">

<section class="w-full lg:w-[52%] min-h-screen bg-white flex items-center justify-center px-6 py-10 sm:px-10 lg:px-16 xl:px-24 relative overflow-hidden">
  <div class="absolute -top-32 -left-32 w-80 h-80 rounded-full bg-orange-100/50 blur-3xl"></div>
  <div class="absolute -bottom-40 -right-24 w-96 h-96 rounded-full bg-blue-100/40 blur-3xl"></div>

  <div class="w-full max-w-[470px] relative z-10">
    <div class="flex items-center justify-between mb-10">
      <a href="{{ route('home') }}"><img alt="GoZay Official Logo" class="h-12 sm:h-14 w-auto object-contain" src="{{ asset('logo.png') }}"></a>
      <span class="hidden sm:flex items-center gap-2 text-slate-400 text-xs font-semibold"><span class="material-symbols-outlined text-[17px]">shield</span>Secure Portal</span>
    </div>

    <div class="mb-8">
      <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-50 border border-orange-100 text-[#9e4300] text-[11px] font-bold uppercase tracking-[.12em] mb-4">
        <span class="w-1.5 h-1.5 rounded-full bg-[#ff7000]"></span>Admin Access
      </div>
      <h1 class="text-[32px] sm:text-[38px] leading-tight font-extrabold tracking-[-.035em] text-slate-900">Selamat datang kembali</h1>
      <p class="mt-2.5 text-[15px] leading-6 text-slate-500">Masuk ke Portal Admin untuk mengelola operasional dan layanan GoZay.</p>
    </div>

    <div class="rounded-[24px] border border-slate-200/80 bg-white p-6 sm:p-8 shadow-[0_20px_60px_rgba(15,23,42,.07)]">
      @if ($errors->any())
        <div class="mb-4 flex items-start gap-2.5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[13px] text-red-700">
          <span class="material-symbols-outlined text-[18px] shrink-0">error</span>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif
      @if (session('status'))
        <div class="mb-4 flex items-start gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-[13px] text-emerald-700">
          <span class="material-symbols-outlined text-[18px] shrink-0">check_circle</span>
          <span>{{ session('status') }}</span>
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" class="space-y-5" method="POST">
        @csrf
        <div>
          <label class="block text-[13px] font-bold text-slate-700 mb-2" for="email">Email Admin / ID Staf</label>
          <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none material-symbols-outlined text-slate-400 group-focus-within:text-[#ff7000] text-[20px]">mail</span>
            <input class="w-full pl-11 pr-4 h-[52px] bg-slate-50 border border-slate-200 rounded-xl text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-[#ff7000] focus:ring-4 focus:ring-orange-500/10 transition-all" id="email" name="email" placeholder="admin@gozay.id" value="{{ old('email') }}" required type="email" autofocus>
          </div>
        </div>

        <div>
          <div class="flex justify-between items-center mb-2">
            <label class="text-[13px] font-bold text-slate-700" for="password">Kata Sandi</label>
            <a class="text-[12px] font-semibold text-[#9e4300] hover:text-[#ff7000]" href="#">Lupa kata sandi?</a>
          </div>
          <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none material-symbols-outlined text-slate-400 group-focus-within:text-[#ff7000] text-[20px]">lock</span>
            <input class="w-full pl-11 pr-12 h-[52px] bg-slate-50 border border-slate-200 rounded-xl text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-[#ff7000] focus:ring-4 focus:ring-orange-500/10 transition-all" id="password" name="password" placeholder="Masukkan kata sandi" required type="password">
            <button id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-700" type="button" aria-label="Tampilkan kata sandi"><span class="material-symbols-outlined text-[20px]">visibility</span></button>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
          <label class="flex items-center gap-2 cursor-pointer"><input class="w-4 h-4 rounded border-slate-300 text-[#ff7000] focus:ring-[#ff7000]" type="checkbox" name="remember" value="1"><span class="text-[12px] font-medium text-slate-500">Ingat sesi ini</span></label>
          <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-1.5 rounded-full bg-emerald-50 text-emerald-700"><span class="material-symbols-outlined text-[14px]">verified_user</span><span class="text-[10px] font-bold tracking-wide">SSL 256-BIT</span></div>
        </div>

        <button class="w-full h-[54px] mt-2 rounded-xl bg-[#ff7000] text-white text-[14px] font-extrabold flex items-center justify-center gap-2 shadow-[0_10px_24px_rgba(255,112,0,.20)] hover:bg-[#e96500] hover:-translate-y-0.5 transition-all" type="submit">Masuk ke Portal Admin <span class="material-symbols-outlined text-[19px]">arrow_forward</span></button>
      </form>
    </div>

    <div class="mt-7 text-center">
      <p class="text-[11px] leading-5 text-slate-400 flex items-center justify-center gap-1.5"><span class="material-symbols-outlined text-[14px]">lock_person</span>Akses terbatas untuk staf &amp; otoritas resmi GoZay.</p>
      <div class="mt-3 flex justify-center items-center gap-2 text-[11px]"><span class="text-slate-400">Mengalami kendala akun?</span><a class="text-[#9e4300] hover:text-[#ff7000] font-bold inline-flex items-center gap-1" href="#"><span class="material-symbols-outlined text-[14px]">support_agent</span>Hubungi IT Support</a></div>
      <div class="mt-4">
        <a class="text-[12px] font-semibold text-slate-400 hover:text-[#9e4300] inline-flex items-center gap-1 transition-colors" href="{{ route('home') }}"><span class="material-symbols-outlined text-[14px]">arrow_back</span>Kembali ke situs GoZay</a>
      </div>
    </div>
  </div>
</section>

<section class="hidden lg:block lg:w-[48%] min-h-screen relative overflow-hidden bg-slate-900">
  <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDDRL_4YaVeptWRfAJVxaMginQLKwo06O7n0qGdIMLCs94x88x0dxRMHqLKzbdnOz7plkj4mC7isZS7beRdrKpTFgd_7cO9nFIRYRDBdjShZ78AmAlWLo-5I0KGhnhwktY2ma1VHR5s74z35XseIEhpPQ1IMFeWHu76YFyzGNZxhSMxPVuMWiPegzjFENCxP_wkHXrCbX2YZM1rdPHF3Lvar5te619AOmGlH01EPhsvsujCJk0QKpSlhQ');"></div>
  <div class="absolute inset-0 bg-slate-950/35"></div>
  <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/10 to-transparent"></div>
  <div class="absolute top-8 right-8 inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur-xl text-white/90"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span><span class="text-[10px] font-bold tracking-[.12em] uppercase">System Online</span></div>

  <div class="absolute left-10 right-10 bottom-10">
    <div class="max-w-[560px]">
      <div class="flex items-center gap-2 mb-4 text-orange-300"><span class="material-symbols-outlined text-[20px]">flight_takeoff</span><span class="text-[11px] font-extrabold uppercase tracking-[.18em]">GoZay Operations</span></div>
      <h2 class="text-white text-[40px] xl:text-[48px] leading-[1.08] font-extrabold tracking-[-.04em]">Menghubungkan perjalanan,<br>menggerakkan Indonesia.</h2>
      <p class="mt-4 text-white/70 text-[14px] leading-6 max-w-[500px]">Pantau penerbangan, kelola jadwal, dan kendalikan operasional GoZay dari satu portal terintegrasi.</p>
      <div class="mt-7 grid grid-cols-3 gap-3 max-w-[500px]">
        <div class="rounded-2xl bg-white/10 border border-white/10 backdrop-blur-xl px-4 py-3"><span class="material-symbols-outlined text-orange-300 text-[19px]">radar</span><p class="mt-2 text-white text-[12px] font-bold">Live Monitoring</p></div>
        <div class="rounded-2xl bg-white/10 border border-white/10 backdrop-blur-xl px-4 py-3"><span class="material-symbols-outlined text-orange-300 text-[19px]">schedule</span><p class="mt-2 text-white text-[12px] font-bold">Flight Control</p></div>
        <div class="rounded-2xl bg-white/10 border border-white/10 backdrop-blur-xl px-4 py-3"><span class="material-symbols-outlined text-orange-300 text-[19px]">analytics</span><p class="mt-2 text-white text-[12px] font-bold">Analytics</p></div>
      </div>
    </div>
  </div>
</section>
</main>

<script>
const password = document.getElementById('password');
const toggle = document.getElementById('togglePassword');
toggle?.addEventListener('click', () => {
  const show = password.type === 'password';
  password.type = show ? 'text' : 'password';
  toggle.querySelector('span').textContent = show ? 'visibility_off' : 'visibility';
});
</script>
</body>
</html>