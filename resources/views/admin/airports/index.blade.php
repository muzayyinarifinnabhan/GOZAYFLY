@extends('layouts.admin')

@section('title', 'Kelola Bandara')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-geo-alt me-2"></i>Bandara</h4>
    <a href="{{ route('admin.airports.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah</a>
</div>

<div class="card shadow-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kota / Negara</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($airports as $airport)
                    <tr>
                        <td class="fw-bold">{{ $airport->code }}</td>
                        <td>{{ $airport->name }}</td>
                        <td>{{ $airport->city }}<small class="d-block text-muted">{{ $airport->country }}</small></td>
                        <td>
                            <span class="badge {{ $airport->is_active ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $airport->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.airports.edit', $airport) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.airports.destroy', $airport) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus bandara {{ $airport->code }}?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-5">Belum ada bandara.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($airports->hasPages())
        <div class="card-body">{{ $airports->links() }}</div>
    @endif
</div>
@endsection