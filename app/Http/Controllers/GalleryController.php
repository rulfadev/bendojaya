<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\SiteSetting;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::query()->first();

        $galleries = Gallery::query()
            ->active()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view('galleries.index', [
            'setting' => $setting,
            'galleries' => $galleries,
            'title' => 'Gallery - Bendo Jaya Batik Fashion',
            'metaDescription' => 'Gallery produk, motif, dokumentasi, dan karya visual Bendo Jaya Batik Fashion.',
        ]);
    }

    public function show(Gallery $gallery): View
    {
        abort_unless($gallery->is_active, 404);

        $setting = SiteSetting::query()->first();

        $relatedGalleries = Gallery::query()
            ->active()
            ->whereKeyNot($gallery->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('galleries.show', [
            'setting' => $setting,
            'gallery' => $gallery,
            'relatedGalleries' => $relatedGalleries,
            'title' => $gallery->title.' - Bendo Jaya Batik Fashion',
            'metaDescription' => $gallery->caption ?: $gallery->description,
        ]);
    }
}
