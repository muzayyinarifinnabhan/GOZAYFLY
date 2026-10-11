@extends('layouts.guest')

@section('title', 'Boarding Pass ' . $booking->booking_code)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                <div>
                    <h4 class="fw-bold text-gz-navy mb-0"><i class="bi bi-passport me-2"></i>Boarding Pass</h4>
                    <small class="text-muted">{{ $booking->booking_code }} · {{ $booking->passengers->count() }} penumpang</small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('ticket.eticket', $booking) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-ticket-perforated me-1"></i>E-Tiket
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="bi bi-printer me-1"></i>Cetak</button>
                </div>
            </div>

            @foreach ($boardingPasses as $boardingPass)
                @php $passenger = $boardingPass->bookingPassenger; @endphp
                <div class="card shadow-soft mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold fs-5"><i class="bi bi-airplane-fill text-primary me-1"></i>GoZay</div>
                                <small class="text-muted">Boarding Pass · {{ $boardingPass->passenger_number }}</small>
                            </div>
                            <div class="text-end">
                                <div class="fs-3 fw-bold">{{ $booking->flight->flight_number }}</div>
                                <small class="text-muted">{{ $booking->flight->airline->name }}</small>
                            </div>
                        </div>

                        <div class="row align-items-center my-4">
                            <div class="col-4">
                                <div class="fs-3 fw-bold">{{ $booking->flight->departure_time->format('H:i') }}</div>
                                <div class="fw-semibold">{{ $booking->flight->origin->code }}</div>
                                <small class="text-muted">{{ $booking->flight->origin->name }}</small>
                            </div>
                            <div class="col-4 text-center">
                                <div class="small text-muted">{{ $booking->flight->departure_date->translatedFormat('d M Y') }}</div>
                                <div class="ticket-line"></div>
                                <div class="small text-muted">{{ $booking->flight->duration_label }}</div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="fs-3 fw-bold">{{ $booking->flight->arrival_time->format('H:i') }}</div>
                                <div class="fw-semibold">{{ $booking->flight->destination->code }}</div>
                                <small class="text-muted">{{ $booking->flight->destination->name }}</small>
                            </div>
                        </div>

                        <div class="ticket-cut"></div>

                        <div class="row g-3 mt-2">
                            <div class="col-6 col-md-3">
                                <div class="small text-muted">Penumpang</div>
                                <div class="fw-semibold">{{ $passenger->passenger_name }}</div>
                                <small class="text-muted">{{ $boardingPass->passenger_number }}</small>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="small text-muted">Kursi</div>
                                <div class="fw-semibold fs-4 text-primary">{{ $passenger->seat->seat_number }}</div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="small text-muted">Boarding</div>
                                <div class="fw-semibold">{{ $boardingPass->terminal }}</div>
                                <small class="text-muted">{{ $boardingPass->gate }}</small>
                            </div>
                            <div class="col-6 col-md-3 text-md-center">
                                @if ($boardingPass->qr_path)
                                    <img src="{{ asset('storage/' . $boardingPass->qr_path) }}" alt="QR" style="max-width:110px;">
                                @else
                                    <i class="bi bi-qr-code text-muted" style="font-size:4rem;"></i>
                                @endif
                                <small class="d-block text-muted">Kode: {{ $boardingPass->boarding_code }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($boardingPass->boarding_pdf))
                    <div class="text-end mb-4">
                        <a href="{{ route('ticket.pdf', ['boardingPass' => $boardingPass, 'type' => 'boarding']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-file-earmark-pdf me-1"></i>Unduh PDF {{ $passenger->passenger_name }}
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
