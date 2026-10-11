<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Admin - kelola konten website (hero, destinasi, janji, promo, kontak).
 */
class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::allSettings();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $inputs = $request->input('settings', []);
        if (!is_array($inputs)) {
            $inputs = [];
        }

        $flat = [];
        $this->flatten($inputs, '', $flat);

        foreach ($flat as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->update(['value' => $value]);
            } else {
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                    'group' => 'custom',
                    'label' => $key,
                ]);
            }
        }

        return back()->with('success', 'Konten website berhasil diperbarui.');
    }

    /**
     * Ubah array bersarang (settings[promos][item1][title]) menjadi
     * daftar flat key bertitik (promos.item1.title => value).
     */
    private function flatten(array $array, string $prefix, array &$out): void
    {
        foreach ($array as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : (string) $key;
            if (is_array($value)) {
                $this->flatten($value, $fullKey, $out);
            } else {
                $out[$fullKey] = (string) ($value ?? '');
            }
        }
    }
}