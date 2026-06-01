<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(Page $page): View
    {
        abort_unless($page->is_active, 404);

        $setting = SiteSetting::query()->first();

        return view('pages.show', [
            'setting' => $setting,
            'page' => $page,
            'title' => $page->meta_title ?: $page->title,
            'metaDescription' => $page->meta_description ?: $page->excerpt,
        ]);
    }
}
