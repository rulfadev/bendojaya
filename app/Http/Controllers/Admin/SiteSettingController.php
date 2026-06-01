<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Bendo Jaya',
                'tagline' => 'Batik Tradisional, Sentuhan Modern',
            ]
        );

        return view('admin.site-settings.index', [
            'title' => 'Pengaturan Website',
            'subtitle' => 'Kelola identitas, kontak, sosial media, dan SEO dasar.',
            'setting' => $setting,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $setting = SiteSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Bendo Jaya',
                'tagline' => 'Batik Tradisional, Sentuhan Modern',
            ]
        );

        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:200'],
            'short_description' => ['nullable', 'string'],

            'logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,ico,svg', 'max:1024'],

            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp_number' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],

            'instagram_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],

            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],

            'consultation_label' => ['nullable', 'string', 'max:100'],
            'consultation_url' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $validated['logo'] = $request->file('logo')->store('site', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $validated['favicon'] = $request->file('favicon')->store('site', 'public');
        }

        $setting->update($validated);

        return back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
