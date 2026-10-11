@extends('layouts.app')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="card shadow-soft">
    <div class="card-header bg-white fw-bold"><i class="bi bi-receipt me-1"></i>Riwayat Pemesanan</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode Booking</th>
                    <th>Maskapai / No.</th>
                    <th>Rute</th>
                    <th>Tanggal Terbang</th>
                    <th>Kursi</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="fw-semibold">{{ $booking->booking_code }}
                            <small class="d-block text-muted">{{ $booking->created_at->translatedFormat('d M Y H:i') }}</small>
                        </td>
                        <td>{{ $booking->flight->airline->name }}<small class="d-block text-muted">{{ $booking->flight->flight_number }}</small></td>
                        <td>{{ $booking->flight->origin->code }} <i class="bi bi-arrow-right small"></i> {{ $booking->flight->destination->code }}</td>
                        <td>{{ $booking->flight->departure_date->translatedFormat('d M Y') }}<small class="d-block text-muted">{{ $booking->flight->departure_time->format('H:i') }}</small></td>
                        <td>{{ $booking->seatNumbers() }}</td>
                        <td class="fw-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badge = match ($booking->booking_status) {
                                    'paid' => 'badge-soft-success',
                                    'cancelled' => 'badge-soft-danger',
                                    default => 'badge-soft-warning',
                                };
                                $label = match ($booking->booking_status) {
                                    'paid' => 'Dibayar',
                                    'cancelled' => 'Dibatalkan',
                                    default => 'Menunggu Bayar',
                                };
                            @endphp
                            <span class="badge {{ $badge }}">{{ $label }}</span>
                        </td>
                        <td class="text-end">
                            @if ($booking->booking_status === 'pending')
                                <a href="{{ route('payment.create', $booking) }}" class="btn btn-sm btn-primary">Bayar</a>
                            @elseif ($booking->booking_status === 'paid' && $booking->boardingPass)
                                <a href="{{ route('ticket.eticket', $booking) }}" class="btn btn-sm btn-outline-success">E-Tiket</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Belum ada pemesanan. <a href="{{ route('search.results') }}">Cari tiket</a> sekarang.
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($bookings->hasPages())
        <div class="card-body">
            {{ $bookings->links() }}
        </div>
    @endif
</div>
@endsection