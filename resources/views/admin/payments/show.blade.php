@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-receipt me-2"></i>Detail Pembayaran</h4>
    <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-soft">
            <div class="card-header bg-white fw-bold">Informasi Booking</div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kode Booking</span>
                    <span class="fw-semibold">{{ $payment->booking->booking_code }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Pemesan</span>
                    <span>{{ $payment->booking->user->name }} ({{ $payment->booking->user->email }})</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Penumpang</span>
                    <span>{{ $payment->booking->passengers->count() }} penumpang</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Penerbangan</span>
                    <span>{{ $payment->booking->flight->airline->name }} · {{ $payment->booking->flight->flight_number }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Rute</span>
                    <span>{{ $payment->booking->flight->origin->code }} → {{ $payment->booking->flight->destination->code }} · {{ $payment->booking->flight->departure_date->translatedFormat('d M Y') }} {{ $payment->booking->flight->departure_time->format('H:i') }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kursi</span>
                    <span>{{ $payment->booking->seatNumbers() }}</span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted">Status Booking</span>
                    <span class="badge badge-soft-info">{{ ucfirst($payment->booking->booking_status) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-soft sticky-top" style="top:20px;">
            <div class="card-header bg-white fw-bold">Pembayaran</div>
            <div class="card-body">
                @php
                    $badge = match ($payment->status) {
                        'success' => 'badge-soft-success',
                        'failed' => 'badge-soft-danger',
                        'waiting_confirmation' => 'badge-soft-warning',
                        default => 'badge-soft-secondary',
                    };
                    $label = match ($payment->status) {
                        'success' => 'Sukses',
                        'failed' => 'Gagal',
                        'waiting_confirmation' => 'Menunggu Konfirmasi',
                        default => 'Pending',
                    };
                @endphp
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Metode</span>
                    <span class="fw-semibold">{{ $payment->methodLabel() }}</span>
                </div>
                @if ($payment->va_number)
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Virtual Account</span>
                        <span class="fw-semibold">{{ $payment->va_number }}</span>
                    </div>
                @endif
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Jumlah</span>
                    <span class="fw-bold text-danger fs-5">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Status</span>
                    <span class="badge {{ $badge }}">{{ $label }}</span>
                </div>
                @if ($payment->paid_at)
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Dibayar</span>
                        <span>{{ $payment->paid_at->translatedFormat('d M Y H:i') }}</span>
                    </div>
                @endif
                @if ($payment->admin)
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Diverifikasi</span>
                        <span>{{ $payment->admin->name }}</span>
                    </div>
                @endif

@if (in_array($payment->status, [\App\Models\Payment::STATUS_PENDING, \App\Models\Payment::STATUS_WAITING]))
                    <button type="button"
                            class="btn btn-success w-100 mt-3 btn-confirm-action"
                            data-form="#approve{{ $payment->id }}"
                            data-variant="success"
                            data-icon="check_circle"
                            data-title="Setujui pembayaran ini?"
                            data-message="Pembayaran kode <strong>{{ $payment->booking->booking_code }}</strong> akan di-ACC dan tiket langsung terbit."
                            data-confirm-text="Ya, Setujui">
                        <i class="bi bi-check2-circle me-1"></i>Setujui Pembayaran
                    </button>
                    <button type="button"
                            class="btn btn-outline-danger w-100 mt-2 btn-confirm-action"
                            data-form="#reject{{ $payment->id }}"
                            data-variant="danger"
                            data-icon="close"
                            data-title="Tolak pembayaran ini?"
                            data-message="Pembayaran kode <strong>{{ $payment->booking->booking_code }}</strong> akan ditolak dan kursi dikembalikan."
                            data-confirm-text="Ya, Tolak">
                        <i class="bi bi-x-circle me-1"></i>Tolak Pembayaran
                    </button>
                    <form id="approve{{ $payment->id }}" action="{{ route('admin.payments.approve', $payment) }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <form id="reject{{ $payment->id }}" action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endif
            </div>
        </div>

        @if ($payment->receipt_image)
            <div class="card shadow-soft">
                <div class="card-header bg-white fw-bold">Bukti Transfer</div>
                <div class="card-body text-center">
                    <a href="{{ asset('storage/' . $payment->receipt_image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $payment->receipt_image) }}" class="img-fluid rounded" style="max-height:300px;" alt="Bukti bayar">
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection