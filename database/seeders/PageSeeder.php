<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->updateOrCreate(
            ['slug' => 'kerja-sama'],
            [
                'title' => 'Kerja Sama dengan Bendo Jaya',
                'excerpt' => 'Ajukan kerja sama custom pakaian batik, seragam, komunitas, atau brand fashion bersama Bendo Jaya.',
                'content' => '<p>Bendo Jaya terbuka untuk kerja sama produksi pakaian batik, custom seragam, kebutuhan komunitas, instansi, maupun pengembangan koleksi bersama brand fashion.</p>',
                'meta_title' => 'Kerja Sama - Bendo Jaya Batik Fashion',
                'meta_description' => 'Ajukan kerja sama custom pakaian batik, seragam, dan produksi fashion bersama Bendo Jaya.',
                'show_in_navigation' => true,
                'is_active' => true,
                'sort_order' => 1,
                'published_at' => now(),
            ]
        );

        PageSection::query()->updateOrCreate(
            [
                'page_id' => $page->id,
                'type' => 'hero',
                'sort_order' => 1,
            ],
            [
                'eyebrow' => 'Kerja Sama',
                'title' => 'Bangun Koleksi Batik Bersama Bendo Jaya',
                'subtitle' => 'Kami terbuka untuk custom pakaian, seragam, komunitas, instansi, hingga kolaborasi brand fashion.',
                'button_label' => 'Konsultasi Sekarang',
                'button_url' => 'https://wa.me/6280000000000',
                'is_active' => true,
            ]
        );

        PageSection::query()->updateOrCreate(
            [
                'page_id' => $page->id,
                'type' => 'image_text',
                'sort_order' => 2,
            ],
            [
                'eyebrow' => 'Custom Production',
                'title' => 'Produksi batik yang disesuaikan dengan kebutuhan brand Anda.',
                'subtitle' => 'Bendo Jaya dapat membantu kebutuhan pakaian batik untuk koleksi fashion, seragam, komunitas, event, maupun produk custom.',
                'content' => '<p>Kami membantu proses diskusi kebutuhan, konsep visual, pilihan motif, jumlah produksi, hingga pengembangan koleksi agar sesuai dengan karakter brand atau komunitas Anda.</p>',
                'image_position' => 'right',
                'is_active' => true,
            ]
        );

        PageSection::query()->updateOrCreate(
            [
                'page_id' => $page->id,
                'type' => 'faq',
                'sort_order' => 3,
            ],
            [
                'eyebrow' => 'FAQ',
                'title' => 'Pertanyaan Seputar Kerja Sama',
                'settings' => [
                    'items' => [
                        [
                            'question' => 'Apakah bisa custom seragam batik?',
                            'answer' => 'Bisa. Kami dapat menyesuaikan kebutuhan desain, warna, jumlah, dan konsep pakaian.',
                        ],
                        [
                            'question' => 'Apakah bisa kerja sama dengan brand fashion?',
                            'answer' => 'Bisa. Bendo Jaya terbuka untuk kolaborasi produk dan pengembangan koleksi bersama brand.',
                        ],
                        [
                            'question' => 'Bagaimana cara konsultasi?',
                            'answer' => 'Silakan hubungi kami melalui tombol konsultasi atau WhatsApp yang tersedia di website.',
                        ],
                    ],
                ],
                'is_active' => true,
            ]
        );

        PageSection::query()->updateOrCreate(
            [
                'page_id' => $page->id,
                'type' => 'cta',
                'sort_order' => 4,
            ],
            [
                'eyebrow' => 'Mulai Diskusi',
                'title' => 'Siap membuat koleksi batik bersama Bendo Jaya?',
                'subtitle' => 'Ceritakan kebutuhan produksi, custom pakaian, atau kerja sama brand Anda kepada kami.',
                'button_label' => 'Konsultasi via WhatsApp',
                'button_url' => 'https://wa.me/6280000000000',
                'is_active' => true,
            ]
        );
    }
}
