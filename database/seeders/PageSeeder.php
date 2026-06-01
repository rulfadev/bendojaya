<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::query()->updateOrCreate(
            ['slug' => 'kerja-sama'],
            [
                'title' => 'Kerja Sama dengan Bendo Jaya',
                'excerpt' => 'Ajukan kerja sama custom pakaian batik, seragam, komunitas, atau brand fashion bersama Bendo Jaya.',
                'content' => '<p>Bendo Jaya terbuka untuk kerja sama produksi pakaian batik, custom seragam, kebutuhan komunitas, instansi, maupun pengembangan koleksi bersama brand fashion.</p><p>Silakan hubungi kami untuk berdiskusi mengenai kebutuhan desain, jumlah produksi, konsep koleksi, dan jadwal pengerjaan.</p>',
                'meta_title' => 'Kerja Sama - Bendo Jaya Batik Fashion',
                'meta_description' => 'Ajukan kerja sama custom pakaian batik, seragam, dan produksi fashion bersama Bendo Jaya.',
                'show_in_navigation' => true,
                'is_active' => true,
                'sort_order' => 1,
                'published_at' => now(),
            ]
        );
    }
}
