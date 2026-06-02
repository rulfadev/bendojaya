<?php

namespace App\Http\Controllers;

use App\Models\FashionCollection;
use App\Models\SiteSetting;
use Illuminate\View\View;

class FashionCollectionController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::query()->first();

        $collections = FashionCollection::query()
            ->active()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(9);

        return view('collections.index', [
            'setting' => $setting,
            'collections' => $collections,
            'title' => 'Koleksi Batik - Bendo Jaya Batik Fashion',
            'metaDescription' => 'Daftar koleksi batik Bendo Jaya Batik Fashion untuk kebutuhan harian, custom, dan kerja sama brand.',
        ]);
    }

    public function show(FashionCollection $collection): View
    {
        abort_unless($collection->is_active, 404);

        $setting = SiteSetting::query()->first();

        $relatedCollections = FashionCollection::query()
            ->active()
            ->whereKeyNot($collection->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('collections.show', [
            'setting' => $setting,
            'collection' => $collection,
            'relatedCollections' => $relatedCollections,
            'title' => $collection->name.' - Bendo Jaya Batik Fashion',
            'metaDescription' => $collection->short_description,
        ]);
    }
}
