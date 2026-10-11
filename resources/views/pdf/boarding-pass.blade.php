<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Boarding Pass {{ $booking->booking_code }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #1f2937; font-size: 13px; }
        .bp { border: 2px solid #111827; border-radius: 12px; overflow: hidden; }
        .head { background: #111827; color: #fff; padding: 12px 20px; }
        .head table { width: 100%; }
        .brand { font-weight: bold; font-size: 16px; }
        .body { padding: 20px; }
        .route { width: 100%; }
        .route td { text-align: center; }
        .time { font-size: 26px; font-weight: bold; }
        .code { font-size: 24px; font-weight: bold; }
        .muted { color: #6b7280; font-size: 11px; }
        .meta { width: 100%; border-collapse: collapse; margin-top: 14px; }
        .meta td { padding: 6px 4px; border-top: 2px dashed #cbd5e1; }
        .label { color: #6b7280; font-size: 11px; }
        .value { font-weight: bold; }
        .qr img { width: 96px; height: 96px; }
    </style>
</head>
<body>
    <table class="bp" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table class="head">
                    <tr>
                        <td class="brand">GoZay BOARDING PASS</td>
                        <td align="right">{{ $flight->flight_number }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="body">
                    <table class="route" width="100%">
                        <tr>
                            <td width="33%">
                                <div class="time">{{ $flight->departure_time->format('H:i') }}</div>
                                <div class="code">{{ $flight->origin->code }}</div>
                                <div class="muted">{{ $flight->origin->name }}</div>
                            </td>
                            <td width="34%">
                                <div class="muted">{{ $flight->departure_date->translatedFormat('d M Y') }}</div>
                                <div class="muted">─ {{ $flight->duration_label }} ─</div>
                            </td>
                            <td width="33%">
                                <div class="time">{{ $flight->arrival_time->format('H:i') }}</div>
                                <div class="code">{{ $flight->destination->code }}</div>
                                <div class="muted">{{ $flight->destination->name }}</div>
                            </td>
                        </tr>
                    </table>

                    <table class="meta" width="100%">
                        <tr>
                            <td class="label">Penumpang</td>
                            <td class="label">No. Penumpang</td>
                            <td class="label">Kursi</td>
                            <td class="label">Kelas</td>
                        </tr>
                        <tr>
                            <td class="value">{{ $passenger->passenger_name }}</td>
                            <td class="value">{{ $passengerNumber }}</td>
                            <td class="value">{{ $seat->seat_number }}</td>
                            <td class="value">{{ ucfirst(str_replace('_', ' ', $flight->seat_class)) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Boarding</td>
                            <td class="label">Terminal</td>
                            <td class="label">Gate</td>
                            <td class="label">Kode Booking</td>
                        </tr>
                        <tr>
                            <td class="value">{{ \Carbon\Carbon::parse($flight->departure_time->format('H:i'))->subMinutes(30)->format('H:i') }}</td>
                            <td class="value">{{ $terminal }}</td>
                            <td class="value">{{ $gate }}</td>
                            <td class="value">{{ $booking->booking_code }}</td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td>
                                @php $qrFile = \Illuminate\Support\Facades\Storage::disk('public')->get('qr/qr-' . $booking->booking_code . '.svg'); @endphp
                                @if ($qrFile)
                                    <div class="value">QR: {{ $qr }}</div>
                                    <div class="muted">(lihat halaman web untuk QR gambar)</div>
                                @endif
                            </td>
                            <td align="right" class="muted">Scan di gerbang<br>{{ $flight->origin->name }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>