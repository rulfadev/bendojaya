<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Detail Motif Batik',
                'category' => 'Motif Detail',
                'caption' => 'Detail motif batik bernuansa hangat dan elegan.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Koleksi Dress Batik',
                'category' => 'Product Shoot',
                'caption' => 'Koleksi batik wanita untuk gaya harian.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Batik Fashion Look',
                'category' => 'Fashion Editorial',
                'caption' => 'Tampilan batik tradisional dengan sentuhan modern.',
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Gallery::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    ...$item,
                    'slug' => Str::slug($item['title']),
                    'image' => 'gallery/placeholder.jpg',
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
