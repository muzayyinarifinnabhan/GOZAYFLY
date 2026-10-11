<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\BoardingPass;
use App\Models\Payment;
use App\Policies\BoardingPassPolicy;
use App\Policies\BookingPolicy;
use App\Policies\PaymentPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tanggal dalam bahasa Indonesia (Carbon)
        \Carbon\Carbon::setLocale('id');

        $this->registerPolicies();
        $this->registerOtpRateLimiter();
    }

    /**
     * Daftarkan policy ke Gate (peringatan:- kemampuan melihat booking/payment/boardingpass,
     * hanya untuk pemilik atau admin).
     */
    private function registerPolicies(): void
    {
        Gate::policy(Booking::class, BookingPolicy::class);
        Gate::policy(Payment::class, PaymentPolicy::class);
        Gate::policy(BoardingPass::class, BoardingPassPolicy::class);
    }

    /**
     * Rate limiter kustom untuk OTP: maksimum 3 permintaan per menit per email.
     * Dipakai middleware 'throttle:otp'.
     */
    private function registerOtpRateLimiter(): void
    {
        RateLimiter::for('otp', function ($request) {
            $key = strtolower($request->input('email') ?: $request->query('email') ?: 'guest');

            return [
                Limit::perMinute(3)->by('otp:' . $key),
                Limit::perMinute(10)->by('otp-ip:' . $request->ip()),
            ];
        });
    }
}