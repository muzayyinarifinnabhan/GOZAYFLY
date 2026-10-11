@extends('layouts.landing')

@section('title', 'Ringkasan Pemesanan')

@section('content')
<div data-sk-zone>
<div data-sk-skeleton aria-hidden="true" class="space-y-6">
    <!-- Progress Bar Skeleton -->
    <section class="bg-surface-container-lowest py-8 shadow-sm">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="flex items-center justify-between max-w-3xl mx-auto">
                @for($i = 0; $i < 4; $i++)
                    <div class="flex flex-col items-center gap-2">
                        <div class="gk-skel gsk-circle" style="width:40px;height:40px"></div>
                        <div class="gk-skel gsk-line" style="width:50px;height:10px"></div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Page Header Skeleton -->
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-8">
        <div class="gk-skel gsk-line-2xl" style="width:280px;height:40px;margin-bottom:24px"></div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-desktop">
            <div class="lg:col-span-8 space-y-4">
                @for($i = 0; $i < 3; $i++)
                    <div class="gk-skel gsk-card" style="border-radius:20px;padding:24px">
                        <div class="flex items-center space-x-4 pb-4 border-b border-outline-variant/20 mb-4">
                            <div class="gk-skel gsk-icon" style="width:48px;height:48px;border-radius:16px"></div>
                            <div class="flex-grow">
                                <div class="gk-skel gsk-line-md" style="width:160px;height:20px;margin-bottom:6px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:120px;height:12px"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between flex-wrap gap-6">
                            <div class="text-center">
                                <div class="gk-skel gsk-line-xl" style="width:60px;height:24px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:80px;height:12px;margin-top:4px"></div>
                            </div>
                            <div class="flex flex-col items-center px-6">
                                <div class="gk-skel gsk-icon" style="width:24px;height:24px;border-radius:50%;margin-bottom:8px"></div>
                                <div class="gk-skel gsk-line-xs" style="width:60px;height:10px"></div>
                            </div>
                            <div class="text-center">
                                <div class="gk-skel gsk-line-xl" style="width:60px;height:24px"></div>
                                <div class="gk-skel gsk-line-sm" style="width:80px;height:12px;margin-top:4px"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="lg:col-span-4">
                <div class="gk-skel gsk-card" style="border-radius:20px;padding:24px;position:sticky;top:24px">
                    <div class="gk-skel gsk-line-md" style="width:100px;height:18px;margin-bottom:24px"></div>
                    @for($i = 0; $i < 3; $i++)
                        <div class="flex justify-between items-center py-2 mb-2">
                            <div class="gk-skel gsk-line-sm" style="width:120px;height:12px"></div>
                            <div class="gk-skel gsk-line-md" style="width:80px;height:16px"></div>
                        </div>
                    @endfor
                    <div class="gk-skel gsk-line" style="width:100%;height:2px;margin:12px 0"></div>
                    <div class="flex justify-between items-center mb-4">
                        <div class="gk-skel gsk-line-md" style="width:80px;height:18px"></div>
                        <div class="gk-skel gsk-line-xl" style="width:80px;height:24px"></div>
                    </div>
                    <div class="gk-skel gsk-btn" style="width:100%;height:48px;border-radius:16px;margin-top:16px"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div data-sk-content>
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
                <div class="w-10 h-10 rounded-full bg-secondary-container text-white flex items-center justify-center mb-2 shadow-lg scale-110">
                    <span class="material-symbols-outlined text-[20px]">airplane_ticket</span>
                </div>
                <span class="font-label-sm text-label-sm text-secondary font-bold">Pilih</span>
            </div>
            <div class="flex-grow h-[2px] bg-outline-variant/30 mx-4 mb-6"></div>
            <div class="flex flex-col items-center opacity-50">
                <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center mb-2">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
                <span class="font-label-sm text-label-sm text-on-surface-variant">Bayar</span>
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
    <h2 class="font-headline-lg text-headline-lg text-primary mb-6 flex items-center gap-3">
        <img src="{{ asset('logo.png') }}" alt="GoZay" class="h-9 w-auto"> Ringkasan Pemesanan
    </h2>

    <div class="flex flex-col lg:flex-row gap-gutter-desktop">
        <div class="flex-grow space-y-stack-md">
            <form action="{{ route('bookings.store', $flight) }}" method="POST" id="summary-form">
                @csrf
                @foreach ($seats as $seat)
                    <input type="hidden" name="seats[]" value="{{ $seat->id }}">
                @endforeach

                <!-- Info penerbangan -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-outline-variant/10">
                    <div class="flex items-center space-x-4 pb-4 border-b border-outline-variant/20 mb-4">
                        <div class="w-12 h-12 bg-surface-container rounded-xl flex items-center justify-center overflow-hidden">
                            @if ($flight->airline->logo)
                                <img class="w-8 h-8 object-contain" src="{{ asset('storage/' . $flight->airline->logo) }}" alt="{{ $flight->airline->name }}"/>
                            @else
                                <span class="material-symbols-outlined text-primary">flight</span>
                            @endif
                        </div>
                        <div>
                            <div class="font-headline-md text-headline-md font-bold text-primary">{{ $flight->airline->name }} &middot; {{ $flight->flight_number }}</div>
                            <small class="font-label-sm text-label-sm text-outline">{{ $flight->departure_date->translatedFormat('l, d F Y') }}</small>
                        </div>
                    </div>
                    <div class="flex items-center justify-between flex-wrap gap-6">
                        <div class="text-center">
                            <p class="font-headline-md text-headline-md font-bold text-on-surface leading-none">{{ $flight->departure_time->format('H:i') }}</p>
                            <small class="font-label-md text-label-md text-outline">{{ $flight->origin->code }} &bull; {{ $flight->origin->city }}</small>
                        </div>
                        <div class="flex flex-col items-center px-6">
                            <span class="material-symbols-outlined text-primary text-2xl rotate-90">flight</span>
                            <small class="font-label-sm text-label-sm text-secondary font-semibold">{{ $flight->duration_label }}</small>
                        </div>
                        <div class="text-center">
                            <p class="font-headline-md text-headline-md font-bold text-on-surface leading-none">{{ $flight->arrival_time->format('H:i') }}</p>
                            <small class="font-label-md text-label-md text-outline">{{ $flight->destination->code }} &bull; {{ $flight->destination->city }}</small>
                        </div>
                    </div>
                </div>

                <!-- Kursi terpilih -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-outline-variant/10">
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">grid_view</span> Kursi Terpilih
                        <span class="ml-auto bg-secondary-container/10 text-secondary px-3 py-1 rounded-full font-label-md text-label-md font-bold">{{ $seats->count() }} kursi</span>
                    </h3>
                    <div class="space-y-3">
                        @foreach ($seats as $seat)
                            <div class="flex justify-between items-center bg-secondary-container/10 border border-secondary-container/20 rounded-2xl p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary flex items-center justify-center font-bold shadow-md">
                                        {{ $seat->seat_number }}
                                    </div>
                                    <div>
                                        <div class="font-headline-md text-headline-md font-bold text-secondary">{{ $seat->seat_number }}</div>
                                        <small class="font-label-sm text-label-sm text-on-surface-variant">{{ ucfirst(str_replace('_', ' ', $seat->class)) }}</small>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <small class="font-label-sm text-label-sm text-on-surface-variant block">Harga Kursi</small>
                                    <div class="font-headline-md text-headline-md font-bold text-secondary">Rp {{ number_format($seat->price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Data penumpang -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-outline-variant/10">
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">badge</span> Data Penumpang
                        <span class="ml-auto bg-primary/5 text-primary px-3 py-1 rounded-full font-label-md text-label-md font-bold">{{ $seats->count() }} penumpang</span>
                    </h3>
                    <div class="space-y-6">
                        @foreach ($seats as $index => $seat)
                            <div class="border border-outline-variant/20 rounded-2xl p-5">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-headline-md text-headline-md font-bold text-primary">
                                        <span class="material-symbols-outlined align-middle text-secondary mr-1">person</span> Penumpang {{ $loop->iteration }}
                                    </h4>
                                    <span class="bg-secondary-container/10 text-secondary px-3 py-1 rounded-full font-label-md text-label-md font-bold">Kursi {{ $seat->seat_number }}</span>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="font-label-md text-label-md text-on-surface-variant block mb-2">Nama Lengkap (sesuai KTP/Paspor)</label>
                                        <input type="text" name="passenger_name[{{ $index }}]" class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-2xl focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('passenger_name.'.$index) border-error @enderror"
                                               value="{{ old('passenger_name.'.$index, auth()->user()->name ?? '') }}" required>
                                        @error('passenger_name.'.$index) <div class="text-error text-sm mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <label class="font-label-md text-label-md text-on-surface-variant block mb-2">NIK / No. Paspor (16 digit)</label>
                                        <input type="text" name="passenger_nik[{{ $index }}]" class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant rounded-2xl focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('passenger_nik.'.$index) border-error @enderror"
                                               maxlength="16" inputmode="numeric" value="{{ old('passenger_nik.'.$index, auth()->user()->nik ?? '') }}" required>
                                        @error('passenger_nik.'.$index) <div class="text-error text-sm mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if (session('error'))
                        <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700">
                            <span class="material-symbols-outlined text-[18px] align-middle mr-1">warning</span>{{ session('error') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="w-full bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-lg shadow-secondary-container/30 flex items-center justify-center gap-2 py-4">
                    Lanjutkan ke Pembayaran <span class="material-symbols-outlined text-[22px] ml-1">arrow_forward</span>
                </button>
            </form>
        </div>

        <!-- Sisi kanan: rincian total -->
        <div class="w-full lg:w-80 flex-shrink-0">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-outline-variant/10 sticky top-28">
                <h4 class="font-headline-md text-headline-md text-primary pb-3 border-b border-outline-variant/20 mb-4">Rincian Harga</h4>
                @foreach ($seats as $seat)
                    <div class="flex justify-between items-center py-2 font-label-md text-label-md text-on-surface-variant">
                        <span>Kursi {{ $seat->seat_number }} ({{ ucfirst(str_replace('_', ' ', $seat->class)) }})</span>
                        <span class="font-semibold text-on-surface">Rp {{ number_format($seat->price, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <hr class="border-outline-variant/20 my-3">
                <div class="flex justify-between items-center">
                    <span class="font-headline-md text-headline-md font-bold">Total</span>
                    <span class="font-headline-md text-headline-md font-bold text-secondary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant mt-4 mb-0">
                    Selanjutnya Anda memilih metode pembayaran. Setelah transfer, admin akan mengonfirmasi.
                </p>
            </div>
</div>
</div>
</div>
</div>
</div>
@endsection
