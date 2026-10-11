@extends('layouts.admin')

@section('title', 'Edit Maskapai')

@section('content')
<h4 class="fw-bold text-gz-navy mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Maskapai</h4>

<div class="card shadow-soft">
    <div class="card-body p-4">
        <form action="{{ route('admin.airlines.update', $airline) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Kode Maskapai</label>
                    <input type="text" name="code" class="form-control" maxlength="3" value="{{ old('code', $airline->code) }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nama Maskapai</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $airline->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Logo (kosongkan jika tetap)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    @if ($airline->logo)
                        <img src="{{ asset('storage/' . $airline->logo) }}" class="mt-2" style="height:40px;object-fit:contain;" alt="">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch mt-2">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $airline->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $airline->description) }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary px-4" type="submit"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.airlines.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection