@extends('layouts.admin')

@section('title', 'Kelola Maskapai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-building me-2"></i>Maskapai</h4>
    <a href="{{ route('admin.airlines.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah</a>
</div>

<div class="card shadow-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Maskapai</th>
                    <th>Logo</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($airlines as $airline)
                    <tr>
                        <td class="fw-bold">{{ $airline->code }}</td>
                        <td>{{ $airline->name }}</td>
                        <td>
                            @if ($airline->logo)
                                <img src="{{ asset('storage/' . $airline->logo) }}" style="height:34px;width:auto;object-fit:contain;" alt="">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-truncate" style="max-width:260px;">{{ $airline->description }}</td>
                        <td>
                            <span class="badge {{ $airline->is_active ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $airline->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.airlines.edit', $airline) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.airlines.destroy', $airline) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus maskapai {{ $airline->name }}?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-5">Belum ada maskapai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($airlines->hasPages())
        <div class="card-body">{{ $airlines->links() }}</div>
    @endif
</div>
@endsection