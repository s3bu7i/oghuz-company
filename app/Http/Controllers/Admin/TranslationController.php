<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $this->syncMissingLangKeys();

        $group  = $request->get('group', 'all');
        $search = $request->get('search', '');

        $query = Translation::where('locale', 'az');

        if ($group !== 'all') {
            $query->where('group', $group);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                  ->orWhere('value', 'like', "%{$search}%");
            });
        }

        $keys = $query->orderBy('group')->orderBy('key')->pluck('key');

        // Load all AZ and EN translations indexed by key
        $az = Translation::where('locale', 'az')
            ->when($group !== 'all', fn($q) => $q->where('group', $group))
            ->when($search, fn($q) => $q->where(function ($q2) use ($search) {
                $q2->where('key', 'like', "%{$search}%")
                   ->orWhere('value', 'like', "%{$search}%");
            }))
            ->get()
            ->keyBy('key');

        $en = Translation::where('locale', 'en')
            ->whereIn('key', $keys)
            ->get()
            ->keyBy('key');

        $groups = Translation::where('locale', 'az')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');

        return view('admin.translations.index', compact('az', 'en', 'groups', 'group', 'search'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // data format: translations[az][key] = value  or  translations[en][key] = value
        $translations = $request->input('translations', []);

        foreach ($translations as $locale => $items) {
            if (! in_array($locale, ['az', 'en'])) {
                continue;
            }
            foreach ($items as $key => $value) {
                // Find the group from existing record or default
                $existing = Translation::where('key', $key)->where('locale', $locale)->first();
                $group    = $existing ? $existing->group : 'general';

                Translation::set($key, $locale, $value ?? '', $group);
            }
        }

        // Clear full-locale caches
        Cache::forget('translations_all_az');
        Cache::forget('translations_all_en');

        return back()->with('success', 'Tərcümələr uğurla yeniləndi!');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'key'     => 'required|string|max:100|regex:/^[a-z0-9_]+$/',
            'group'   => 'required|string|max:50',
            'value_az'=> 'required|string',
            'value_en'=> 'required|string',
        ]);

        Translation::set($validated['key'], 'az', $validated['value_az'], $validated['group']);
        Translation::set($validated['key'], 'en', $validated['value_en'], $validated['group']);

        return back()->with('success', 'Yeni açar əlavə edildi!');
    }

    public function destroy(string $key)
    {
        Translation::where('key', $key)->delete();
        Cache::forget('translations_all_az');
        Cache::forget('translations_all_en');

        return back()->with('success', "'{$key}' açarı silindi.");
    }

    private function syncMissingLangKeys(): void
    {
        $az = $this->loadLangMessages('az');
        $en = $this->loadLangMessages('en');
        $created = false;

        foreach ($az as $key => $value) {
            $group = $this->inferGroup($key);

            $azRecord = Translation::firstOrCreate(
                ['key' => $key, 'locale' => 'az'],
                ['value' => (string) $value, 'group' => $group]
            );

            $enRecord = Translation::firstOrCreate(
                ['key' => $key, 'locale' => 'en'],
                ['value' => (string) ($en[$key] ?? $value), 'group' => $group]
            );

            $created = $created || $azRecord->wasRecentlyCreated || $enRecord->wasRecentlyCreated;
        }

        foreach ($en as $key => $value) {
            if (array_key_exists($key, $az)) {
                continue;
            }

            $group = $this->inferGroup($key);
            $enRecord = Translation::firstOrCreate(
                ['key' => $key, 'locale' => 'en'],
                ['value' => (string) $value, 'group' => $group]
            );
            $azRecord = Translation::firstOrCreate(
                ['key' => $key, 'locale' => 'az'],
                ['value' => (string) $value, 'group' => $group]
            );

            $created = $created || $azRecord->wasRecentlyCreated || $enRecord->wasRecentlyCreated;
        }

        if ($created) {
            Cache::forget('translations_all_az');
            Cache::forget('translations_all_en');
        }
    }

    private function loadLangMessages(string $locale): array
    {
        $path = lang_path("{$locale}/messages.php");

        if (! file_exists($path)) {
            return [];
        }

        $messages = require $path;

        return is_array($messages) ? $messages : [];
    }

    private function inferGroup(string $key): string
    {
        return match (true) {
            str_starts_with($key, 'meta_') => 'meta',
            str_starts_with($key, 'nav_'), in_array($key, ['start_project', 'language', 'menu', 'admin_panel'], true) => 'nav',
            str_starts_with($key, 'footer_'), str_starts_with($key, 'social_'), $key === 'scroll_top' => 'footer',
            str_starts_with($key, 'loader_'), $key === 'brand_name' => 'general',
            str_starts_with($key, 'home_'),
                str_starts_with($key, 'stats_'),
                str_starts_with($key, 'feature_'),
                in_array($key, [
                    'site_tagline', 'about_text', 'about_text_2', 'what_we_do',
                    'premium_services_title', 'premium_services_desc', 'all_services',
                    'about', 'why_title', 'our_work', 'latest_projects', 'all_projects',
                    'testimonials', 'testimonials_title', 'latest_articles', 'read_minutes',
                    'view_work',
                ], true) => 'home',
            str_starts_with($key, 'services_'), $key === 'contact_us' => 'services',
            str_starts_with($key, 'portfolio_'), in_array($key, ['all', 'view_project'], true) => 'portfolio',
            str_starts_with($key, 'blog_'), in_array($key, ['no_posts', 'views', 'back_to_blog', 'related_articles'], true) => 'blog',
            str_starts_with($key, 'contact_'),
                in_array($key, [
                    'phone', 'email', 'address', 'work_hours', 'work_hours_value',
                    'social_networks', 'write_us', 'full_name', 'full_name_placeholder',
                    'email_address', 'email_placeholder', 'phone_number', 'subject',
                    'subject_placeholder', 'interested_service', 'select_service',
                    'message', 'message_placeholder', 'send_message', 'privacy_note',
                    'sending', 'error',
                ], true) => 'contact',
            default => 'general',
        };
    }
}
