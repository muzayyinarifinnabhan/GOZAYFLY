@extends('layouts.landing')

@section('title', 'Pilih Metode Pembayaran')

@section('content')
<!-- Progress Bar Section -->
<section class="bg-surface-container-lowest py-8 shadow-sm">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center justify-between max-w-3xl mx-auto">
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center mb-2 shadow-lg ring-4 ring-primary/10">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <span class="font-label-sm text-label-sm text-primary font-bold">Cari</span>
            </div>
            <div class="flex-grow h-[2px] bg-primary mx-4 mb-6"></div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center mb-2 shadow-lg ring-4 ring-primary/10">
                    <span class="material-symbols-outlined text-[20px]">airplane_ticket</span>
                </div>
                <span class="font-label-sm text-label-sm text-primary font-bold">Pilih</span>
            </div>
            <div class="flex-grow h-[2px] bg-primary mx-4 mb-6"></div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-secondary-container text-white flex items-center justify-center mb-2 shadow-lg scale-110">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
                <span class="font-label-sm text-label-sm text-secondary font-bold">Bayar</span>
            </div>
            <div class="flex-grow h-[2px] bg-outline-variant/30 mx-4 mb-6"></div>
            <div class="flex flex-col items-center opacity-50">
                <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center mb-2">
                    <span class="material-symbols-outlined text-[20px]">done_all</span>
                </div>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Selesai</span>
            </div>
        </div>
    </div>
</section>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-secondary-container/10 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-[32px]">credit_card</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-1">Metode Pembayaran</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Booking <strong class="text-primary">{{ $booking->booking_code }}</strong> &middot; Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-outline-variant/10">
            <div class="flex justify-between items-center py-3 border-b border-outline-variant/20 mb-5 font-label-md text-label-md">
                <span class="text-on-surface-variant">Rute</span>
                <span class="font-bold text-primary">{{ $booking->flight->origin->code }} &rarr; {{ $booking->flight->destination->code }}</span>
            </div>

            <form method="POST" action="{{ route('payment.store') }}">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @php
                        $methods = [
                            ['slug' => 'bca', 'name' => 'Bank BCA', 'icon' => 'account_balance'],
                            ['slug' => 'bni', 'name' => 'Bank BNI', 'icon' => 'account_balance'],
                            ['slug' => 'bri', 'name' => 'Bank BRI', 'icon' => 'account_balance'],
                            ['slug' => 'mandiri', 'name' => 'Bank Mandiri', 'icon' => 'account_balance'],
                            ['slug' => 'visa', 'name' => 'Kartu Visa', 'icon' => 'credit_card'],
                            ['slug' => 'mastercard', 'name' => 'Kartu Mastercard', 'icon' => 'credit_card'],
                            ['slug' => 'qris', 'name' => 'QRIS', 'icon' => 'qr_code_scanner'],
                        ];
                    @endphp
                    @foreach ($methods as $m)
                        <label class="relative cursor-pointer">
                            <input type="radio" class="peer sr-only" name="method" id="method-{{ $m['slug'] }}"
                                   value="{{ $m['slug'] }}" {{ $loop->first ? 'checked' : '' }} required>
                            <div class="flex items-center gap-3 p-4 border-2 border-outline-variant rounded-2xl transition-all peer-checked:border-secondary-container peer-checked:bg-secondary-container/10 peer-checked:shadow-md peer-focus-visible:ring-2 peer-focus-visible:ring-secondary-container/40">
                                <span class="w-11 h-11 bg-surface-container rounded-xl text-primary flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined">{{ $m['icon'] }}</span>
                                </span>
                                <span class="font-label-md text-label-md font-bold text-on-surface flex-grow">{{ $m['name'] }}</span>
                                <span class="w-5 h-5 rounded-full border-2 border-outline-variant peer-checked:border-secondary-container peer-checked:bg-secondary-container hidden peer-checked:flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-secondary" style="font-size:14px;">check</span>
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>

                @error('payment_method')
                    <div class="text-error text-sm mt-3">{{ $message }}</div>
                @enderror

                <button type="submit" class="w-full bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-lg shadow-secondary-container/30 flex items-center justify-center gap-2 py-4 mt-6">
                    <span class="material-symbols-outlined text-[22px]">credit_card</span> Bayar Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
