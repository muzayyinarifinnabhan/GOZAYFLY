<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Kontroler verifikasi OTP email.
 * Alur: registrasi -> redirect ke /verify-otp -> input OTP -> akun terverifikasi -> login.
 */
class OtpVerificationController extends Controller
{
    public function __construct(private OtpService $otpService)
    {
    }

    /**
     * Tampilkan halaman input OTP 6 digit.
     * Diharuskan query email yang valid.
     */
    public function show(Request $request): View|RedirectResponse
    {
        $email = $request->string('email')->toString();

        // Jika tidak ada email di URL, cari dari session registrasi
        if (empty($email)) {
            $email = $request->session()->get('otp_email');
        }

if (empty($email)) {
            return redirect()->route('login')->with('error', 'Silakan daftar terlebih dahulu.');
        }

        return view('auth.verify-otp', compact('email'));
    }

    /**
     * Proses verifikasi OTP yang dimasukkan user.
     */
    public function verify(Request $request)
    {
        // Prosedur validasi dengan restricted input
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

try {
            $record = $this->otpService->verify($request->email, $request->otp);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput(['email' => $request->email]);
        }

        // Tandai akun user sebagai verified, lalu login
        $user = User::where('email', $request->email)->firstOrFail();
        $user->update(['email_verified_at' => now()]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Akun berhasil diverifikasi. Selamat datang, ' . $user->name . '!');
    }

    /**
     * Kirim ulang OTP (maksimal 3x).
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $result = $this->otpService->resend($request->email);

        return back()->with(
            $result['success'] ? 'success' : 'error',
            $result['message']
        );
    }
}