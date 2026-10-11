@extends('layouts.guest')

@section('title', 'Lupa Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-soft">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-key-fill text-primary" style="font-size:2.4rem;"></i>
                        <h4 class="fw-bold text-gz-navy mb-1">Lupa Password</h4>
                        <p class="text-muted small mb-0">Masukkan email dan kami kirim link reset password.</p>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success py-2 small">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button class="btn btn-primary w-100 mb-3" type="submit">Kirim Link Reset</button>
                    </form>
                    <p class="text-center small text-muted mb-0">
                        <a href="{{ route('login') }}" class="text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Kembali ke Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection