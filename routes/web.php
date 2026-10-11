<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\BoardingPassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController as UserFlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - GoZay
|--------------------------------------------------------------------------
| 1. Halaman publik (landing & pencarian)
| 2. Autentikasi user + OTP
| 3. Area user (booking, pembayaran, e-ticket, profil)
| 4. Area admin (dashboard, CRUD, konfirmasi pembayaran)
*/

/* ========== Halaman Publik ========== */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi', [HomeController::class, 'destinations'])->name('destinations.index');
Route::get('/penerbangan', [SearchController::class, 'results'])->name('search.results');

/* Detail & pemilihan kursi (bisa diakses sebelum login; checkout butuh login) */
Route::get('/penerbangan/{flight}/kursi', [UserFlightController::class, 'seats'])->name('flights.seats');
Route::get('/penerbangan/{flight}/kursi/data', [UserFlightController::class, 'seatsAjax'])->name('flights.seats.ajax');

/* ========== Verifikasi OTP (guest) ========== */
Route::middleware('guest')->group(function () {
    Route::get('/verify-otp', [OtpVerificationController::class, 'show'])->name('otp.show');
    Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])
        ->middleware('throttle:otp')->name('otp.verify');
    Route::post('/resend-otp', [OtpVerificationController::class, 'resend'])
        ->middleware('throttle:otp')->name('otp.resend');
});

/* ========== Area User (butuh login) ========== */
Route::middleware('auth')->group(function () {
    // Riwayat pembelian
    Route::get('/riwayat', [BookingController::class, 'history'])->name('bookings.index');

    // Ringkasan pemesanan & simpan booking
    Route::get('/booking/{flight}/ringkasan', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking/{flight}', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/booking/{booking}/batal', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Pembayaran
    Route::get('/payment/{booking}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/{payment}/info', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{payment}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::get('/payment/{booking}/{payment}/status', [PaymentController::class, 'status'])->name('payment.status');

    // E-ticket & boarding pass
    Route::get('/eticket/{booking}', [TicketController::class, 'eticket'])->name('ticket.eticket');
    Route::get('/boarding/{booking}', [TicketController::class, 'boardingPass'])->name('ticket.boarding');
    Route::get('/ticket/{boardingPass}/pdf/{type}', [TicketController::class, 'downloadPdf'])->name('ticket.pdf');

    // Profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ========== Area Admin ========== */
Route::prefix('admin')->name('admin.')->group(function () {
    // Login admin (guard terpisah 'admin')
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Semua rute di bawah dilindungi AdminMiddleware
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Kelola konten website (landing page)
        Route::get('konten-website', [SettingController::class, 'index'])->name('settings.index');
        Route::post('konten-website', [SettingController::class, 'update'])->name('settings.update');

        // CRUD Bandara
        Route::resource('airports', AirportController::class);

        // CRUD Maskapai
        Route::resource('airlines', AirlineController::class);

        // CRUD Penerbangan
        Route::resource('flights', FlightController::class);

        // Kelola Kursi
        Route::get('flights/{flight}/seats', [SeatController::class, 'index'])->name('seats.index');
        Route::put('seats/{seat}', [SeatController::class, 'update'])->name('seats.update');
        Route::post('flights/{flight}/seats/generate', [SeatController::class, 'generate'])->name('seats.generate');

        // Kelola Pembayaran (setujui/tolak)
        Route::get('payments', [AdminPaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
        Route::post('payments/{payment}/approve', [AdminPaymentController::class, 'approve'])->name('payments.approve');
        Route::post('payments/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('payments.reject');
        Route::delete('payments/{payment}', [AdminPaymentController::class, 'destroy'])->name('payments.destroy');

        // Kelola Boarding Pass
        Route::get('boarding-passes', [BoardingPassController::class, 'index'])->name('boarding-passes.index');

        // Kelola User
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });
});

require __DIR__.'/auth.php';