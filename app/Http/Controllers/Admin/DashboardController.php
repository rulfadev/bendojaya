<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
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

        $stats = [
            [
                'label' => 'Artikel',
                'value' => 0,
                'description' => 'Konten edukasi batik dan fashion.',
            ],
            [
                'label' => 'Gallery',
                'value' => 0,
                'description' => 'Dokumentasi karya dan produksi.',
            ],
            [
                'label' => 'Koleksi',
                'value' => 0,
                'description' => 'Katalog pakaian dan motif batik.',
            ],
            [
                'label' => 'Partner',
                'value' => 0,
                'description' => 'Brand dan kerja sama bisnis.',
            ],
            [
                'label' => 'Admin Aktif',
                'value' => User::query()
                    ->whereIn('role', ['admin', 'editor'])
                    ->where('is_active', true)
                    ->count(),
                'description' => 'Pengelola website aktif.',
            ],
        ];

        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'subtitle' => 'Ringkasan awal CMS Bendo Jaya.',
            'setting' => $setting,
            'stats' => $stats,
        ]);
    }
}
