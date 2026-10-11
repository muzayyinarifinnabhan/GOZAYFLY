@extends('layouts.landing')

@section('title', 'Perjalanan Saya')

@section('content')
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-10 md:py-14">

    {{-- PAGE HEADER --}}
    <header class="mb-10">
        <div class="inline-flex items-center gap-2 mb-3 px-3 py-1.5 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[11px] font-extrabold">
            <span class="material-symbols-outlined text-[16px]">flight_takeoff</span>
            DASHBOARD PERJALANAN
        </div>
        <h1 class="m-0 mb-2.5 text-[36px] leading-tight tracking-[-0.035em] font-extrabold text-[#1C1917]">Perjalanan Saya</h1>
        <p class="m-0 max-w-[720px] text-[15px] leading-relaxed font-medium text-[#6B625C]">
            Kelola tiket aktif Anda dan lihat riwayat perjalanan penerbangan bersama GoZay.
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_360px] gap-7 items-start">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-7">

            @if ($rejectedBookings->isNotEmpty())
                <section class="bg-[#FFF7ED] border border-[#FFD4B5] rounded-[22px] p-6 shadow-[0_12px_30px_rgba(255,114,0,0.08)]">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 flex items-center justify-center rounded-[16px] bg-[#FEE2E2] text-[#DC2626]">
                            <span class="material-symbols-outlined text-[26px]">error_outline</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="m-0 mb-1.5 text-[17px] font-extrabold tracking-[-0.02em] text-[#991B1B]">Pembayaran Anda Ditolak</h2>
                            <p class="m-0 text-[13px] font-medium text-[#7F1D1D]">
                                {{ $rejectedBookings->count() }} pemesanan ditolak admin. Silakan pilih ulang kursi untuk melanjutkan.
                            </p>
                            @foreach ($rejectedBookings as $rejected)
                                @php $rf = $rejected->flight; @endphp
                                <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white border border-[#FFD4B5] rounded-[14px] px-4 py-3">
                                    <div>
                                        <p class="m-0 text-[12px] font-extrabold text-[#1C1917]">
                                            {{ $rf?->origin?->code ?? '???' }}
                                            <span class="material-symbols-outlined text-[14px] align-middle text-[#A49A92]">arrow_forward</span>
                                            {{ $rf?->destination?->code ?? '???' }}
                                            <span class="mx-1.5 text-[#FF7200]">&bull;</span>
                                            {{ $rejected->booking_code }}
                                        </p>
                                        <p class="m-0 mt-1 text-[11px] font-semibold text-[#938A83]">
                                            {{ $rf?->flight_number ?? 'GZ-???' }} &bull; {{ $rf?->departure_date?->translatedFormat('d M Y') ?? '-' }}, {{ $rf?->seat_class_label ?? '' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('flights.seats', $rf) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-[10px] bg-[#FF7200] text-white text-[12px] font-extrabold shadow-[0_6px_16px_rgba(255,114,0,0.18)] hover:bg-[#E65F00] hover:-translate-y-px transition-all shrink-0">
                                        <span class="material-symbols-outlined text-[16px] mr-1.5">flight_takeoff</span> Pilih Ulang Kursi
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- TIKET AKTIF --}}
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="flex items-center gap-2.5 m-0 text-[20px] font-extrabold tracking-[-0.02em] text-[#1C1917]">
                        <span class="material-symbols-outlined text-[24px] text-[#FF7200]">confirmation_number</span>
                        Tiket Aktif
                    </h2>
                </div>

                @php
                    $cards = $pendingBookings->concat($activeBookings);
                @endphp

                <div class="flex flex-col gap-6">
                    @forelse ($cards as $booking)
                        @php
                            $flight = $booking->flight;
                            $isPending = $booking->booking_status === 'pending';
                        @endphp

                        <article class="relative overflow-hidden bg-white border border-[#E9E1DB] rounded-[22px] shadow-[0_12px_35px_rgba(83,45,18,0.07)] hover:shadow-[0_18px_45px_rgba(83,45,18,0.11)] hover:-translate-y-0.5 transition-all duration-300">
                            <span class="absolute left-0 top-0 bottom-0 w-[5px] bg-gradient-to-b from-[#FF7200] to-[#FF9A4A]"></span>
                            <span class="absolute top-0 right-0 px-4 py-2 rounded-bl-[12px] text-[10px] font-extrabold {{ $isPending ? 'bg-[#FFF7ED] text-[#B45309]' : 'bg-[#FFF0E3] text-[#E65F00]' }}">
                                {{ $isPending ? 'Menunggu Pembayaran' : 'Keberangkatan Mendatang' }}
                            </span>

                            {{-- TICKET TOP --}}
                            <div class="px-6 pt-6 pb-5 flex justify-between gap-5 border-b border-dashed border-[#E9E1DB]">
                                <div>
                                    <p class="m-0 mb-2 text-[11px] font-bold tracking-wide text-[#938A83]">
                                        {{ $flight?->airline?->name ?? 'GoZay' }} {{ $flight?->flight_number }} &bull; {{ $flight?->seat_class_label }}
                                    </p>
                                    <h3 class="flex items-center gap-2.5 m-0 text-[25px] font-extrabold tracking-[-0.03em] text-[#1C1917]">
                                        {{ $flight?->origin?->code ?? '???' }}
                                        <span class="relative w-[50px] h-px bg-[#FFD4B5]">
                                            <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-90 px-1 bg-white text-[#FF7200] text-sm leading-none">&#9992;</span>
                                        </span>
                                        {{ $flight?->destination?->code ?? '???' }}
                                    </h3>
                                </div>
                                <div class="text-right">
                                    <p class="m-0 mb-1.5 text-[10px] font-bold text-[#938A83]">Booking ID</p>
                                    <p class="m-0 text-sm font-extrabold tracking-wider text-[#1C1917]">{{ $booking->booking_code }}</p>
                                </div>
                            </div>

                            {{-- TICKET INFO --}}
                            <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div class="flex items-center gap-3.5 min-h-[76px] p-3.5 rounded-[16px] bg-[#F8F4F1]">
                                    <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-[#FFF0E3] text-[#FF7200]">
                                        <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                                    </div>
                                    <div>
                                        <p class="m-0 mb-1 text-[10px] font-bold text-[#938A83]">Keberangkatan</p>
                                        <p class="m-0 text-xs font-extrabold leading-snug text-[#1C1917]">
                                            {{ $flight?->departure_date?->translatedFormat('d M Y') ?? '-' }}, {{ $flight?->departure_time?->format('H:i') ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3.5 min-h-[76px] p-3.5 rounded-[16px] bg-[#F8F4F1]">
                                    <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-[#FFF0E3] text-[#FF7200]">
                                        <span class="material-symbols-outlined text-[20px]">airline_seat_recline_normal</span>
                                    </div>
                                    <div>
                                        <p class="m-0 mb-1 text-[10px] font-bold text-[#938A83]">Kursi</p>
                                        <p class="m-0 text-xs font-extrabold leading-snug text-[#1C1917]">{{ $booking->seatNumbers() }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- ACTIONS & BOARDING PASS --}}
                            <div class="px-6 pt-[18px] pb-[23px] border-t border-[rgba(233,225,219,0.75)]">
                                @if ($isPending)
                                    <div class="flex justify-end gap-2.5">
                                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="m-0">
                                            @csrf
                                            <button type="submit" class="min-h-[42px] px-[17px] rounded-[11px] border border-[#FFD4B5] bg-white text-[#E65F00] text-[11px] font-extrabold hover:bg-[#FFF0E3] hover:border-[#FF7200] transition-all">
                                                Batalkan
                                            </button>
                                        </form>
                                        <a href="{{ route('payment.create', $booking) }}" class="inline-flex items-center justify-center min-h-[42px] px-[17px] rounded-[11px] border border-[#FF7200] bg-[#FF7200] text-white text-[11px] font-extrabold shadow-[0_8px_20px_rgba(255,114,0,0.18)] hover:bg-[#E65F00] hover:-translate-y-px hover:shadow-[0_11px_25px_rgba(255,114,0,0.25)] transition-all">
                                            Bayar Sekarang
                                        </a>
                                    </div>
                                @else
                                    @if ($booking->boardingPass)
                                        {{-- Toggle Boarding Pass --}}
                                        <div x-data="{ open: false }" class="relative">
                                            <div class="flex justify-end gap-2.5">
                                                <button @click="open = !open" type="button"
                                                    :class="open ? 'bg-[#FF7200] text-white shadow-[0_8px_20px_rgba(255,114,0,0.18)]' : 'border border-[#FF7200] bg-white text-[#E65F00] hover:bg-[#FFF0E3] hover:border-[#FF7200]'"
                                                    class="inline-flex items-center justify-center min-h-[42px] px-[17px] rounded-[11px] text-[11px] font-extrabold shadow-[0_8px_20px_rgba(255,114,0,0.18)] hover:bg-[#E65F00] hover:-translate-y-px hover:shadow-[0_11px_25px_rgba(255,114,0,0.25)] transition-all">
                                                    <span class="material-symbols-outlined text-[17px] mr-1.5">flight_takeoff</span>
                                                    <span x-text="open ? 'Sembunyikan Boarding Pass' : 'Lihat Boarding Pass'"></span>
                                                </button>
                                                <a href="{{ route('ticket.eticket', $booking) }}" class="inline-flex items-center justify-center min-h-[42px] px-[17px] rounded-[11px] border border-[#FFD4B5] bg-white text-[#E65F00] text-[11px] font-extrabold hover:bg-[#FFF0E3] hover:border-[#FF7200] transition-all">
                                                    E-Tiket
                                                </a>
                                            </div>

                                            {{-- Inline Boarding Pass Panel --}}
                                            <div x-show="open" x-transition class="mt-4">
                                                <div class="bg-gradient-to-br from-[#FFF8F5] to-[#FFF1E8] border border-[#FFD4B5] rounded-[18px] p-5 shadow-[0_8px_25px_rgba(255,114,0,0.08)]">
                                                    <div class="flex items-center justify-between mb-4">
                                                        <div class="flex items-center gap-2">
                                                            <span class="material-symbols-outlined text-[#FF7200] text-[22px]">confirmation_number</span>
                                                            <h4 class="m-0 text-[15px] font-extrabold text-[#1C1917]">Boarding Pass</h4>
                                                        </div>
                                                        <span class="px-2.5 py-1 rounded-full bg-[#FF7200] text-white text-[10px] font-extrabold">{{ $booking->booking_code }}</span>
                                                    </div>

                                                    @foreach ($booking->boardingPasses as $boardingPass)
                                                        @php $passenger = $boardingPass->bookingPassenger; @endphp
                                                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 py-3 {{ !$loop->last ? 'border-b border-[rgba(233,225,219,0.5)]' : '' }}">
                                                            <div class="flex-1 grid grid-cols-2 sm:grid-cols-4 gap-3">
                                                                <div>
                                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Penumpang</p>
                                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $passenger->passenger_name }}</p>
                                                                    <p class="m-0 text-[10px] font-semibold text-[#FF7200]">{{ $boardingPass->passenger_number }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Kursi</p>
                                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $passenger->seat->seat_number }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Terminal / Gate</p>
                                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $boardingPass->terminal }} / {{ $boardingPass->gate }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Kode</p>
                                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $boardingPass->boarding_code }}</p>
                                                                </div>
                                                            </div>
                                                            @if ($boardingPass->qr_path)
                                                                <div class="flex-shrink-0">
                                                                    <img src="{{ asset('storage/' . $boardingPass->qr_path) }}" alt="QR" class="w-[80px] h-[80px] object-contain rounded-lg bg-white border border-[#FFD4B5]">
                                                                </div>
                                                            @else
                                                                <div class="flex-shrink-0 flex items-center justify-center w-[80px] h-[80px] rounded-lg bg-white border border-[#FFD4B5]">
                                                                    <span class="material-symbols-outlined text-[48px] text-[#FFD4B5]">qr_code_2</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach

                                                    <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-[rgba(233,225,219,0.5)]">
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#EAF8EF] text-[#159447] text-[10px] font-extrabold">
                                                            <span class="material-symbols-outlined text-[12px]">verified</span>Terverifikasi
                                                        </span>
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[10px] font-extrabold">
                                                            <span class="material-symbols-outlined text-[12px]">luggage</span>2 Bagasi
                                                        </span>
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#F8F4F1] text-[#1C1917] text-[10px] font-extrabold">
                                                            <span class="material-symbols-outlined text-[12px]">airline_seat_recline_normal</span>
                                                            {{ $booking->flight->seat_class_label }}
                                                        </span>
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[10px] font-extrabold">
                                                            <span class="material-symbols-outlined text-[12px]">schedule</span>
                                                            {{ $booking->flight->departure_time->copy()->subMinutes(45)->format('H:i') }} (Boarding)
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('payment.status', ['booking' => $booking, 'payment' => $booking->payment]) }}" class="inline-flex items-center justify-center min-h-[42px] px-[17px] rounded-[11px] border border-[#FFD4B5] bg-white text-[#E65F00] text-[11px] font-extrabold hover:bg-[#FFF0E3] hover:border-[#FF7200] transition-all">
                                            Detail
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="px-6 py-12 text-center bg-white border border-[#E9E1DB] rounded-[22px] shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                            <span class="material-symbols-outlined text-5xl text-[#FFD4B5]">confirmation_number</span>
                            <h3 class="mt-3 mb-1.5 text-[17px] font-extrabold text-[#1C1917]">Belum Ada Tiket Aktif</h3>
                            <p class="m-0 mb-5 text-xs font-medium text-[#6B625C]">Temukan penerbangan dan mulai perjalanan Anda bersama GoZay.</p>
                            <a href="{{ route('search.results') }}" class="inline-flex items-center justify-center gap-2 px-6 min-h-[42px] rounded-[11px] bg-[#FF7200] text-white text-[11px] font-extrabold shadow-[0_8px_20px_rgba(255,114,0,0.18)] hover:bg-[#E65F00] transition-all">
                                <span class="material-symbols-outlined text-[17px]">search</span>
                                Cari Tiket
                            </a>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- RIWAYAT PERJALANAN --}}
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="flex items-center gap-2.5 m-0 text-[20px] font-extrabold tracking-[-0.02em] text-[#1C1917]">
                        <span class="material-symbols-outlined text-[24px] text-[#FF7200]">history</span>
                        Riwayat Perjalanan
                    </h2>
                </div>

                <div class="flex flex-col gap-2.5">
                    @forelse ($historyBookings as $booking)
                        @php
                            $flight = $booking->flight;
                            $isCancelled = $booking->booking_status === 'cancelled';
                            $wasRejected = $isCancelled && $booking->payment && $booking->payment->status === \App\Models\Payment::STATUS_FAILED;
                            $hasBoardingPass = $booking->boardingPass && !$isCancelled;
                        @endphp

                        <article x-data="{ open: false }" class="relative overflow-hidden px-[19px] py-[17px] flex flex-col border border-[#E9E1DB] rounded-[16px] bg-white shadow-[0_5px_18px_rgba(83,45,18,0.035)] hover:border-[#FFD4B5] hover:bg-[#FFF8F3] hover:translate-x-[3px] transition-all cursor-pointer">
                            <div class="flex items-center gap-3.5 min-w-0" @click="open = !open">
                                <div class="w-11 h-11 shrink-0 flex items-center justify-center rounded-[14px] bg-[#F8F4F1] text-[#FF7200]">
                                    <span class="material-symbols-outlined text-[21px]">flight_land</span>
                                </div>
                                <div>
                                    <h3 class="m-0 mb-1.5 text-[13px] font-extrabold text-[#1C1917]">
                                        {{ $flight?->origin?->code ?? '???' }}
                                        <span class="material-symbols-outlined text-[15px] align-middle text-[#A49A92]">arrow_forward</span>
                                        {{ $flight?->destination?->code ?? '???' }}
                                    </h3>
                                    <p class="m-0 text-[10px] font-semibold text-[#938A83]">
                                        {{ $flight?->flight_number ?? 'GZ-???' }} &bull; {{ $flight?->departure_date?->translatedFormat('d M Y') ?? '-' }}
                                        @if ($hasBoardingPass)
                                            <span class="material-symbols-outlined text-[12px] text-[#159447] align-middle">check_circle</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5" @click="open = !open">
                                @if ($isCancelled)
                                    <span class="px-2.5 py-1.5 rounded-full bg-[#FEE2E2] text-[#DC2626] text-[10px] font-extrabold">Ditolak</span>
                                    @if ($wasRejected && $flight)
                                        <a href="{{ route('flights.seats', $flight) }}" @click.stop class="inline-flex items-center justify-center px-3 py-1.5 rounded-[10px] border border-[#FF7200] bg-[#FF7200] text-white text-[10px] font-extrabold shadow-[0_6px_16px_rgba(255,114,0,0.18)] hover:bg-[#E65F00] hover:-translate-y-px transition-all">
                                            <span class="material-symbols-outlined text-[15px] mr-1.5">flight_takeoff</span> Pilih Ulang
                                        </a>
                                    @endif
                                @else
                                    <span class="px-2.5 py-1.5 rounded-full bg-[#EAF8EF] text-[#159447] text-[10px] font-extrabold">Selesai</span>
                                @endif
                                @if ($hasBoardingPass)
                                    <span class="material-symbols-outlined text-[#FF7200] text-[20px] transition-transform duration-300" :class="{ 'rotate-180': open }">expand_more</span>
                                @else
                                    <span class="material-symbols-outlined text-[#938A83]">chevron_right</span>
                                @endif
                            </div>
                            @if ($hasBoardingPass)
                                <div x-show="open" x-transition class="w-full mt-3 pt-4 border-t border-[rgba(233,225,219,0.5)]">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="material-symbols-outlined text-[#FF7200] text-[18px]">confirmation_number</span>
                                        <h4 class="m-0 text-[14px] font-extrabold text-[#1C1917]">Boarding Pass</h4>
                                        <span class="px-2 py-0.5 rounded-full bg-[#FF7200] text-white text-[9px] font-extrabold">{{ $booking->booking_code }}</span>
                                    </div>
                                    @foreach ($booking->boardingPasses as $boardingPass)
                                        @php $passenger = $boardingPass->bookingPassenger; @endphp
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 py-2.5 {{ !$loop->last ? 'border-b border-[rgba(233,225,219,0.5)]' : '' }}">
                                            <div class="flex-1 grid grid-cols-2 sm:grid-cols-4 gap-3">
                                                <div>
                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Penumpang</p>
                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $passenger->passenger_name }}</p>
                                                    <p class="m-0 text-[10px] font-semibold text-[#FF7200]">{{ $boardingPass->passenger_number }}</p>
                                                </div>
                                                <div>
                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Kursi</p>
                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $passenger->seat->seat_number }}</p>
                                                </div>
                                                <div>
                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Terminal / Gate</p>
                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $boardingPass->terminal }} / {{ $boardingPass->gate }}</p>
                                                </div>
                                                <div>
                                                    <p class="m-0 text-[10px] font-bold text-[#938A83] uppercase tracking-wide">Kode</p>
                                                    <p class="m-0 text-xs font-extrabold text-[#1C1917]">{{ $boardingPass->boarding_code }}</p>
                                                </div>
                                            </div>
                                            @if ($boardingPass->qr_path)
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $boardingPass->qr_path) }}" alt="QR" class="w-[64px] h-[64px] object-contain rounded-lg bg-white border border-[#FFD4B5]">
                                                </div>
                                            @else
                                                <div class="flex-shrink-0 flex items-center justify-center w-[64px] h-[64px] rounded-lg bg-white border border-[#FFD4B5]">
                                                    <span class="material-symbols-outlined text-[36px] text-[#FFD4B5]">qr_code_2</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-[rgba(233,225,219,0.5)]">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#EAF8EF] text-[#159447] text-[10px] font-extrabold">
                                            <span class="material-symbols-outlined text-[12px]">verified</span>Terverifikasi
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[10px] font-extrabold">
                                            <span class="material-symbols-outlined text-[12px]">airline_seat_recline_normal</span>
                                            {{ $booking->flight->seat_class_label }}
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[10px] font-extrabold">
                                            <span class="material-symbols-outlined text-[12px]">schedule</span>
                                            {{ $booking->flight->departure_time->copy()->subMinutes(45)->format('H:i') }} (Boarding)
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </article>
                    @empty
                        <div class="px-6 py-10 text-center bg-white border border-[#E9E1DB] rounded-[16px]">
                            <span class="material-symbols-outlined text-4xl text-[#FFD4B5]">history</span>
                            <p class="m-0 mt-3 text-xs font-medium text-[#6B625C]">Belum ada riwayat perjalanan.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>

        {{-- RIGHT COLUMN --}}
        <aside class="flex flex-col gap-7">

            {{-- PELACAKAN PESAWAT --}}
            @if ($trackingBooking)
                <section class="overflow-hidden border border-[#E9E1DB] rounded-[22px] bg-white shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                    <div class="px-[19px] py-[17px] flex items-center justify-between border-b border-[#E9E1DB]">
                        <h3 class="flex items-center gap-2.5 m-0 text-[13px] font-extrabold text-[#1C1917]">
                            <span class="material-symbols-outlined text-[21px] text-[#FF7200]">map</span>
                            Pelacakan Pesawat
                        </h3>
                        <span class="px-2.5 py-1 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[10px] font-extrabold">{{ $trackingBooking->flight?->flight_number }}</span>
                    </div>

                    <div class="relative h-[230px] overflow-hidden bg-gradient-to-br from-[#FFF1E5] to-[#F4EDE7]">
                        <div class="absolute inset-0 opacity-35 bg-[linear-gradient(rgba(255,114,0,0.12)_1px,transparent_1px),linear-gradient(90deg,rgba(255,114,0,0.12)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
                        <div class="absolute left-[18%] top-[55%] w-[64%] rotate-[-13deg] border-t-2 border-dashed border-[rgba(255,114,0,0.35)]"></div>

                        <div class="absolute left-[15%] top-[62%] w-[11px] h-[11px] rounded-full bg-[#FF7200] border-[3px] border-white shadow-[0_4px_12px_rgba(255,114,0,0.25)]"></div>
                        <div class="absolute right-[14%] top-[44%] w-[11px] h-[11px] rounded-full bg-[#FF7200] border-[3px] border-white shadow-[0_4px_12px_rgba(255,114,0,0.25)]"></div>

                        <div class="absolute left-[54%] top-[51%] -translate-x-1/2 -translate-y-1/2 w-11 h-11 flex items-center justify-center rounded-full bg-white text-[#FF7200] shadow-[0_10px_25px_rgba(83,45,18,0.14)]">
                            <span class="material-symbols-outlined text-[23px] rotate-[15deg]">flight</span>
                        </div>

                        <div class="absolute left-1/2 bottom-4 -translate-x-1/2 px-3 py-1.5 rounded-full bg-white/90 text-[#1C1917] text-[10px] font-extrabold shadow-[0_5px_15px_rgba(83,45,18,0.08)] whitespace-nowrap">
                            {{ $trackingBooking->flight?->origin?->city }} &rarr; {{ $trackingBooking->flight?->destination?->city }}
                        </div>
                    </div>

                    <div class="px-[19px] py-[17px]">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-[10px] font-semibold text-[#938A83]">Estimasi Tiba</span>
                            <span class="text-[11px] font-extrabold text-[#1C1917]">{{ $trackingBooking->flight?->arrival_time?->format('H:i') }}</span>
                        </div>
                        <div class="w-full h-1.5 overflow-hidden rounded-full bg-[#F0E8E2]">
                            <div class="h-full rounded-full bg-gradient-to-r from-[#FF7200] to-[#FF9A4A] transition-all duration-700" style="width: {{ $trackingProgress }}%"></div>
                        </div>
                    </div>
                </section>
            @endif

            {{-- BUTUH BANTUAN --}}
            <section class="p-[22px] overflow-hidden border border-[#E9E1DB] rounded-[22px] bg-white shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                <div class="w-[45px] h-[45px] flex items-center justify-center mb-3.5 rounded-[14px] bg-[#FFF0E3] text-[#FF7200]">
                    <span class="material-symbols-outlined text-[23px]">support_agent</span>
                </div>
                <h3 class="m-0 mb-2 text-[18px] font-extrabold text-[#1C1917]">Butuh Bantuan?</h3>
                <p class="m-0 mb-5 text-xs leading-relaxed font-medium text-[#6B625C]">
                    Tim dukungan perjalanan kami siap membantu Anda 24/7 untuk segala kebutuhan penerbangan.
                </p>
                <a href="#" class="w-full inline-flex items-center justify-center gap-2 min-h-[43px] rounded-[11px] border border-[#FFD4B5] bg-white text-[#E65F00] text-[11px] font-extrabold hover:bg-[#FF7200] hover:border-[#FF7200] hover:text-white transition-all">
                    <span class="material-symbols-outlined text-[17px]">chat</span>
                    Hubungi Support
                </a>
            </section>

        </aside>

    </div>

</div>
@endsection
