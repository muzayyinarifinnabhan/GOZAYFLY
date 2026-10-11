@extends('layouts.admin')

@section('title', 'Kelola Penerbangan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-calendar-event me-2"></i>Penerbangan</h4>
    <a href="{{ route('admin.flights.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Jadwal</a>
</div>

<div class="card shadow-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Penerbangan</th>
                    <th>Maskapai</th>
                    <th>Rute</th>
                    <th>Tanggal</th>
                    <th>Jam Terbang</th>
                    <th>Harga</th>
                    <th>Kursi Tersedia</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($flights as $flight)
                    <tr>
                        <td class="fw-bold">{{ $flight->flight_number }}</td>
                        <td>{{ $flight->airline->name }}</td>
                        <td>{{ $flight->origin->code }} <i class="bi bi-arrow-right small"></i> {{ $flight->destination->code }}</td>
                        <td>{{ $flight->departure_date->translatedFormat('d M Y') }}</td>
                        <td>{{ $flight->departure_time->format('H:i') }} - {{ $flight->arrival_time->format('H:i') }}</td>
                        <td class="fw-semibold">Rp {{ number_format($flight->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-soft-info">{{ $flight->availableSeatsCount() }}</span>
                            <small class="text-muted">/ {{ $flight->seats_total }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $flight->is_active ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $flight->is_active ? 'Aktif' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.seats.index', $flight) }}" class="btn btn-sm btn-outline-info">Kursi</a>
                            <a href="{{ route('admin.flights.edit', $flight) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.flights.destroy', $flight) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus penerbangan?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center text-muted py-5">Belum ada jadwal penerbangan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($flights->hasPages())
        <div class="card-body">{{ $flights->links() }}</div>
    @endif
</div>
@endsection