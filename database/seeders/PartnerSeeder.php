<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Fashion Brand Partner',
                'category' => 'Brand Fashion',
                'description' => 'Kerja sama pengembangan koleksi batik bersama brand fashion.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Community Partner',
                'category' => 'Komunitas',
                'description' => 'Kerja sama custom pakaian dan seragam batik untuk komunitas.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Institution Partner',
                'category' => 'Instansi',
                'description' => 'Kebutuhan seragam, acara, dan pakaian batik untuk instansi.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Production Partner',
                'category' => 'Produksi',
                'description' => 'Mitra produksi dan pengembangan produk fashion batik.',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            Partner::query()->updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    ...$item,
                    'slug' => Str::slug($item['name']),
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
