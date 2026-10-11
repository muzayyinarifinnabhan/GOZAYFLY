@extends('layouts.guest')

@section('title', 'Cari Tiket Pesawat')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold text-gz-navy mb-1">Cari Tiket Penerbangan</h2>
            <p class="text-muted mb-4">Pilih kota asal, tujuan, tanggal, dan kelas perjalanan Anda.</p>

            <div class="card shadow-soft">
                <div class="card-body p-4">
                    <form action="{{ route('search.results') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-geo-alt me-1"></i>Bandara Asal</label>
                                <select name="origin" class="form-select" required>
                                    <option value="">-- Pilih asal --</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}" @selected((string) request('origin') === (string) $airport->id)>{{ $airport->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-geo ms-1"></i>Bandara Tujuan</label>
                                <select name="destination" class="form-select" required>
                                    <option value="">-- Pilih tujuan --</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}" @selected((string) request('destination') === (string) $airport->id)>{{ $airport->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-calendar-event me-1"></i>Tanggal Berangkat</label>
                                <input type="date" name="date" class="form-control" min="{{ now()->format('Y-m-d') }}" value="{{ request('date', now()->addDay()->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-calendar-event-slash me-1"></i>Tanggal Pulang (opsional)</label>
                                <input type="date" name="return_date" class="form-control" min="{{ request('date', now()->addDay()->format('Y-m-d')) }}" value="{{ request('return_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-people me-1"></i>Penumpang</label>
                                <select name="passengers" class="form-select">
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}" @selected((int) request('passengers', 1) === $i)>{{ $i }} Orang</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-ticket-perforated me-1"></i>Kelas</label>
                                <select name="seat_class" class="form-select">
                                    @foreach ([
                                        'economy' => 'Economy',
                                        'premium_economy' => 'Premium Economy',
                                        'business' => 'Business',
                                        'first' => 'First Class',
                                    ] as $value => $label)
                                        <option value="{{ $value }}" @selected(request('seat_class', 'economy') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-search me-1"></i>Cari Tiket
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-muted text-center mt-4">
                <a href="{{ route('home') }}">&larr; Kembali ke beranda</a>
            </p>
        </div>
    </div>
</div>
@endsection