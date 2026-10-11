@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-people me-2"></i>User</h4>
</div>

<div class="card shadow-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIK</th>
                    <th>No. HP</th>
                    <th>Verifikasi</th>
                    <th>Jumlah Booking</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <span class="badge {{ $user->email_verified_at ? 'badge-soft-success' : 'badge-soft-warning' }}">
                                {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum' }}
                            </span>
                        </td>
                        <td>{{ $user->bookings_count }}</td>
                        <td>{{ $user->created_at->translatedFormat('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-5">Belum ada user terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($users->hasPages())
        <div class="card-body">{{ $users->links() }}</div>
    @endif
</div>
@endsection