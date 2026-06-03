<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'show_hero',
    'hero_eyebrow',
    'hero_title',
    'hero_subtitle',
    'hero_image',
    'hero_primary_label',
    'hero_primary_url',
    'hero_secondary_label',
    'hero_secondary_url',

    'show_value_strip',
    'value_items',

    'show_about',
    'about_eyebrow',
    'about_title',
    'about_description',
    'about_image',
    'show_about_button',
    'about_button_label',
    'about_button_url',

    'show_services',
    'services_eyebrow',
    'services_title',
    'services_description',

    'show_collections',
    'collections_eyebrow',
    'collections_title',
    'collections_description',

    'show_gallery',
    'gallery_eyebrow',
    'gallery_title',
    'gallery_description',

    'show_partners',
    'partners_eyebrow',
    'partners_title',
    'partners_description',
    'partners_image',

    'show_testimonials',
    'testimonials_eyebrow',
    'testimonials_title',
    'testimonials_description',

    'show_articles',
    'articles_eyebrow',
    'articles_title',
    'articles_description',

    'show_cta',
    'cta_eyebrow',
    'cta_title',
    'cta_description',
    'cta_button_label',
    'cta_button_url',
    'cta_image',
])]
class HomepageSetting extends Model
{
    protected function casts(): array
    {
        return [
            'show_hero' => 'boolean',
            'show_value_strip' => 'boolean',
            'show_about' => 'boolean',
            'show_about_button' => 'boolean',
            'show_services' => 'boolean',
            'show_collections' => 'boolean',
            'show_gallery' => 'boolean',
            'show_partners' => 'boolean',
            'show_testimonials' => 'boolean',
            'show_articles' => 'boolean',
            'show_cta' => 'boolean',
            'value_items' => 'array',
        ];
    }

    public static function current(): self
    {
        return static::query()->first() ?? static::query()->create(static::defaults());
    }

    public static function defaults(): array
    {
        return [
            'show_hero' => true,
            'hero_eyebrow' => 'Bendo Jaya Batik Fashion',
            'hero_title' => 'Batik Tradisional dengan Sentuhan Elegan Modern.',
            'hero_subtitle' => 'Koleksi pakaian batik, custom seragam, dan kerja sama produksi untuk brand, komunitas, maupun instansi.',
            'hero_primary_label' => 'Konsultasi Sekarang',
            'hero_primary_url' => '/pages/kerja-sama',
            'hero_secondary_label' => 'Lihat Koleksi',
            'hero_secondary_url' => '/collections',

            'show_value_strip' => true,
            'value_items' => [
                ['title' => 'Batik Fashion', 'description' => 'Koleksi pakaian batik berkarakter.'],
                ['title' => 'Custom Produksi', 'description' => 'Untuk brand, komunitas, dan instansi.'],
                ['title' => 'Kerja Sama', 'description' => 'Kolaborasi produk dan seragam batik.'],
            ],

            'show_about' => true,
            'about_eyebrow' => 'Tentang Bendo Jaya',
            'about_title' => 'Menghadirkan batik sebagai identitas gaya yang hangat dan elegan.',
            'about_description' => 'Bendo Jaya mengembangkan pakaian batik dengan karakter tradisional, warna hangat, dan tampilan yang cocok untuk kebutuhan harian, acara, hingga custom produksi.',
            'show_about_button' => true,
            'about_button_label' => 'Selengkapnya Tentang Kami',
            'about_button_url' => '/pages/tentang-bendo-jaya',

            'show_services' => true,
            'services_eyebrow' => 'Layanan',
            'services_title' => 'Layanan batik untuk kebutuhan personal, komunitas, dan bisnis.',
            'services_description' => 'Mulai dari koleksi siap pakai, custom pakaian, hingga kerja sama produksi.',

            'show_collections' => true,
            'collections_eyebrow' => 'Koleksi Pilihan',
            'collections_title' => 'Koleksi batik dengan warna hangat dan motif berkarakter.',
            'collections_description' => 'Pilihan koleksi batik Bendo Jaya yang tampil elegan dan mudah dipadukan.',

            'show_gallery' => true,
            'gallery_eyebrow' => 'Gallery',
            'gallery_title' => 'Detail motif, koleksi, dan cerita visual Bendo Jaya.',
            'gallery_description' => 'Dokumentasi produk, motif, photoshoot, dan proses kreatif Bendo Jaya Batik Fashion.',

            'show_partners' => true,
            'partners_eyebrow' => 'Kerja Sama',
            'partners_title' => 'Terbuka untuk brand, komunitas, dan kebutuhan custom.',
            'partners_description' => 'Bendo Jaya dapat menjadi partner untuk kebutuhan koleksi fashion, custom pakaian batik, seragam komunitas, maupun pengembangan produk bersama brand.',

            'show_testimonials' => true,
            'testimonials_eyebrow' => 'Testimoni',
            'testimonials_title' => 'Cerita client yang pernah bekerja sama.',
            'testimonials_description' => 'Pengalaman client, brand, dan komunitas bersama Bendo Jaya.',

            'show_articles' => true,
            'articles_eyebrow' => 'Artikel',
            'articles_title' => 'Cerita, inspirasi, dan edukasi batik.',
            'articles_description' => 'Artikel seputar batik, fashion, perawatan, dan inspirasi gaya.',

            'show_cta' => true,
            'cta_eyebrow' => 'Mulai Diskusi',
            'cta_title' => 'Siap membuat koleksi batik bersama Bendo Jaya?',
            'cta_description' => 'Ceritakan kebutuhan koleksi, custom pakaian, seragam, atau kerja sama brand Anda.',
            'cta_button_label' => 'Konsultasi Sekarang',
            'cta_button_url' => '/pages/kerja-sama',
        ];
    }

    public function imageUrl(?string $field): ?string
    {
        $value = $field ? $this->{$field} : null;

        return $value ? Storage::url($value) : null;
    }
}
