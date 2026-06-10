<?php

use App\Models\Translation;

if (! function_exists('__t')) {
    /**
     * Get a translated string from the database for the current locale.
     * Falls back to lang/messages.php if not found in DB.
     *
     * @param  string  $key      Translation key (e.g. 'nav_home')
     * @param  string  $default  Fallback value if not found anywhere
     * @return string
     */
    function __t(string $key, string $default = ''): string
    {
        $locale = app()->getLocale();

        $value = Translation::get($key, $locale);

        if ($value !== null) {
            return $value;
        }

        // Fallback to lang files
        $fallback = __('messages.' . $key);
        if ($fallback !== 'messages.' . $key) {
            return $fallback;
        }

        return $default ?: $key;
    }
}
