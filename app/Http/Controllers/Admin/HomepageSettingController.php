<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomepageSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.homepage-settings.edit', [
            'title' => 'Homepage Settings',
            'subtitle' => 'Kelola teks, gambar, dan section landing page.',
            'homepage' => HomepageSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $homepage = HomepageSetting::current();

        $validated = $request->validate([
            'hero_eyebrow' => ['nullable', 'string', 'max:180'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'hero_primary_label' => ['nullable', 'string', 'max:120'],
            'hero_primary_url' => ['nullable', 'string', 'max:255'],
            'hero_secondary_label' => ['nullable', 'string', 'max:120'],
            'hero_secondary_url' => ['nullable', 'string', 'max:255'],

            'value_items_text' => ['nullable', 'string'],

            'about_eyebrow' => ['nullable', 'string', 'max:180'],
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_description' => ['nullable', 'string'],
            'about_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'about_button_label' => ['nullable', 'string', 'max:120'],
            'about_button_url' => ['nullable', 'string', 'max:255'],

            'services_eyebrow' => ['nullable', 'string', 'max:180'],
            'services_title' => ['nullable', 'string', 'max:255'],
            'services_description' => ['nullable', 'string'],

            'collections_eyebrow' => ['nullable', 'string', 'max:180'],
            'collections_title' => ['nullable', 'string', 'max:255'],
            'collections_description' => ['nullable', 'string'],

            'gallery_eyebrow' => ['nullable', 'string', 'max:180'],
            'gallery_title' => ['nullable', 'string', 'max:255'],
            'gallery_description' => ['nullable', 'string'],

            'partners_eyebrow' => ['nullable', 'string', 'max:180'],
            'partners_title' => ['nullable', 'string', 'max:255'],
            'partners_description' => ['nullable', 'string'],
            'partners_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'testimonials_eyebrow' => ['nullable', 'string', 'max:180'],
            'testimonials_title' => ['nullable', 'string', 'max:255'],
            'testimonials_description' => ['nullable', 'string'],

            'articles_eyebrow' => ['nullable', 'string', 'max:180'],
            'articles_title' => ['nullable', 'string', 'max:255'],
            'articles_description' => ['nullable', 'string'],

            'cta_eyebrow' => ['nullable', 'string', 'max:180'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_description' => ['nullable', 'string'],
            'cta_button_label' => ['nullable', 'string', 'max:120'],
            'cta_button_url' => ['nullable', 'string', 'max:255'],
            'cta_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ([
            'show_hero',
            'show_value_strip',
            'show_about',
            'show_about_button',
            'show_services',
            'show_collections',
            'show_gallery',
            'show_partners',
            'show_testimonials',
            'show_articles',
            'show_cta',
        ] as $field) {
            $validated[$field] = $request->boolean($field);
        }

        $validated['value_items'] = $this->parseValueItems($request->input('value_items_text'));

        foreach (['hero_image', 'about_image', 'partners_image', 'cta_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($homepage->{$field}) {
                    Storage::disk('public')->delete($homepage->{$field});
                }

                $validated[$field] = $request->file($field)->store('homepage', 'public');
            }
        }

        unset($validated['value_items_text']);

        $homepage->update($validated);

        return back()->with('success', 'Homepage settings berhasil diperbarui.');
    }

    private function parseValueItems(?string $value): ?array
    {
        if (! $value) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }
}
