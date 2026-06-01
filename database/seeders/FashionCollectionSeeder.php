<?php

namespace Database\Seeders;

use App\Models\FashionCollection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FashionCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Batik Dress Coklat Klasik',
                'category' => 'Signature Collection',
                'short_description' => 'Nuansa coklat hangat dengan motif batik klasik untuk tampilan harian yang anggun.',
                'description' => 'Koleksi dress batik bernuansa coklat dengan karakter hangat, nyaman, dan cocok digunakan untuk kebutuhan harian maupun semi-formal.',
                'material' => 'Bahan batik premium',
                'color_palette' => 'Coklat, krem, natural',
                'size_info' => 'All size / custom by request',
                'sort_order' => 1,
            ],
            [
                'name' => 'Batik Dress Abu Natural',
                'category' => 'Soft Traditional',
                'short_description' => 'Warna natural dengan karakter lembut, cocok untuk gaya santai maupun semi-formal.',
                'description' => 'Dress batik dengan palet abu natural yang lembut, memberikan kesan sederhana, rapi, dan tetap membawa karakter tradisional.',
                'material' => 'Bahan batik premium',
                'color_palette' => 'Abu, hitam, krem',
                'size_info' => 'All size / custom by request',
                'sort_order' => 2,
            ],
            [
                'name' => 'Batik Dress Maroon Elegan',
                'category' => 'Elegant Series',
                'short_description' => 'Pilihan warna maroon yang tegas, feminin, dan tetap membawa sentuhan tradisional.',
                'description' => 'Koleksi dress batik maroon untuk tampilan yang lebih kuat, anggun, dan cocok digunakan dalam berbagai acara.',
                'material' => 'Bahan batik premium',
                'color_palette' => 'Maroon, coklat, krem',
                'size_info' => 'All size / custom by request',
                'sort_order' => 3,
            ],
        ];

        foreach ($collections as $collection) {
            FashionCollection::query()->updateOrCreate(
                ['slug' => Str::slug($collection['name'])],
                [
                    ...$collection,
                    'slug' => Str::slug($collection['name']),
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
