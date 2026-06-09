<?php

namespace Database\Seeders;

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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DefaultEnglishTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSetting();
        $this->seedHomepageSetting();
        $this->seedNavigationMenus();
        $this->seedPages();
        $this->seedServices();
        $this->seedCollections();
        $this->seedFaqs();
        $this->seedTestimonials();
        $this->seedPartners();
        $this->seedGalleries();
        $this->seedArticles();
    }

    private function translate(Model $model, array $data, string $locale = 'en'): void
    {
        $data = collect($data)
            ->filter(fn ($value) => $value !== null && $value !== '')
            ->all();

        if ($data === []) {
            return;
        }

        ContentTranslation::query()->updateOrCreate(
            [
                'translatable_type' => $model::class,
                'translatable_id' => $model->getKey(),
                'locale' => $locale,
            ],
            [
                'data' => $data,
            ]
        );
    }

    private function seedSiteSetting(): void
    {
        $setting = SiteSetting::query()->first();

        if (! $setting) {
            return;
        }

        $this->translate($setting, [
            'tagline' => 'Batik Cap Manufacturer Indonesia from Kota Pekalongan',
            'short_description' => 'Bendo Jaya is a batik cap manufacturer based in Kota Pekalongan, Central Java, Indonesia. We serve batik cap production, custom batik motifs, batik uniforms, fashion batik collections, and production partnerships for brands, communities, institutions, companies, and international markets.',
            'address' => 'Kradenan, Gg. 4, RT.02/RW.08, Buaran, South Pekalongan District, Kota Pekalongan, Central Java 51132, Indonesia',
            'business_hours' => 'Monday - Saturday, 08:00 - 17:00 WIB',
            'maintenance_title' => 'Bendo Jaya Batik Fashion Is Being Updated',
            'maintenance_description' => 'The Bendo Jaya Batik Fashion website is being prepared with a refreshed design and improved system.',
        ]);
    }

    private function seedHomepageSetting(): void
    {
        $homepage = HomepageSetting::query()->first();

        if (! $homepage) {
            return;
        }

        $this->translate($homepage, [
            'hero_badge' => 'Batik Cap Manufacturer Indonesia',
            'hero_eyebrow' => 'Bendo Jaya Batik Fashion',
            'hero_title' => 'Batik Cap Manufacturer from Kota Pekalongan, Indonesia',
            'hero_subtitle' => 'Bendo Jaya provides batik cap production, custom batik motifs, batik uniforms, fashion batik collections, and production partnerships for brands, communities, institutions, companies, and international markets.',
            'hero_primary_label' => 'Consult Now',
            'hero_secondary_label' => 'View Collections',

            'about_badge' => 'About Bendo Jaya',
            'about_title' => 'Batik Cap Production with Pekalongan Craftsmanship',
            'about_subtitle' => 'Traditional batik craftsmanship with modern production needs.',
            'about_description' => 'Bendo Jaya is based in Kota Pekalongan, Central Java, Indonesia. We combine traditional batik cap craftsmanship with practical production services for fashion, uniforms, custom motifs, and brand partnerships.',
            'about_button_label' => 'Learn More',

            'services_badge' => 'Services',
            'services_title' => 'Batik Production Services',
            'services_subtitle' => 'From batik cap manufacturing to custom production and partnership programs.',

            'collection_badge' => 'Featured Collections',
            'collection_title' => 'Selected Batik Fashion Collections',
            'collection_subtitle' => 'Explore our batik fashion collections for daily wear, uniforms, events, and custom needs.',

            'gallery_badge' => 'Gallery',
            'gallery_title' => 'Batik Production and Fashion Gallery',
            'gallery_subtitle' => 'A visual look at our batik products, production details, and fashion collections.',

            'partners_badge' => 'Partners',
            'partners_title' => 'Business and Brand Partnerships',
            'partners_subtitle' => 'Open for production partnerships with brands, communities, institutions, and companies.',

            'testimonials_badge' => 'Testimonials',
            'testimonials_title' => 'Client Stories',
            'testimonials_subtitle' => 'Trusted by clients for batik fashion, uniforms, custom production, and business partnerships.',

            'articles_badge' => 'Articles',
            'articles_title' => 'Batik Insights and Stories',
            'articles_subtitle' => 'Read articles about batik cap, Pekalongan batik, fashion batik, and production ideas.',

            'faq_badge' => 'FAQ',
            'faq_title' => 'Frequently Asked Questions',
            'faq_subtitle' => 'Find answers about ordering, custom production, partnerships, and quotation process.',

            'cta_badge' => 'Start Consultation',
            'cta_title' => 'Looking for Batik Cap Production or Custom Batik?',
            'cta_subtitle' => 'Discuss your batik production needs with Bendo Jaya and get a suitable recommendation.',
            'cta_primary_label' => 'Consult via WhatsApp',
            'cta_secondary_label' => 'View Collections',
        ]);
    }

    private function seedNavigationMenus(): void
    {
        $map = [
            'Beranda' => 'Home',
            'Tentang' => 'About',
            'Layanan' => 'Services',
            'Koleksi' => 'Collections',
            'Galeri' => 'Gallery',
            'Gallery' => 'Gallery',
            'Artikel' => 'Articles',
            'Kontak' => 'Contact',
            'Kerja Sama' => 'Partnership',
            'Custom Produksi' => 'Custom Production',
            'Panduan Pemesanan' => 'Ordering Guide',
            'Kebijakan & Ketentuan' => 'Terms and Conditions',
        ];

        NavigationMenu::query()->get()->each(function (NavigationMenu $menu) use ($map) {
            $label = $map[$menu->label] ?? null;

            if (! $label) {
                return;
            }

            $this->translate($menu, [
                'label' => $label,
            ]);
        });
    }

    private function seedPages(): void
    {
        $pages = [
            'tentang-kami' => [
                'title' => 'About Us',
                'excerpt' => 'Bendo Jaya is a batik cap manufacturer from Kota Pekalongan, Central Java, Indonesia.',
                'content' => '<p>Bendo Jaya is a batik cap manufacturer based in Kota Pekalongan, Central Java, Indonesia. We serve batik cap production, custom batik motifs, batik uniforms, fashion batik collections, and production partnerships for brands, communities, institutions, companies, and international markets.</p>',
                'seo_title' => 'About Bendo Jaya – Batik Cap Manufacturer Indonesia',
                'seo_description' => 'Learn about Bendo Jaya, a batik cap manufacturer based in Kota Pekalongan, Central Java, Indonesia.',
            ],
            'kerja-sama' => [
                'title' => 'Partnership',
                'excerpt' => 'Production partnerships for brands, communities, institutions, and companies.',
                'content' => '<p>Bendo Jaya opens partnership opportunities for batik cap production, custom batik motifs, uniforms, and fashion collections for brands, communities, institutions, and companies.</p>',
                'seo_title' => 'Batik Production Partnership Indonesia | Bendo Jaya',
                'seo_description' => 'Partner with Bendo Jaya for batik cap production, custom batik motifs, uniforms, and fashion collections.',
            ],
            'custom-produksi' => [
                'title' => 'Custom Production',
                'excerpt' => 'Custom batik production for motifs, colors, fabrics, uniforms, and fashion collections.',
                'content' => '<p>Bendo Jaya provides custom batik production services, including motif, color, fabric, fashion model, uniform, and collection needs.</p>',
                'seo_title' => 'Custom Batik Production Indonesia | Bendo Jaya',
                'seo_description' => 'Custom batik production service for brands, communities, institutions, and companies.',
            ],
            'panduan-pemesanan' => [
                'title' => 'Ordering Guide',
                'excerpt' => 'Simple steps to order or request custom batik production from Bendo Jaya.',
                'content' => '<p>Choose a collection or submit a custom request, consult through WhatsApp, confirm your details, receive an official quotation, approve the quotation, and continue to production or delivery.</p>',
                'seo_title' => 'Ordering Guide | Bendo Jaya Batik',
                'seo_description' => 'Learn how to order collections or request custom batik production from Bendo Jaya.',
            ],
            'kebijakan-ketentuan' => [
                'title' => 'Terms and Conditions',
                'excerpt' => 'Ordering, custom production, quotation, payment, revision, and delivery terms.',
                'content' => '<p>This page explains the general terms for ordering, custom production, quotations, payment, revision, cancellation, production estimate, and delivery.</p>',
                'seo_title' => 'Terms and Conditions | Bendo Jaya',
                'seo_description' => 'Read the terms and conditions for ordering and custom batik production at Bendo Jaya.',
            ],
        ];

        foreach ($pages as $slug => $data) {
            $page = Page::query()->where('slug', $slug)->first();

            if ($page) {
                $this->translate($page, $data);
            }
        }
    }

    private function seedServices(): void
    {
        Service::query()->get()->each(function (Service $service) {
            $title = Str::lower($service->title ?? '');

            $data = match (true) {
                Str::contains($title, ['custom', 'produksi']) => [
                    'title' => 'Custom Batik Production',
                    'short_description' => 'Custom batik production for motifs, fabrics, colors, uniforms, and fashion collections.',
                    'description' => 'Bendo Jaya provides custom batik production services for brands, communities, institutions, and companies.',
                    'button_text' => 'Consult Now',
                ],
                Str::contains($title, ['seragam', 'uniform']) => [
                    'title' => 'Batik Uniform Production',
                    'short_description' => 'Batik uniform production for companies, communities, institutions, organizations, and events.',
                    'description' => 'We serve batik uniform production with consultation for motif, fabric, color, model, and quantity.',
                    'button_text' => 'Consult Now',
                ],
                Str::contains($title, ['kerja sama', 'partner', 'brand']) => [
                    'title' => 'Brand and Business Partnership',
                    'short_description' => 'Production partnership for brands, communities, institutions, and companies.',
                    'description' => 'Bendo Jaya is open for production partnerships for batik fashion, custom motifs, uniforms, and collections.',
                    'button_text' => 'Start Partnership',
                ],
                default => [
                    'title' => 'Batik Cap Manufacturing',
                    'short_description' => 'Batik cap production from Kota Pekalongan for fashion, uniforms, custom needs, and brands.',
                    'description' => 'Bendo Jaya provides batik cap manufacturing services with traditional Pekalongan craftsmanship and modern production needs.',
                    'button_text' => 'Consult Now',
                ],
            };

            $this->translate($service, $data);
        });
    }

    private function seedCollections(): void
    {
        FashionCollection::query()->get()->each(function (FashionCollection $collection) {
            $this->translate($collection, [
                'category' => $collection->category ? $this->translateShortLabel($collection->category) : null,
                'seo_title' => ($collection->name ? $collection->name.' | ' : '').'Bendo Jaya Batik Collection',
                'seo_description' => 'Explore batik fashion collection from Bendo Jaya, a batik cap manufacturer based in Kota Pekalongan, Indonesia.',
            ]);
        });
    }

    private function seedGalleries(): void
    {
        Gallery::query()->get()->each(function (Gallery $gallery) {
            $this->translate($gallery, [
                'seo_title' => ($gallery->title ? $gallery->title.' | ' : '').'Bendo Jaya Gallery',
                'seo_description' => 'View Bendo Jaya batik product and production gallery from Kota Pekalongan, Indonesia.',
            ]);
        });
    }

    private function seedArticles(): void
    {
        Article::query()->get()->each(function (Article $article) {
            $this->translate($article, [
                'seo_title' => ($article->title ? $article->title.' | ' : '').'Bendo Jaya Articles',
                'seo_description' => 'Read articles about batik cap, Pekalongan batik, fashion batik, and custom batik production by Bendo Jaya.',
            ]);
        });
    }

    private function seedFaqs(): void
    {
        Faq::query()->get()->each(function (Faq $faq) {
            $question = Str::lower($faq->question ?? '');

            $data = match (true) {
                Str::contains($question, ['custom']) => [
                    'question' => 'Can I request custom batik production?',
                    'answer' => 'Yes. Bendo Jaya serves custom batik production for motifs, colors, fabrics, uniforms, and fashion collection needs.',
                ],
                Str::contains($question, ['minimal', 'minimum', 'jumlah']) => [
                    'question' => 'Is there a minimum order quantity?',
                    'answer' => 'Minimum order quantity depends on the production type, motif, material, and model. Please contact us through WhatsApp for consultation.',
                ],
                Str::contains($question, ['kerja sama', 'reseller', 'partner']) => [
                    'question' => 'Does Bendo Jaya accept partnerships?',
                    'answer' => 'Yes. Bendo Jaya is open for partnerships with brands, communities, institutions, companies, and resellers.',
                ],
                Str::contains($question, ['waktu', 'produksi', 'deadline']) => [
                    'question' => 'How long does the production process take?',
                    'answer' => 'Production time depends on quantity, motif complexity, material availability, and product model.',
                ],
                default => [
                    'question' => 'How can I consult with Bendo Jaya?',
                    'answer' => 'You can contact Bendo Jaya through the WhatsApp button or submit an inquiry form on the website.',
                ],
            };

            $this->translate($faq, $data);
        });
    }

    private function seedTestimonials(): void
    {
        Testimonial::query()->get()->each(function (Testimonial $testimonial) {
            $this->translate($testimonial, [
                'position' => $testimonial->position ? $this->translateShortLabel($testimonial->position) : null,
            ]);
        });
    }

    private function seedPartners(): void
    {
        Partner::query()->get()->each(function (Partner $partner) {
            $this->translate($partner, [
                'description' => $partner->description ? $this->translateShortLabel($partner->description) : null,
            ]);
        });
    }

    private function translateShortLabel(string $value): string
    {
        $lower = Str::lower($value);

        return match (true) {
            Str::contains($lower, ['wanita']) => 'Women',
            Str::contains($lower, ['pria']) => 'Men',
            Str::contains($lower, ['anak']) => 'Kids',
            Str::contains($lower, ['seragam']) => 'Uniform',
            Str::contains($lower, ['custom']) => 'Custom',
            Str::contains($lower, ['komunitas']) => 'Community',
            Str::contains($lower, ['brand']) => 'Brand',
            Str::contains($lower, ['partner']) => 'Partner',
            default => $value,
        };
    }
}
