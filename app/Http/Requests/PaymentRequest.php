<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validasi form pembayaran (metode & data penumpang).
 */
class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'booking_id' => ['required', 'exists:bookings,id'],
            'method' => ['required', Rule::in(['bca', 'bni', 'bri', 'mandiri', 'visa', 'mastercard', 'qris'])],
            'card_number' => ['nullable', 'string', 'digits_between:13,19'],
            'card_name' => ['nullable', 'string', 'max:255'],
            'card_expiry' => ['nullable', 'string', 'max:10'],
            'card_cvv' => ['nullable', 'string', 'size:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'method.in' => 'Metode pembayaran tidak valid.',
            'card_number.digits_between' => 'Nomor kartu tidak valid.',
            'card_cvv.size' => 'CVV harus 3 digit.',
        ];
    }
}