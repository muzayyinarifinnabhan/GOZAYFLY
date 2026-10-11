@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<h4 class="fw-bold text-gz-navy mb-4"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h4>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-soft h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted text-uppercase">User</small>
                    <h4 class="fw-bold mb-0">{{ $stats['users'] }}</h4>
                </div>
                <i class="bi bi-people fs-3 text-primary"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-soft h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted text-uppercase">Penerbangan</small>
                    <h4 class="fw-bold mb-0">{{ $stats['flights'] }}</h4>
                </div>
                <i class="bi bi-airplane fs-3 text-info"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-soft h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted text-uppercase">Booking</small>
                    <h4 class="fw-bold mb-0">{{ $stats['bookings'] }}</h4>
                </div>
                <i class="bi bi-receipt fs-3 text-warning"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-soft h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted text-uppercase">Pendapatan</small>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</h4>
                </div>
                <i class="bi bi-cash-stack fs-3 text-success"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card shadow-soft">
            <div class="card-header bg-white fw-bold"><i class="bi bi-clock-history me-1"></i>Transaksi Terbaru</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>User</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentPayments as $payment)
                            <tr>
                                <td class="fw-semibold">{{ $payment->booking->booking_code ?? '-' }}</td>
                                <td>{{ $payment->booking->user->name ?? '-' }}</td>
                                <td>{{ $payment->methodLabel() }}</td>
                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>
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
                                            'waiting_confirmation' => 'Menunggu',
                                            default => 'Pending',
                                        };
                                    @endphp
                                    <span class="badge {{ $badge }}">{{ $label }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-soft mb-3">
            <div class="card-header bg-white fw-bold"><i class="bi bi-hourglass-split me-1"></i>Menunggu Konfirmasi</div>
            <div class="card-body py-3">
                <div class="d-flex justify-content-center flex-column align-items-center mb-3">
                    <div class="fs-1 fw-bold text-warning">{{ $stats['payments_waiting'] }}</div>
                    <p class="text-muted mb-0">pembayaran perlu disetujui</p>
                </div>
                <ul class="list-unstyled mb-3">
                    @forelse ($waitingPayments as $payment)
                        <li class="d-flex justify-content-between align-items-center gap-2 py-2 border-bottom">
                            <div class="min-w-0">
                                <div class="fw-bold text-truncate small">{{ $payment->booking->booking_code }}</div>
                                <div class="text-muted text-truncate small">
                                    {{ $payment->booking->user->name }} &middot; Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="d-flex gap-1 flex-shrink-0">
                                <button type="button" class="btn btn-sm btn-success" title="Setujui"
                                        onclick="document.getElementById('dash-app{{ $payment->id }}').submit()">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Tolak"
                                        onclick="if(confirm('Tolak pembayaran ini? Kursi akan dikembalikan.')) document.getElementById('dash-rej{{ $payment->id }}').submit()">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <form id="dash-app{{ $payment->id }}" action="{{ route('admin.payments.approve', $payment) }}" method="POST" class="d-none">@csrf</form>
                                <form id="dash-rej{{ $payment->id }}" action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-muted small py-2">Tidak ada pembayaran menunggu.</li>
                    @endforelse
                </ul>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-primary w-100 btn-sm">Proses Semua</a>
            </div>
        </div>
        <div class="card shadow-soft">
            <div class="card-header bg-white fw-bold"><i class="bi bi-geo-alt me-1"></i>Referensi</div>
            <div class="card-body small">
                <div class="d-flex justify-content-between py-1"><span class="text-muted">Bandara</span><strong>{{ $stats['airports'] }}</strong></div>
                <div class="d-flex justify-content-between py-1"><span class="text-muted">Maskapai</span><strong>{{ $stats['airlines'] }}</strong></div>
            </div>
        </div>
    </div>
</div>
@endsection