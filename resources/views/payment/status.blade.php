@extends('layouts.landing')

@section('title', 'Status Pembayaran ' . $booking->booking_code)

@section('content')
@php
    $status = $payment->status;
    $icon = 'schedule';
    $iconBox = 'bg-secondary-container/10 text-secondary';
    $title = 'Menunggu Pembayaran';
    $titleColor = 'text-secondary';
    $desc = 'Pembayaran Anda sedang menunggu konfirmasi admin.';
@endphp
@if ($status === \App\Models\Payment::STATUS_WAITING)
    @php
        $icon = 'hourglass';
        $iconBox = 'bg-secondary-container/10 text-secondary';
        $title = 'Menunggu Konfirmasi Admin';
        $titleColor = 'text-secondary';
    @endphp
@elseif ($status === \App\Models\Payment::STATUS_SUCCESS)
    @php
        $icon = 'check_circle';
        $iconBox = 'bg-green-50 text-green-600';
        $title = 'Pembayaran Berhasil';
        $titleColor = 'text-green-600';
        $desc = 'Terima kasih! E-Tiket dan boarding pass Anda telah terbit.';
    @endphp
@elseif ($status === \App\Models\Payment::STATUS_FAILED)
    @php
        $icon = 'cancel';
        $iconBox = 'bg-red-50 text-red-600';
        $title = 'Pembayaran Ditolak';
        $titleColor = 'text-red-600';
        $desc = 'Pembayaran tidak disetujui admin. Silakan pilih ulang kursi dan buat pemesanan baru.';
    @endphp
@endif

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    <div class="max-w-lg mx-auto text-center">
        <div class="w-20 h-20 {{ $iconBox }} rounded-3xl flex items-center justify-center mx-auto mb-5">
            <span class="material-symbols-outlined" style="font-size:2.6rem;">{{ $icon }}</span>
        </div>
        <h2 class="font-headline-lg text-headline-lg {{ $titleColor }} mb-2">{{ $title }}</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">{{ $desc }}</p>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-outline-variant/10 text-start mt-6">
            <div class="space-y-3 font-label-md text-label-md">
                <div class="flex justify-between items-center py-1">
                    <span class="text-on-surface-variant">Kode Booking</span>
                    <span class="font-bold text-on-surface">{{ $booking->booking_code }}</span>
                </div>
                <div class="flex justify-between items-center py-1">
                    <span class="text-on-surface-variant">Metode</span>
                    <span class="font-bold text-on-surface">{{ $payment->methodLabel() }}</span>
                </div>
                <div class="flex justify-between items-center py-1">
                    <span class="text-on-surface-variant">Jumlah</span>
                    <span class="font-bold text-secondary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
                @if ($payment->paid_at)
                    <div class="flex justify-between items-center py-1">
                        <span class="text-on-surface-variant">Dibayar</span>
                        <span class="font-bold text-on-surface">{{ $payment->paid_at->translatedFormat('d M Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mt-6">
            @if ($status === \App\Models\Payment::STATUS_SUCCESS)
                @if ($booking->boardingPass)
                    <a href="{{ route('ticket.eticket', $booking) }}" class="bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-md flex items-center gap-2 px-6 py-3">
                        <span class="material-symbols-outlined text-[20px]">confirmation_number</span> Lihat E-Tiket
                    </a>
                @endif
                <a href="{{ route('bookings.index') }}" class="bg-surface-container text-on-surface font-headline-md text-headline-md rounded-2xl hover:bg-surface-container-high transition-all flex items-center gap-2 px-6 py-3">
                    <span class="material-symbols-outlined text-[20px]">flight</span> Perjalanan Saya
                </a>
            @elseif ($status === \App\Models\Payment::STATUS_FAILED)
                <a href="{{ route('flights.seats', $booking->flight) }}" class="bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-md flex items-center gap-2 px-6 py-3">
                    <span class="material-symbols-outlined text-[20px]">flight_takeoff</span> Pilih Ulang Kursi
                </a>
                <a href="{{ route('bookings.index') }}" class="bg-surface-container text-on-surface font-headline-md text-headline-md rounded-2xl hover:bg-surface-container-high transition-all flex items-center gap-2 px-6 py-3">
                    <span class="material-symbols-outlined text-[20px]">history</span> Perjalanan Saya
                </a>
            @else
                <a href="{{ route('payment.show', $payment) }}" class="bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-md flex items-center gap-2 px-6 py-3">
                    <span class="material-symbols-outlined text-[20px]">credit_card</span> Kembali ke Pembayaran
                </a>
                <button onclick="window.location.reload()" class="bg-surface-container text-on-surface font-headline-md text-headline-md rounded-2xl hover:bg-surface-container-high transition-all flex items-center gap-2 px-6 py-3">
                    <span class="material-symbols-outlined text-[20px]">refresh</span> Refresh
                </button>
            @endif
        </div>
    </div>
</div>
@endsection
