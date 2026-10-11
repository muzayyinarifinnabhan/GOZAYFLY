@extends('layouts.admin')

@section('title', 'Edit Bandara')

@section('content')
<h4 class="fw-bold text-gz-navy mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Bandara</h4>

<div class="card shadow-soft">
    <div class="card-body p-4">
        <form action="{{ route('admin.airports.update', $airport) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Kode IATA</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" maxlength="3" value="{{ old('code', $airport->code) }}" required>
                    @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nama Bandara</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $airport->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kota</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $airport->city) }}" required>
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Negara</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $airport->country) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gambar Destinasi (opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch mt-2">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $airport->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary px-4" type="submit"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.airports.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection