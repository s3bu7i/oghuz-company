<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Translation extends Model
{
    protected $fillable = ['key', 'locale', 'value', 'group'];

    /**
     * Get a translation value by key and locale.
     */
    public static function get(string $key, string $locale, $default = null): ?string
    {
        return Cache::remember("trans_{$locale}_{$key}", 3600, function () use ($key, $locale, $default) {
            $record = static::where('key', $key)->where('locale', $locale)->first();
            return $record ? $record->value : $default;
        });
    }

    /**
     * Set (upsert) a translation value and clear its cache.
     */
    public static function set(string $key, string $locale, string $value, string $group = 'general'): self
    {
        Cache::forget("trans_{$locale}_{$key}");
        // Also clear the full locale cache
        Cache::forget("translations_all_{$locale}");

        return static::updateOrCreate(
            ['key' => $key, 'locale' => $locale],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Load all translations for a given locale as key=>value array (cached).
     */
    public static function allForLocale(string $locale): array
    {
        return Cache::remember("translations_all_{$locale}", 3600, function () use ($locale) {
            return static::where('locale', $locale)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Clear all translation cache for a locale.
     */
    public static function clearCache(string $locale): void
    {
        Cache::forget("translations_all_{$locale}");
    }

    public function scopeForLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }

    public function scopeForGroup($query, string $group)
    {
        return $query->where('group', $group);
    }
}
