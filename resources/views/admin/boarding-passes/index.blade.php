@extends('layouts.admin')

@section('title', 'Boarding Pass Terbit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-qr-code me-2"></i>Boarding Pass & E-Tiket</h4>
</div>

<div class="card shadow-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Penumpang</th>
                    <th>Kode Booking</th>
                    <th>Penumpang</th>
                    <th>Penerbangan</th>
                    <th>Terminal / Gate</th>
                    <th>Diterbitkan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($boardingPasses as $bp)
                    <tr>
                        <td class="fw-bold">{{ $bp->passenger_number }}</td>
                        <td>{{ $bp->booking->booking_code ?? '-' }}</td>
                        <td>{{ $bp->bookingPassenger->passenger_name ?? '-' }}</td>
                        <td>
                            {{ $bp->booking->flight->airline->name ?? '' }} {{ $bp->booking->flight->flight_number ?? '' }}
                            <small class="d-block text-muted">{{ $bp->booking->flight->departure_time->format('H:i') ?? '' }}</small>
                        </td>
                        <td>{{ $bp->terminal }} · {{ $bp->gate }}</td>
                        <td>{{ $bp->issued_at?->translatedFormat('d M Y H:i') }}</td>
                        <td class="text-end">
                            @if ($bp->booking)
                                <a href="{{ route('ticket.boarding', $bp->booking) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-5">Belum ada boarding pass terbit.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($boardingPasses->hasPages())
        <div class="card-body">{{ $boardingPasses->links() }}</div>
    @endif
</div>
@endsection