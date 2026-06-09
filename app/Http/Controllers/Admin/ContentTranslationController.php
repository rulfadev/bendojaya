<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContentTranslation;
use App\Models\Faq;
use App\Models\FashionCollection;
use App\Models\Gallery;
use App\Models\HomepageSetting;
use App\Models\NavigationMenu;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentTranslationController extends Controller
{
    private array $resources = [
        'site-settings' => [
            'label' => 'Pengaturan Website',
            'model' => SiteSetting::class,
            'title_field' => 'site_name',
            'fields' => [
                'tagline' => 'Tagline',
                'short_description' => 'Deskripsi Singkat',
                'address' => 'Alamat',
                'business_hours' => 'Jam Operasional',
                'maintenance_title' => 'Judul Maintenance',
                'maintenance_description' => 'Deskripsi Maintenance',
            ],
        ],

        'homepage-settings' => [
            'label' => 'Homepage',
            'model' => HomepageSetting::class,
            'title_field' => 'hero_title',
            'fields' => [
                'hero_badge' => 'Hero Badge',
                'hero_title' => 'Hero Title',
                'hero_subtitle' => 'Hero Subtitle',
                'hero_primary_label' => 'Hero Primary Button',
                'hero_secondary_label' => 'Hero Secondary Button',

                'about_badge' => 'About Badge',
                'about_title' => 'About Title',
                'about_subtitle' => 'About Subtitle',
                'about_description' => 'About Description',
                'about_button_label' => 'About Button',

                'services_badge' => 'Services Badge',
                'services_title' => 'Services Title',
                'services_subtitle' => 'Services Subtitle',

                'collection_badge' => 'Collection Badge',
                'collection_title' => 'Collection Title',
                'collection_subtitle' => 'Collection Subtitle',

                'gallery_badge' => 'Gallery Badge',
                'gallery_title' => 'Gallery Title',
                'gallery_subtitle' => 'Gallery Subtitle',

                'partners_badge' => 'Partners Badge',
                'partners_title' => 'Partners Title',
                'partners_subtitle' => 'Partners Subtitle',

                'testimonials_badge' => 'Testimonials Badge',
                'testimonials_title' => 'Testimonials Title',
                'testimonials_subtitle' => 'Testimonials Subtitle',

                'articles_badge' => 'Articles Badge',
                'articles_title' => 'Articles Title',
                'articles_subtitle' => 'Articles Subtitle',

                'faq_badge' => 'FAQ Badge',
                'faq_title' => 'FAQ Title',
                'faq_subtitle' => 'FAQ Subtitle',

                'cta_badge' => 'CTA Badge',
                'cta_title' => 'CTA Title',
                'cta_subtitle' => 'CTA Subtitle',
                'cta_primary_label' => 'CTA Primary Button',
                'cta_secondary_label' => 'CTA Secondary Button',
            ],
        ],

        'navigation-menus' => [
            'label' => 'Menu Navigasi',
            'model' => NavigationMenu::class,
            'title_field' => 'label',
            'fields' => [
                'label' => 'Label Menu',
            ],
        ],

        'galleries' => [
            'label' => 'Gallery',
            'model' => Gallery::class,
            'title_field' => 'title',
            'fields' => [
                'title' => 'Judul',
                'short_description' => 'Deskripsi Singkat',
                'description' => 'Deskripsi',
                'alt_text' => 'Alt Text',
                'seo_title' => 'SEO Title',
                'seo_description' => 'SEO Description',
            ],
        ],

        'partners' => [
            'label' => 'Partner',
            'model' => Partner::class,
            'title_field' => 'name',
            'fields' => [
                'description' => 'Deskripsi',
            ],
        ],
        'services' => [
            'label' => 'Layanan',
            'model' => Service::class,
            'title_field' => 'title',
            'fields' => [
                'title' => 'Judul',
                'short_description' => 'Deskripsi Singkat',
                'description' => 'Deskripsi',
                'button_text' => 'Teks Tombol',
            ],
        ],
        'collections' => [
            'label' => 'Koleksi',
            'model' => FashionCollection::class,
            'title_field' => 'name',
            'fields' => [
                'name' => 'Nama Koleksi',
                'category' => 'Kategori',
                'short_description' => 'Deskripsi Singkat',
                'description' => 'Deskripsi',
                'seo_title' => 'SEO Title',
                'seo_description' => 'SEO Description',
            ],
        ],
        'articles' => [
            'label' => 'Artikel',
            'model' => Article::class,
            'title_field' => 'title',
            'fields' => [
                'title' => 'Judul',
                'excerpt' => 'Ringkasan',
                'content' => 'Konten',
                'seo_title' => 'SEO Title',
                'seo_description' => 'SEO Description',
            ],
        ],
        'pages' => [
            'label' => 'Custom Page',
            'model' => Page::class,
            'title_field' => 'title',
            'fields' => [
                'title' => 'Judul',
                'excerpt' => 'Ringkasan',
                'content' => 'Konten',
                'seo_title' => 'SEO Title',
                'seo_description' => 'SEO Description',
            ],
        ],
        'faqs' => [
            'label' => 'FAQ',
            'model' => Faq::class,
            'title_field' => 'question',
            'fields' => [
                'question' => 'Pertanyaan',
                'answer' => 'Jawaban',
            ],
        ],
        'testimonials' => [
            'label' => 'Testimoni',
            'model' => Testimonial::class,
            'title_field' => 'name',
            'fields' => [
                'name' => 'Nama',
                'position' => 'Posisi',
                'message' => 'Pesan',
            ],
        ],
    ];

    public function index(): View
    {
        return view('admin.translations.index', [
            'title' => 'Translate Content',
            'subtitle' => 'Kelola konten versi English untuk website internasional.',
            'resources' => $this->resources,
        ]);
    }

    public function list(string $resource): View
    {
        $config = $this->getResource($resource);
        $model = $config['model'];

        $items = $model::query()
            ->latest()
            ->paginate(15);

        return view('admin.translations.list', [
            'title' => 'Translate '.$config['label'],
            'subtitle' => 'Pilih data yang ingin diterjemahkan.',
            'resource' => $resource,
            'config' => $config,
            'items' => $items,
        ]);
    }

    public function edit(string $resource, int $id, string $locale = 'en'): View
    {
        $config = $this->getResource($resource);
        $model = $config['model'];
        $item = $model::query()->findOrFail($id);

        $translation = ContentTranslation::query()
            ->firstOrNew([
                'translatable_type' => $model,
                'translatable_id' => $item->id,
                'locale' => $locale,
            ]);

        return view('admin.translations.edit', [
            'title' => 'Edit Translate',
            'subtitle' => 'Isi konten versi English.',
            'resource' => $resource,
            'locale' => $locale,
            'config' => $config,
            'item' => $item,
            'translation' => $translation,
            'data' => $translation->data ?? [],
        ]);
    }

    public function update(Request $request, string $resource, int $id, string $locale = 'en'): RedirectResponse
    {
        $config = $this->getResource($resource);
        $model = $config['model'];
        $item = $model::query()->findOrFail($id);

        $data = [];

        foreach (array_keys($config['fields']) as $field) {
            $data[$field] = $request->input('data.'.$field);
        }

        ContentTranslation::query()->updateOrCreate(
            [
                'translatable_type' => $model,
                'translatable_id' => $item->id,
                'locale' => $locale,
            ],
            [
                'data' => $data,
            ]
        );

        return redirect()
            ->route('admin.translations.list', $resource)
            ->with('success', 'Translate berhasil disimpan.');
    }

    private function getResource(string $resource): array
    {
        abort_unless(isset($this->resources[$resource]), 404);

        $config = $this->resources[$resource];

        abort_unless(class_exists($config['model']), 404);

        return $config;
    }
}
