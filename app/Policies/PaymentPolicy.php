<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

/**
 * Policy Payment - user hanya bisa mengakses pembayaran milik booking-nya.
 */
class PaymentPolicy
{
    public function view(User $user, Payment $payment): bool
    {
        return $user->id === $payment->booking->user_id;
    }
}