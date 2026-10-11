<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirlineRequest;
use App\Models\Airline;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Admin - Kelola Maskapai (CRUD) + upload logo ke Laravel Storage.
 */
class AirlineController extends Controller
{
    public function index(): View
    {
        $airlines = Airline::orderBy('name')->paginate(10);

        return view('admin.airlines.index', compact('airlines'));
    }

    public function create(): View
    {
        return view('admin.airlines.create');
    }

    public function store(AirlineRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Upload logo ke storage public disk
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('airlines', 'public');
        }

        Airline::create($data);

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil ditambahkan.');
    }

    public function edit(Airline $airline): View
    {
        return view('admin.airlines.edit', compact('airline'));
    }

    public function update(AirlineRequest $request, Airline $airline): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Hapus logo lama bila ada
            if ($airline->logo) {
                Storage::disk('public')->delete($airline->logo);
            }
            $data['logo'] = $request->file('logo')->store('airlines', 'public');
        }

        $airline->update($data);

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil diperbarui.');
    }

    public function destroy(Airline $airline): RedirectResponse
    {
        // Hapus file logo bila dipakai
        if ($airline->logo) {
            Storage::disk('public')->delete($airline->logo);
        }

        $airline->delete();

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil dihapus.');
    }
}