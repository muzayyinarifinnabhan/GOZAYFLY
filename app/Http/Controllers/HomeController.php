<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Setting;
use Illuminate\View\View;

/**
 * HomeController - landing page publik GoZay.
 */
class HomeController extends Controller
{
    /**
     * Tampilkan landing page lengkap: hero + form cari + keunggulan + destinasi + promo + maskapai.
     */
    public function index(): View
    {
        $airports = Airport::where('is_active', true)->orderBy('city')->get();
        $airlines = Airline::where('is_active', true)->get();
        $destinations = Airport::whereNotNull('image')->where('is_active', true)
            ->get()
            ->unique('city')
            ->take(8);
        $promoFlights = Flight::with(['airline', 'origin', 'destination'])
            ->where('is_active', true)
            ->where('departure_date', '>=', now()->today())
            ->inRandomOrder()
            ->take(4)
            ->get();

        $settings = Setting::allSettings();

        return view('landing.index', compact('airports', 'airlines', 'destinations', 'promoFlights', 'settings'));
    }

    /**
     * Tampilkan halaman katalog semua destinasi (dari menu "Lihat semua destinasi").
     */
    public function destinations(): View
    {
        $airports = Airport::where('is_active', true)->orderBy('city')->get();
        $destinations = Airport::whereNotNull('image')->where('is_active', true)
            ->get()
            ->unique('city')
            ->values();
        $airlines = Airline::where('is_active', true)->get();
        $settings = Setting::allSettings();

        return view('destinations.index', compact('airports', 'destinations', 'airlines', 'settings'));
    }
}