@php
    $flight = $booking->flight;
    $classLabels = [
        'first' => 'Kelas Pertama',
        'business' => 'Kelas Bisnis',
        'premium_economy' => 'Premium Economy',
        'economy' => 'Kelas Ekonomi',
    ];
    $boardingTime = $flight->departure_time->copy()->subMinutes(45);
    $departureTime = $flight->departure_time;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>E-Tiket {{ $booking->booking_code }} - GoZay Boarding Pass Digital</title>
    <!-- Favicon (Logo GoZay) -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "inverse-on-surface": "#ffede6",
                        "on-primary-container": "#592300",
                        "surface-bright": "#fff8f6",
                        "secondary-fixed-dim": "#b3c5ff",
                        "error": "#BA1A1A",
                        "inverse-surface": "#3c2d26",
                        "surface-container-high": "#fde3d8",
                        "surface-tint": "#9e4300",
                        "on-tertiary-container": "#2f3438",
                        "on-secondary-fixed": "#00184a",
                        "primary-fixed-dim": "#ffb691",
                        "on-secondary": "#ffffff",
                        "surface": "#FCF9F8",
                        "outline": "#747684",
                        "secondary-container": "#98b1fe",
                        "primary-container": "#ff7000",
                        "on-tertiary-fixed-variant": "#42474c",
                        "on-error-container": "#93000a",
                        "surface-variant": "#f7ddd2",
                        "tertiary-container": "#979ca1",
                        "secondary": "#415ba2",
                        "on-primary-fixed": "#341100",
                        "surface-container-low": "#fff1eb",
                        "background": "#fff8f6",
                        "surface-dim": "#eed5ca",
                        "on-surface": "#1C1B1B",
                        "inverse-primary": "#ffb691",
                        "tertiary-fixed-dim": "#c2c7cc",
                        "on-secondary-container": "#264187",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed": "#171c20",
                        "on-primary-fixed-variant": "#783100",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "outline-variant": "#e1c0b0",
                        "on-primary": "#ffffff",
                        "on-background": "#261912",
                        "surface-container-highest": "#f7ddd2",
                        "surface-container-lowest": "#ffffff",
                        "primary": "#9e4300",
                        "primary-fixed": "#ffdbcb",
                        "tertiary-fixed": "#dfe3e8",
                        "secondary-fixed": "#dbe1ff",
                        "on-secondary-fixed-variant": "#274388",
                        "tertiary": "#5a5f63",
                        "on-surface-variant": "#594236",
                        "surface-container": "#ffeae0"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "container-max": "1280px",
                        "base": "8px",
                        "gutter-desktop": "24px",
                        "margin-mobile": "20px",
                        "margin-desktop": "40px"
                    },
                    fontFamily: {
                        "body-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "1", "fontWeight": "500"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "headline-lg": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bg-ambient-glow {
            background: radial-gradient(circle at top right, rgba(255, 112, 0, 0.05), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(0, 38, 108, 0.03), transparent 40%);
        }
        @media print {
            header, footer, .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md min-h-screen bg-ambient-glow flex flex-col">

@include('partials.flash')

<!-- Main Content -->
<main class="flex-grow px-margin-mobile md:px-margin-desktop py-12 max-w-container-max mx-auto w-full">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
        <div>
            <h1 class="font-headline-lg text-headline-lg md:font-display-lg md:text-display-lg text-on-surface mb-2">Boarding Pass Digital</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Tunjukkan ini di gerbang untuk prioritas masuk pesawat.</p>
            <p class="font-label-sm text-label-sm text-outline mt-2 uppercase tracking-wider">Kode Booking: <span class="text-secondary font-bold">{{ $booking->booking_code }}</span></p>
        </div>
        <div class="flex gap-4 no-print">
            <button onclick="window.print()" class="bg-transparent border border-outline text-primary hover:bg-primary/5 font-label-md text-label-md px-6 py-3 rounded-lg transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">print</span>
                Cetak
            </button>
            @if ($boardingPasses->count() === 1 && \Illuminate\Support\Facades\Storage::disk('public')->exists($boardingPasses->first()->eticket_pdf))
                <a href="{{ route('ticket.pdf', ['boardingPass' => $boardingPasses->first(), 'type' => 'eticket']) }}" target="_blank" class="bg-primary-container text-on-primary-container hover:-translate-y-0.5 hover:shadow-md font-label-md text-label-md px-6 py-3 rounded-lg transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined">download</span>
                    Unduh PDF
                </a>
            @endif
        </div>
    </div>

    <!-- Boarding Pass Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Tickets -->
        <div class="lg:col-span-8 flex flex-col gap-8">
            @foreach ($boardingPasses as $boardingPass)
                @php $passenger = $boardingPass->bookingPassenger; @endphp
                <div class="bg-surface-container-lowest rounded-[24px] border border-outline-variant shadow-[0_8px_30px_rgb(0,38,108,0.05)] overflow-hidden flex flex-col md:flex-row relative">
                    <!-- Decorative Notch Left -->
                    <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-background rounded-full border-r border-outline-variant hidden md:block"></div>
                    <!-- Decorative Notch Right -->
                    <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-background rounded-full border-l border-outline-variant hidden md:block"></div>

                    <!-- Main Ticket Info -->
                    <div class="p-8 flex-grow border-b md:border-b-0 md:border-r border-dashed border-outline-variant">
                        <!-- Airline & Flight -->
                        <div class="flex justify-between items-center mb-8">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('logo.png') }}" alt="GoZay Airlines" class="h-10 w-auto"/>
                            </div>
                            <div class="text-right">
                                <p class="font-label-sm text-label-sm text-outline uppercase tracking-wider mb-1">Flight No.</p>
                                <p class="font-headline-md text-headline-md text-secondary">{{ $flight->flight_number }}</p>
                                <p class="font-label-sm text-label-sm text-outline uppercase tracking-wider mt-1">{{ $flight->airline->name }}</p>
                            </div>
                        </div>

                        <!-- Route -->
                        <div class="flex justify-between items-center mb-10 relative">
                            <div class="w-1/3">
                                <h2 class="font-display-lg text-display-lg text-on-surface">{{ $flight->origin->code }}</h2>
                                <p class="font-body-md text-body-md text-on-surface-variant">{{ $flight->origin->city }}</p>
                            </div>
                            <div class="flex-grow flex flex-col items-center justify-center px-4 relative">
                                <span class="material-symbols-outlined text-primary-container z-10 bg-surface-container-lowest px-2">flight</span>
                                <div class="absolute top-1/2 left-0 w-full h-[1px] border-t-2 border-dashed border-outline-variant/50 -translate-y-1/2"></div>
                            </div>
                            <div class="w-1/3 text-right">
                                <h2 class="font-display-lg text-display-lg text-on-surface">{{ $flight->destination->code }}</h2>
                                <p class="font-body-md text-body-md text-on-surface-variant">{{ $flight->destination->city }}</p>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 bg-surface-container px-6 py-4 rounded-xl border-l-2 border-primary-container">
                            <div>
                                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Passenger</p>
                                <p class="font-headline-md text-headline-md text-on-surface text-lg">{{ $passenger->passenger_name }}</p>
                            </div>
                            <div>
                                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Date</p>
                                <p class="font-headline-md text-headline-md text-on-surface text-lg">{{ $flight->departure_date->translatedFormat('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Boarding</p>
                                <p class="font-headline-md text-headline-md text-secondary text-lg">{{ $boardingTime->format('H:i') }}</p>
                            </div>
                            <div>
                                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Departure</p>
                                <p class="font-headline-md text-headline-md text-on-surface text-lg">{{ $departureTime->format('H:i') }}</p>
                            </div>
                        </div>

                        <!-- Badges -->
                        <div class="flex flex-wrap gap-3 mt-8">
                            <span class="inline-flex items-center gap-1 bg-surface-container-high text-on-surface px-3 py-1.5 rounded-full font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-sm text-secondary">verified</span>
                                Terverifikasi
                            </span>
                            <span class="inline-flex items-center gap-1 bg-primary-fixed-dim/20 text-primary px-3 py-1.5 rounded-full font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-sm">luggage</span>
                                Termasuk 2 Bagasi
                            </span>
                            <span class="inline-flex items-center gap-1 bg-surface-container-highest text-on-surface px-3 py-1.5 rounded-full font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-sm">airline_seat_recline_normal</span>
                                {{ $classLabels[$flight->seat_class] ?? ucfirst(str_replace('_', ' ', $flight->seat_class)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Side Ticket Info (QR & Seat) -->
                    <div class="p-8 md:w-64 flex flex-col items-center justify-between bg-surface-container-lowest">
                        <div class="w-full">
                            <div class="flex justify-between items-center border-b border-outline-variant/30 pb-4 mb-4">
                                <div>
                                    <p class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Terminal</p>
                                    <p class="font-headline-md text-headline-md text-on-surface text-xl">{{ $boardingPass->terminal }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Gate</p>
                                    <p class="font-headline-md text-headline-md text-on-surface text-xl">{{ $boardingPass->gate }}</p>
                                </div>
                            </div>
                            <div class="text-center mb-8">
                                <p class="font-label-sm text-label-sm text-primary-container uppercase tracking-wider mb-1 font-bold">Seat</p>
                                <p class="font-display-lg text-display-lg text-secondary">{{ $passenger->seat->seat_number }}</p>
                            </div>
                        </div>
                        <div class="text-center w-full">
                            @if ($boardingPass->qr_path)
                                <img class="w-32 h-32 mx-auto mb-3 rounded-lg object-cover" src="{{ asset('storage/' . $boardingPass->qr_path) }}" alt="QR Code"/>
                            @else
                                <span class="material-symbols-outlined text-8xl text-outline mx-auto mb-3">qr_code_2</span>
                            @endif
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Pindai di Gerbang</p>
                        </div>
                    </div>
                </div>

                @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($boardingPass->eticket_pdf))
                    <div class="text-right -mt-4 no-print">
                        <a href="{{ route('ticket.pdf', ['boardingPass' => $boardingPass, 'type' => 'eticket']) }}" target="_blank" class="inline-flex items-center gap-2 bg-primary-container text-on-primary-container hover:-translate-y-0.5 hover:shadow-md font-label-md text-label-md px-5 py-2.5 rounded-lg transition-all">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            Unduh PDF {{ $passenger->passenger_name }}
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Supporting Cards -->
        <div class="lg:col-span-4 flex flex-col gap-6">
            <!-- Transport Card -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                        <span class="material-symbols-outlined">directions_car</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-on-surface text-lg mb-1">Transportasi Terminal</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant text-sm">Pesan kendaraan menuju bandara dengan mitra premium kami.</p>
                    </div>
                </div>
            </div>
            <!-- Lounge Card -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary-fixed-dim/20 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined">weekend</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-on-surface text-lg mb-1">Akses Lounge</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant text-sm">Nikmati kenyamanan di GoZay Premium Lounge Terminal {{ preg_replace('/\D/', '', $boardingPasses->first()->terminal) }}.</p>
                    </div>
                </div>
            </div>
            <!-- Support Card -->
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-on-surface text-lg mb-1">Dukungan Prioritas 24/7</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant text-sm">Bantuan instan untuk perubahan jadwal atau pertanyaan penerbangan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
