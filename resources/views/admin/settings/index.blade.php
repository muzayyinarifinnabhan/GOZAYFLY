@extends('layouts.admin')

@section('title', 'Konten Website')

@section('content')
@php($settings = $settings ?? collect())
<h4 class="fw-bold text-gz-navy mb-2"><i class="bi bi-layout-text-window-reverse me-2"></i>Konten Website</h4>
<p class="text-muted mb-4">Ubah isi konten halaman utama website user (landing page) dari sini. Perubahan langsung tampil di <a href="{{ route('home') }}" target="_blank">website user</a>.</p>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf

    <div class="row g-3">

        {{-- ===== HERO ===== --}}
        <div class="col-lg-6">
            <div class="card shadow-soft h-100">
                <div class="card-header bg-white fw-bold"><i class="bi bi-easel3 me-1"></i>Hero (Bagian Atas)</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Teks Utama - Bagian Awal</label>
                        <input type="text" name="settings[hero][headline_before]" class="form-control" value="{{ $settings->get('hero.headline_before', 'Temukan') }}">
                        <small class="text-muted">Contoh: "Temukan"</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kata Ditebalkan (berwarna jingga)</label>
                        <input type="text" name="settings[hero][highlight]" class="form-control" value="{{ $settings->get('hero.highlight', 'Petualangan') }}">
                        <small class="text-muted">Contoh: "Petualangan"</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teks Utama - Bagian Akhir</label>
                        <input type="text" name="settings[hero][headline_after]" class="form-control" value="{{ $settings->get('hero.headline_after', 'Anda Berikutnya') }}">
                        <small class="text-muted">Contoh: "Anda Berikutnya"</small>
                    </div>
                    <div>
                        <label class="form-label">Gambar Latar (URL)</label>
                        <input type="url" name="settings[hero][background_image]" class="form-control" value="{{ $settings->get('hero.background_image', '') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== DESTINASI ===== --}}
        <div class="col-lg-6">
            <div class="card shadow-soft h-100">
                <div class="card-header bg-white fw-bold"><i class="bi bi-geo-alt me-1"></i>Destinasi Populer</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Label Kecil Atas</label>
                        <input type="text" name="settings[destinations][eyebrow]" class="form-control" value="{{ $settings->get('destinations.eyebrow', 'Inspirasi') }}">
                    </div>
                    <div>
                        <label class="form-label">Judul Bagian</label>
                        <input type="text" name="settings[destinations][title]" class="form-control" value="{{ $settings->get('destinations.title', 'Destinasi Populer') }}">
                    </div>
                    <small class="text-muted d-block mt-2">Daftar destinasi diambil otomatis dari data Bandara.</small>
                </div>
            </div>
        </div>

        {{-- ===== JANJI GOZAY ===== --}}
        <div class="col-12">
            <div class="card shadow-soft">
                <div class="card-header bg-white fw-bold"><i class="bi bi-patch-check me-1"></i>Janji GoZay (3 Keunggulan)</div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">Judul Bagian</label>
                        <input type="text" name="settings[promises][title]" class="form-control" value="{{ $settings->get('promises.title', 'Terbang dengan Percaya Diri') }}">
                    </div>
                    <div class="row g-3">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="col-md-4">
                                <div class="border rounded-3 p-3 bg-white h-100">
                                    <h6 class="fw-semibold mb-3"><i class="bi bi-{{ $i === 1 ? 'hand-thumbs-up' : ($i === 2 ? 'headset' : 'lightning-charge') }} me-1"></i>Keunggulan {{ $i }}</h6>
                                    <div class="mb-2">
                                        <label class="form-label small">Ikon (Material Symbol)</label>
                                        <input type="text" name="settings[promises][item{{ $i }}][icon]" class="form-control form-control-sm" value="{{ $settings->get("promises.item{$i}.icon", '') }}" placeholder="contoh: payments">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small">Judul</label>
                                        <input type="text" name="settings[promises][item{{ $i }}][title]" class="form-control form-control-sm" value="{{ $settings->get("promises.item{$i}.title", '') }}">
                                    </div>
                                    <div>
                                        <label class="form-label small">Deskripsi</label>
                                        <textarea name="settings[promises][item{{ $i }}][text]" rows="3" class="form-control form-control-sm">{{ $settings->get("promises.item{$i}.text", '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== PENAWARAN TERBATAS ===== --}}
        <div class="col-12">
            <div class="card shadow-soft">
                <div class="card-header bg-white fw-bold"><i class="bi bi-tags me-1"></i>Penawaran Terbatas (Promo)</div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">Judul Bagian</label>
                        <input type="text" name="settings[promos][title]" class="form-control" value="{{ $settings->get('promos.title', 'DISKON S/D 50%') }}">
                    </div>
                    <div class="row g-3">
                        @for ($i = 1; $i <= 2; $i++)
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-white h-100">
                                    <h6 class="fw-semibold mb-3"><i class="bi bi-card-image me-1"></i>Promo {{ $i }}</h6>
                                    <div class="mb-2">
                                        <label class="form-label small">Gambar (URL)</label>
                                        <input type="url" name="settings[promos][item{{ $i }}][image]" class="form-control form-control-sm" value="{{ $settings->get("promos.item{$i}.image", '') }}">
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <label class="form-label small">Badge</label>
                                            <input type="text" name="settings[promos][item{{ $i }}][badge]" class="form-control form-control-sm" value="{{ $settings->get("promos.item{$i}.badge", '') }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small">Persen Diskon</label>
                                            <input type="text" name="settings[promos][item{{ $i }}][discount]" class="form-control form-control-sm" value="{{ $settings->get("promos.item{$i}.discount", '') }}" placeholder="50%">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small">Judul Promo</label>
                                        <input type="text" name="settings[promos][item{{ $i }}][title]" class="form-control form-control-sm" value="{{ $settings->get("promos.item{$i}.title", '') }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small">Harga Mulai Dari</label>
                                        <input type="text" name="settings[promos][item{{ $i }}][price]" class="form-control form-control-sm" value="{{ $settings->get("promos.item{$i}.price", '') }}" placeholder="Rp 425.000">
                                    </div>
                                    <div>
                                        <label class="form-label small">Teks Tombol</label>
                                        <input type="text" name="settings[promos][item{{ $i }}][button_text]" class="form-control form-control-sm" value="{{ $settings->get("promos.item{$i}.button_text", '') }}">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== KONTAK / FOOTER ===== --}}
        <div class="col-lg-6">
            <div class="card shadow-soft">
                <div class="card-header bg-white fw-bold"><i class="bi bi-info-circle me-1"></i>Kontak &amp; Footer</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tagline Footer</label>
                        <textarea name="settings[contact][tagline]" rows="3" class="form-control">{{ $settings->get('contact.tagline', '') }}</textarea>
                    </div>
                    <div>
                        <label class="form-label">Teks Hak Cipta</label>
                        <input type="text" name="settings[contact][copyright]" class="form-control" value="{{ $settings->get('contact.copyright', '') }}">
                        <small class="text-muted">Tahun &copy; otomatis ditambahkan di depan.</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Simpan Konten</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
@endsection