<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

/**
 * Admin - Kelola User (daftar penumpang).
 */
class UserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount('bookings')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }
}