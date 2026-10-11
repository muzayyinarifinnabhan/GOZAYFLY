<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>E-Tiket {{ $booking->booking_code }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #1f2937; font-size: 13px; }
        .ticket { border: 2px solid #0d6efd; border-radius: 14px; overflow: hidden; }
        .head { background: #0d6efd; color: #fff; padding: 14px 22px; }
        .head table { width: 100%; }
        .brand { font-weight: bold; font-size: 18px; }
        .body { padding: 22px; }
        .route { width: 100%; text-align: center; margin: 10px 0; }
        .route td { vertical-align: top; }
        .time { font-size: 26px; font-weight: bold; }
        .code { font-size: 20px; font-weight: bold; }
        .muted { color: #6b7280; font-size: 11px; }
        .cut { border-top: 2px dashed #cbd5e1; margin: 16px 0; }
        .details { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .details td { padding: 5px 4px; vertical-align: top; }
        .details td.label { color: #6b7280; font-size: 11px; }
        .details td.value { font-weight: bold; }
        .row { width: 100%; margin: 6px 0; }
        .row td { padding: 5px 0; }
        .total { font-weight: bold; font-size: 16px; }
        .qr { margin-top: 12px; }
        .qr img { width: 110px; height: 110px; }
        .badge-ok { color: #155724; font-weight: bold; }
    </style>
</head>
<body>
    <table class="ticket" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <table class="head">
                    <tr>
                        <td class="brand">GoZay &nbsp;Tiket Elektronik</td>
                        <td align="right">TERBIT</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="body">
                    <table class="route" width="100%">
                        <tr>
                            <td align="left" width="33%">
                                <div class="time">{{ $flight->departure_time->format('H:i') }}</div>
                                <div class="code">{{ $flight->origin->code }}</div>
                                <div class="muted">{{ $flight->origin->city }}</div>
                            </td>
                            <td align="center" width="34%">
                                <div class="muted">{{ $flight->duration_label }}</div>
                                <div class="muted">{{ $flight->departure_date->translatedFormat('d F Y') }}</div>
                            </td>
                            <td align="right" width="33%">
                                <div class="time">{{ $flight->arrival_time->format('H:i') }}</div>
                                <div class="code">{{ $flight->destination->code }}</div>
                                <div class="muted">{{ $flight->destination->city }}</div>
                            </td>
                        </tr>
                    </table>

                    <div class="cut"></div>

                    <table class="details" width="100%">
                        <tr>
                            <td class="label">Maskapai</td>
                            <td class="label">No. Penerbangan</td>
                            <td class="label">No. Penumpang</td>
                            <td class="label">Kursi</td>
                        </tr>
                        <tr>
                            <td class="value">{{ $flight->airline->name }}</td>
                            <td class="value">{{ $flight->flight_number }}</td>
                            <td class="value">{{ $passengerNumber }}</td>
                            <td class="value">{{ $seat->seat_number }}</td>
                        </tr>
                    </table>

                    <table class="details" width="100%">
                        <tr>
                            <td class="label">Penumpang</td>
                            <td class="value">{{ $passenger->passenger_name }}</td>
                            <td class="label">NIK</td>
                            <td class="value">{{ $passenger->passenger_nik }}</td>
                        </tr>
                    </table>

                    <div class="cut"></div>

                    <table class="row" width="100%">
                        <tr><td class="muted">Kode Booking</td><td align="right" class="value">{{ $booking->booking_code }}</td></tr>
                        <tr><td class="muted">Kelas</td><td align="right" class="value">{{ ucfirst(str_replace('_', ' ', $flight->seat_class)) }}</td></tr>
                        <tr><td class="muted">Terminal / Gate</td><td align="right" class="value">{{ $terminal }} · {{ $gate }}</td></tr>
                        <tr><td class="muted">Diterbitkan</td><td align="right" class="value">{{ \Carbon\Carbon::parse($issued)->translatedFormat('d M Y H:i') }}</td></tr>
                        <tr>
                            <td class="total">TOTAL</td>
                            <td align="right" class="total">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </table>

                    @php $qrFile = \Illuminate\Support\Facades\Storage::disk('public')->get('qr/qr-' . $booking->booking_code . '.svg'); @endphp
                    <table class="qr" width="100%">
                        <tr>
                            <td>
                                @if ($qrFile)
                                    <div class="code">{{ str_replace('|', ' ', $qr) }}</div>
                                @endif
                            </td>
                            <td align="right" class="muted">Kode QR boarding: {{ $qr }}<br>Simpan gambar QR dari halaman web untuk pemindaian di bandara.</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>