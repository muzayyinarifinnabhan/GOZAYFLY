<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirportRequest;
use App\Models\Airport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Admin - Kelola Bandara (CRUD).
 */
class AirportController extends Controller
{
    public function index(): View
    {
        $airports = Airport::orderBy('code')->paginate(10);

        return view('admin.airports.index', compact('airports'));
    }

    public function create(): View
    {
        return view('admin.airports.create');
    }

    public function store(AirportRequest $request): RedirectResponse
    {
        Airport::create($request->validated());

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil ditambahkan.');
    }

    public function edit(Airport $airport): View
    {
        return view('admin.airports.edit', compact('airport'));
    }

    public function update(AirportRequest $request, Airport $airport): RedirectResponse
    {
        $airport->update($request->validated());

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil diperbarui.');
    }

    public function destroy(Airport $airport): RedirectResponse
    {
        $airport->delete();

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil dihapus.');
    }
}