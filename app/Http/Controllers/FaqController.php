<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\SiteSetting;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::query()->first();

        $faqs = Faq::query()
            ->active()
            ->orderBy('sort_order')
            ->latest()
            ->get()
            ->groupBy(fn ($faq) => $faq->category ?: 'Umum');

        return view('faqs.index', [
            'setting' => $setting,
            'faqs' => $faqs,
            'title' => 'FAQ - Bendo Jaya Batik Fashion',
            'metaDescription' => 'Pertanyaan yang sering diajukan seputar Bendo Jaya, custom batik, kerja sama, dan pemesanan.',
        ]);
    }
}
