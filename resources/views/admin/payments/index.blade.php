@extends('layouts.admin')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-cash-coin me-2"></i>Pembayaran</h4>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
</div>

<div class="card shadow-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>User</th>
                    <th>Metode</th>
                    <th>Jumlah</th>
                    <th>Dibuat</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
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
                    <tr>
                        <td class="fw-semibold">{{ $payment->booking->booking_code ?? '-' }}</td>
                        <td>{{ $payment->booking->user->name ?? '-' }}</td>
                        <td>{{ $payment->methodLabel() }}</td>
                        <td class="fw-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>{{ $payment->created_at->translatedFormat('d M Y H:i') }}</td>
                        <td><span class="badge {{ $badge }}">{{ $label }}</span></td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                @if (in_array($payment->status, [\App\Models\Payment::STATUS_PENDING, \App\Models\Payment::STATUS_WAITING]))
                                    <button type="button" class="btn btn-sm btn-success btn-confirm-action"
                                            data-form="#list-app{{ $payment->id }}"
                                            data-variant="success"
                                            data-icon="check_circle"
                                            data-title="Setujui pembayaran ini?"
                                            data-message="Pembayaran kode <strong>{{ $payment->booking->booking_code }}</strong> akan di-ACC dan tiket langsung terbit."
                                            data-confirm-text="Ya, ACC">
                                        <i class="bi bi-check-lg me-1"></i>ACC
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-confirm-action"
                                            data-form="#list-rej{{ $payment->id }}"
                                            data-variant="danger"
                                            data-icon="close"
                                            data-title="Tolak pembayaran ini?"
                                            data-message="Pembayaran kode <strong>{{ $payment->booking->booking_code }}</strong> akan ditolak dan kursi dikembalikan."
                                            data-confirm-text="Ya, Tolak">
                                        <i class="bi bi-x-lg me-1"></i>Tolak
                                    </button>
                                    <form id="list-app{{ $payment->id }}" action="{{ route('admin.payments.approve', $payment) }}" method="POST" class="d-none">@csrf</form>
                                    <form id="list-rej{{ $payment->id }}" action="{{ route('admin.payments.reject', $payment) }}" method="POST" class="d-none">@csrf</form>
                                @endif
                                <button type="button" class="btn btn-sm btn-outline-danger btn-confirm-delete"
                                        data-form="#list-del{{ $payment->id }}"
                                        data-message="Pembayaran kode <strong>{{ $payment->booking->booking_code }}</strong> akan dihapus permanen.">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                                <form id="list-del{{ $payment->id }}" action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-5">Belum ada pembayaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($payments->hasPages())
        <div class="card-body">{{ $payments->links() }}</div>
    @endif
</div>
@endsection