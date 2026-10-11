<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Payment (pembayaran).
 * Status: pending -> waiting_confirmation -> success/failed.
 */
class Payment extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_WAITING = 'waiting_confirmation';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    protected $fillable = [
        'booking_id',
        'method',
        'va_number',
        'provider',
        'amount',
        'receipt_image',
        'status',
        'admin_id',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Relasi: pembayaran milik booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Relasi: admin yang menyetujui.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Helper: label klasifikasi tipe metode untuk badge.
     */
    public function methodLabel(): string
    {
        $map = [
            'bca' => 'BCA',
            'bni' => 'BNI',
            'bri' => 'BRI',
            'mandiri' => 'Bank Mandiri',
            'visa' => 'Visa',
            'mastercard' => 'Mastercard',
            'qris' => 'QRIS',
        ];

        return $map[$this->method] ?? ucfirst($this->method);
    }

    /**
     * Generate payload QRIS (EMVCo) berisi nominal + merchant GoZay.
     * Hanya untuk metode qris; selain itu kembalikan string kosong.
     */
    public function qrisPayload(): string
    {
        if ($this->method !== 'qris') {
            return '';
        }

        // Merchant ID deterministik dari kode booking agar konsisten per transaksi
        $merchantId = '9100' . str_pad(
            substr(preg_replace('/\D/', '', $this->booking->booking_code), 0, 8),
            8,
            '0',
            STR_PAD_LEFT
        );

        $amount = (string) $this->amount;
        $name = 'GOZAY AIRLINES';
        $city = 'JAKARTA';

        // Merchant Account Information (tag 26)
        $merchantInfo = $this->tlv('00', 'ID.CO.QRIS.WWW');
        $merchantInfo .= $this->tlv('01', $merchantId);
        $tag26 = $this->tlv('26', $merchantInfo);

        // Body tanpa CRC
        $body = '000201010212';
        $body .= $tag26;
        $body .= $this->tlv('53', '360');       // IDR
        $body .= $this->tlv('54', $amount);     // nominal
        $body .= $this->tlv('58', 'ID');        // negara
        $body .= $this->tlv('59', $name);       // nama merchant
        $body .= $this->tlv('60', $city);       // kota

        // CRC16-CCITT (tag 63) wajib di akhir payload QRIS
        $base = $body . '6304';
        $crc = $this->crc16($base);

        return $base . strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
    }

    /**
     * Format TLV (tag 2 digit + panjang 2 digit + value).
     */
    private function tlv(string $tag, string $value): string
    {
        $length = str_pad((string) strlen($value), 2, '0', STR_PAD_LEFT);

        return $tag . $length . $value;
    }

    /**
     * CRC16-CCITT (polynomial 0x1021, init 0xFFFF) sesuai standar QRIS.
     */
    private function crc16(string $data): int
    {
        $crc = 0xFFFF;
        $len = strlen($data);

        for ($i = 0; $i < $len; $i++) {
            $crc ^= ord($data[$i]) << 8;

            for ($j = 0; $j < 8; $j++) {
                $crc = ($crc & 0x8000)
                    ? (($crc << 1) ^ 0x1021) & 0xFFFF
                    : ($crc << 1) & 0xFFFF;
            }
        }

        return $crc;
    }
}