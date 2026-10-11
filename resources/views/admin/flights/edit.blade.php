@extends('layouts.admin')

@section('title', 'Edit Penerbangan')

@section('content')
<h4 class="fw-bold text-gz-navy mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Penerbangan</h4>

<div class="card shadow-soft">
    <div class="card-body p-4">
        <form action="{{ route('admin.flights.update', $flight) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Maskapai</label>
                    <select name="airline_id" class="form-select" required>
                        @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}" {{ $flight->airline_id == $airline->id ? 'selected' : '' }}>{{ $airline->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. Penerbangan</label>
                    <input type="text" name="flight_number" class="form-control" value="{{ old('flight_number', $flight->flight_number) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kelas</label>
                    <select name="seat_class" class="form-select">
                        @foreach (['economy', 'premium_economy', 'business', 'first'] as $cls)
                            <option value="{{ $cls }}" {{ $flight->seat_class == $cls ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $cls)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bandara Asal</label>
                    <select name="origin_id" class="form-select" required>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->id }}" {{ $flight->origin_id == $airport->id ? 'selected' : '' }}>{{ $airport->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bandara Tujuan</label>
                    <select name="destination_id" class="form-select" required>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->id }}" {{ $flight->destination_id == $airport->id ? 'selected' : '' }}>{{ $airport->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Terbang</label>
                    <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $flight->departure_date->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jam Berangkat</label>
                    <input type="time" name="departure_time" class="form-control" value="{{ old('departure_time', $flight->departure_time->format('H:i')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jam Tiba</label>
                    <input type="time" name="arrival_time" class="form-control" value="{{ old('arrival_time', $flight->arrival_time->format('H:i')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Durasi (menit)</label>
                    <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $flight->duration_minutes) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Harga Dasar (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $flight->price) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total Kursi</label>
                    <input type="number" name="seats_total" class="form-control" value="{{ old('seats_total', $flight->seats_total) }}">
                </div>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $flight->is_active ? 'checked' : '' }}>
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