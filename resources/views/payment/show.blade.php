@extends('layouts.landing')

@section('title', 'Pembayaran ' . $payment->booking->booking_code)

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
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-secondary-container/10 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-[32px]">schedule</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-1">Menunggu Pembayaran dan Persetujuan</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Selesaikan pembayaran melalui <strong class="text-primary">{{ $payment->methodLabel() }}</strong>.</p>
        </div>

        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-outline-variant/10">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Instruksi -->
                <div class="md:w-2/5">
                    <h5 class="font-headline-md text-headline-md text-primary flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">qr_code</span> Instruksi
                    </h5>
                    @if ($payment->va_number)
                        <div class="bg-surface-container-low rounded-2xl p-4 mb-4 border border-outline-variant/10">
                            <small class="font-label-sm text-label-sm text-on-surface-variant block">Virtual Account</small>
                            <div class="font-headline-md text-headline-md font-bold text-secondary tracking-widest py-1">{{ $payment->va_number }}</div>
                            <small class="font-label-sm text-label-sm text-on-surface-variant">a.n. GoZay &middot; {{ $payment->provider }}</small>
                        </div>
                    @elseif ($qrSvg)
                        <div class="bg-surface-container-low rounded-2xl p-4 mb-4 text-center border border-outline-variant/10">
                            <small class="font-label-sm text-label-sm text-on-surface-variant block mb-3">Kode QR Pembayaran</small>
                            <div class="inline-block p-2 bg-white rounded-2xl border border-outline-variant/20">
                                {!! $qrSvg !!}
                            </div>
                            <small class="font-label-sm text-label-sm text-on-surface-variant block mt-3">Scan kode QR menggunakan aplikasi e-wallet / m-banking.</small>
                        </div>
                    @else
                        <div class="bg-surface-container-low rounded-2xl p-4 mb-4 text-center border border-outline-variant/10">
                            <span class="material-symbols-outlined text-secondary" style="font-size:4.5rem;">qr_code_scanner</span>
                            <small class="font-label-sm text-label-sm text-on-surface-variant d-block text-center block">Scan kode QR untuk membayar {{ $payment->methodLabel() }}.</small>
                        </div>
                    @endif
                    <ol class="font-body-md text-body-md text-on-surface-variant ps-4 pl-4 space-y-2">
                        <li>Bayar sesuai nominal di bawah.</li>
                        <li>Klik <strong class="text-primary">Saya Sudah Bayar</strong>.</li>
                        <li>Admin akan mengonfirmasi, lalu e-tiket terbit.</li>
                    </ol>
                </div>

                <!-- Rincian -->
                <div class="md:w-3/5">
                    <h5 class="font-headline-md text-headline-md text-primary flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined">receipt_long</span> Rincian
                    </h5>
                    <div class="space-y-3 font-label-md text-label-md">
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Kode Booking</span>
                            <span class="font-bold text-on-surface">{{ $payment->booking->booking_code }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Rute</span>
                            <span class="font-bold text-on-surface">{{ $payment->booking->flight->origin->code }} &rarr; {{ $payment->booking->flight->destination->code }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Penumpang</span>
                            <span class="font-bold text-on-surface">{{ $payment->booking->passengers->count() }} penumpang</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Kursi</span>
                            <span class="font-bold text-on-surface">{{ $payment->booking->seatNumbers() }}</span>
                        </div>
                    </div>
                    <hr class="border-outline-variant/20 my-4">
                    <div class="flex justify-between items-center">
                        <span class="font-headline-md text-headline-md font-bold">Total Bayar</span>
                        <span class="font-headline-md text-headline-md font-bold text-secondary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </div>

                    <form method="POST" action="{{ route('payment.confirm', $payment) }}" class="mt-6" id="confirm-payment-form">
                        @csrf
                        <button type="submit" class="w-full bg-secondary-container text-on-secondary font-headline-md text-headline-md rounded-2xl hover:bg-secondary transition-all shadow-lg shadow-secondary-container/30 flex items-center justify-center gap-2 py-3.5">
                            <span class="material-symbols-outlined text-[22px]">check_circle</span> Saya Sudah Bayar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('confirm-payment-form').addEventListener('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasikan Pembayaran?',
            text: 'Pastikan Anda sudah membayar sesuai total. Admin akan memverifikasi.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, sudah bayar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) this.submit();
        });
    });
</script>
@endpush
