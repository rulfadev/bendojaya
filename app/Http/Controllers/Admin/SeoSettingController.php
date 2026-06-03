<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SeoSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.seo-settings.edit', [
            'title' => 'SEO Settings',
            'subtitle' => 'Kelola meta tag, indexing, sitemap, robots.txt, dan JSON-LD.',
            'seo' => SeoSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $seo = SeoSetting::current();

        $validated = $request->validate([
            'default_meta_title' => ['nullable', 'string', 'max:255'],
            'default_meta_description' => ['nullable', 'string'],
            'default_meta_keywords' => ['nullable', 'string'],
            'default_og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'canonical_base_url' => ['nullable', 'url', 'max:255'],
            'google_site_verification' => ['nullable', 'string', 'max:255'],
            'bing_site_verification' => ['nullable', 'string', 'max:255'],

            'organization_name' => ['nullable', 'string', 'max:255'],
            'organization_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'organization_type' => ['nullable', 'string', 'max:120'],
            'same_as_instagram' => ['nullable', 'url', 'max:255'],
            'same_as_tiktok' => ['nullable', 'url', 'max:255'],

            'robots_extra_rules' => ['nullable', 'string'],
            'llms_txt_content' => ['nullable', 'string'],
        ]);

        foreach ([
            'allow_indexing',
            'enable_sitemap',
            'enable_json_ld',
            'enable_llms_txt',
        ] as $field) {
            $validated[$field] = $request->boolean($field);
        }

        foreach (['default_og_image', 'organization_logo'] as $field) {
            if ($request->hasFile($field)) {
                if ($seo->{$field}) {
                    Storage::disk('public')->delete($seo->{$field});
                }

                $validated[$field] = $request->file($field)->store('seo', 'public');
            }
        }

        $seo->update($validated);

        return back()->with('success', 'SEO settings berhasil diperbarui.');
    }
}
