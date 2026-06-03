<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\SiteSetting;
use App\Models\Testimonial;
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
                'value' => Article::query()->count(),
                'description' => 'Konten edukasi batik dan fashion.',
            ],
            [
                'label' => 'Gallery',
                'value' => Gallery::query()->count(),
                'description' => 'Dokumentasi karya dan produksi.',
            ],
            [
                'label' => 'Partner',
                'value' => Partner::query()->count(),
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
            [
                'label' => 'Koleksi',
                'value' => FashionCollection::query()->count(),
                'description' => 'Katalog pakaian dan motif batik.',
            ],
            [
                'label' => 'Pesan Baru',
                'value' => ContactMessage::query()->where('status', 'new')->count(),
                'description' => 'Pesan kontak belum ditindaklanjuti.',
            ],
            [
                'label' => 'Perlu Follow Up',
                'value' => ContactMessage::query()->whereIn('status', ['new', 'read', 'contacted'])->count(),
                'description' => 'Pesan yang masih perlu diproses.',
            ],
            [
                'label' => 'Testimoni Pending',
                'value' => Testimonial::query()->where('status', 'pending')->count(),
                'description' => 'Menunggu review admin.',
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
