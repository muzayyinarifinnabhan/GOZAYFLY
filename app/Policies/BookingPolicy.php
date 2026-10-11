<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

/**
 * Policy Booking - hanya pemilik booking yang boleh melihat/mengubah.
 */
class BookingPolicy
{
    /**
     * User hanya bisa melihat booking miliknya sendiri.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    /**
     * User hanya bisa membatalkan booking miliknya.
     */
    public function cancel(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id && in_array($booking->booking_status, ['pending', 'paid']);
    }
}