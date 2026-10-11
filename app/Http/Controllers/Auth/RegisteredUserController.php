<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    public function __construct(private OtpService $otpService)
    {
    }

    /**
     * Tampilkan halaman registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

/**
     * Proses registrasi:
     * 1. Validasi form (RegisterRequest)
     * 2. Cek email / NIK sudah digunakan (unique rule)
     * 3. Buat user berstatus BELUM terverifikasi (email_verified_at = null)
     * 4. Generate kode OTP + kirim via email antrian
     * 5. Redirect ke halaman verifikasi OTP
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate & kirim OTP (kode juga dicatat di log untuk mode lokal)
        $this->otpService->generate($user->email, 'register');

        Log::info('User baru terdaftar: ' . $user->email . ' (menunggu verifikasi OTP)');

        // Simpan email di session untuk halaman OTP
        session()->put('email', $user->email);

        return redirect()->route('otp.verify', ['email' => $user->email])
            ->with('status', 'Kode OTP telah dikirim ke email Anda.');
    }
}