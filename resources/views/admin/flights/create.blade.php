@extends('layouts.admin')

@section('title', 'Tambah Penerbangan')

@section('content')
<h4 class="fw-bold text-gz-navy mb-4"><i class="bi bi-plus-circle me-2"></i>Tambah Penerbangan</h4>

<div class="card shadow-soft">
    <div class="card-body p-4">
        <form action="{{ route('admin.flights.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Maskapai</label>
                    <select name="airline_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. Penerbangan</label>
                    <input type="text" name="flight_number" class="form-control" placeholder="GA-210" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kelas</label>
                    <select name="seat_class" class="form-select">
                        <option value="economy">Economy</option>
                        <option value="premium_economy">Premium Economy</option>
                        <option value="business">Business</option>
                        <option value="first">First Class</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bandara Asal</label>
                    <select name="origin_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->id }}">{{ $airport->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bandara Tujuan</label>
                    <select name="destination_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->id }}">{{ $airport->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Terbang</label>
                    <input type="date" name="departure_date" class="form-control" min="{{ now()->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jam Berangkat</label>
                    <input type="time" name="departure_time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jam Tiba</label>
                    <input type="time" name="arrival_time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Durasi (menit)</label>
                    <input type="number" name="duration_minutes" class="form-control" min="1" placeholder="90" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Harga Dasar (Rp)</label>
                    <input type="number" name="price" class="form-control" min="0" step="1000" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total Kursi</label>
                    <input type="number" name="seats_total" class="form-control" value="50" min="1">
                </div>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary px-4" type="submit"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.flights.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection