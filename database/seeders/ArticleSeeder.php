<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Mengenal Karakter Motif Batik dalam Fashion Modern',
                'category' => 'Batik Insight',
                'excerpt' => 'Batik tidak hanya menjadi pakaian formal, tetapi juga identitas visual yang bisa tampil modern.',
                'content' => '<p>Batik memiliki karakter motif, warna, dan cerita visual yang kuat. Dalam fashion modern, batik dapat dikembangkan menjadi busana harian yang nyaman, elegan, dan tetap membawa nilai tradisional.</p>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Cara Merawat Pakaian Batik agar Tetap Indah',
                'category' => 'Care Tips',
                'excerpt' => 'Perawatan yang tepat membantu warna dan motif batik tetap awet lebih lama.',
                'content' => '<p>Pakaian batik sebaiknya dicuci dengan lembut, tidak direndam terlalu lama, dan dijemur di tempat teduh agar warna tetap terjaga.</p>',
                'sort_order' => 2,
            ],
        ];

        foreach ($items as $item) {
            Article::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    ...$item,
                    'slug' => Str::slug($item['title']),
                    'meta_title' => $item['title'].' - Bendo Jaya',
                    'meta_description' => $item['excerpt'],
                    'is_featured' => true,
                    'is_active' => true,
                    'published_at' => now(),
                ]
            );
        }
    }
}
