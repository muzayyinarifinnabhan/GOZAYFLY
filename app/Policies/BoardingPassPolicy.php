<?php

namespace App\Policies;

use App\Models\BoardingPass;
use App\Models\User;

/**
 * Policy BoardingPass - e-ticket/boarding pass hanya untuk pemilik booking.
 */
class BoardingPassPolicy
{
    public function view(User $user, BoardingPass $boardingPass): bool
    {
        return $user->id === $boardingPass->booking->user_id;
    }
}