@extends('layouts.admin')

@section('title', 'Kelola Kursi - ' . $flight->flight_number)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h4 class="fw-bold text-gz-navy mb-1"><i class="bi bi-grid-3x3-gap me-2"></i>Kursi {{ $flight->flight_number }}</h4>
        <small class="text-muted">{{ $flight->origin->code }} → {{ $flight->destination->code }} · {{ $flight->departure_date->translatedFormat('d M Y') }}</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.flights.index') }}" class="btn btn-outline-secondary">Kembali</a>
        <form action="{{ route('admin.seats.generate', $flight) }}" method="POST"
              onsubmit="return confirm('Generate ulang 200 kursi (50 per kelas)? Semua kursi lama akan dihapus.')">
            @csrf
            <button class="btn btn-warning"><i class="bi bi-arrow-repeat me-1"></i>Generate 200 Kursi</button>
        </form>
    </div>
</div>

<!-- Peta kursi -->
<div class="card shadow-soft mb-4">
    <div class="card-header bg-white fw-bold"><i class="bi bi-grid-3x3-gap me-1"></i>Layout Kursi</div>
    <div class="card-body">
        <div class="seat-grid">
            @foreach ($rows as $row => $seats)
                @foreach ($seats as $seat)
                    <div class="seat {{ $seat->available ? 'seat-available' : 'seat-taken' }}" data-bs-toggle="tooltip"
                         title="{{ $seat->seat_number }} · {{ ucfirst($seat->class) }} · Rp {{ number_format($seat->price, 0, ',', '.') }}">
                        {{ $seat->seat_number }}
                    </div>
                @endforeach
            @endforeach
        </div>
        <p class="small text-muted mt-3 mb-0">
            <span class="seat-legend seat-available"></span> Tersedia &nbsp;
            <span class="seat-legend seat-taken"></span> Dipesan/Ditutup
        </p>
    </div>
</div>

<!-- Edit detail kursi -->
<div class="card shadow-soft">
    <div class="card-header bg-white fw-bold"><i class="bi bi-sliders me-1"></i>Atur Harga & Status</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kursi</th>
                    <th>Baris</th>
                    <th>Kelas</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-end">Simpan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flight->seats as $seat)
                    <tr>
                        <form action="{{ route('admin.seats.update', $seat) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td class="fw-bold">{{ $seat->seat_number }}</td>
                            <td>{{ $seat->seat_row }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $seat->class)) }}</td>
                            <td>
                                <div class="input-group input-group-sm" style="max-width:170px;">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" class="form-control" value="{{ $seat->price }}" min="0" step="1000">
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="available" value="0">
                                    <input class="form-check-input" type="checkbox" name="available" value="1" {{ $seat->available ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-check-lg"></i></button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection