<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Setting - penyimpanan konten website (key-value) yang dapat
 * diedit admin melalui dashboard.
 */
class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'label',
    ];

    /**
     * Ambil satu setting dengan default.
     */
    public static function getValue(string $key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    /**
     * Seluruh setting dalam bentuk Collection key => value.
     */
    public static function allSettings(): Collection
    {
        return static::pluck('value', 'key');
    }
}