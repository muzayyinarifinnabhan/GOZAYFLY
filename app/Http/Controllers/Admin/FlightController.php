<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlightRequest;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Admin - Kelola Penerbangan (jadwal) CRUD.
 */
class FlightController extends Controller
{
    public function index(): View
    {
        $flights = Flight::with(['airline', 'origin', 'destination'])
            ->orderByDesc('departure_date')
            ->paginate(10);

        return view('admin.flights.index', compact('flights'));
    }

    public function create(): View
    {
        $airlines = Airline::orderBy('name')->get();
        $airports = Airport::orderBy('code')->get();

        return view('admin.flights.create', compact('airlines', 'airports'));
    }

    public function store(FlightRequest $request): RedirectResponse
    {
        Flight::create($request->validated());

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil ditambahkan. Tambahkan kursi via tombol Generate Kursi.');
    }

    public function edit(Flight $flight): View
    {
        $airlines = Airline::orderBy('name')->get();
        $airports = Airport::orderBy('code')->get();

        return view('admin.flights.edit', compact('flight', 'airlines', 'airports'));
    }

    public function update(FlightRequest $request, Flight $flight): RedirectResponse
    {
        $flight->update($request->validated());

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil diperbarui.');
    }

    public function destroy(Flight $flight): RedirectResponse
    {
        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil dihapus.');
    }
}