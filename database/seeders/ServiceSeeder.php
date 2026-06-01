<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Koleksi Batik Wanita Ready to Wear',
                'icon' => '01',
                'short_description' => 'Pilihan dress dan pakaian batik wanita dengan motif elegan untuk kebutuhan harian.',
                'description' => 'Bendo Jaya menghadirkan koleksi batik wanita yang nyaman, hangat, feminin, dan tetap membawa karakter tradisional.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Custom Pakaian dan Seragam Batik',
                'icon' => '02',
                'short_description' => 'Produksi pakaian batik untuk komunitas, instansi, acara, dan kebutuhan seragam.',
                'description' => 'Layanan custom pakaian batik untuk kebutuhan komunitas, organisasi, acara keluarga, instansi, hingga brand.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Kerja Sama Brand Fashion dan Komunitas',
                'icon' => '03',
                'short_description' => 'Terbuka untuk kerja sama produksi, pengembangan koleksi, dan kebutuhan brand partner.',
                'description' => 'Bendo Jaya dapat menjadi partner produksi dan pengembangan koleksi batik bersama brand fashion maupun komunitas.',
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['slug' => Str::slug($service['title'])],
                [
                    ...$service,
                    'slug' => Str::slug($service['title']),
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
