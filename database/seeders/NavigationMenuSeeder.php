<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['label' => 'Beranda', 'type' => 'custom', 'url' => '/', 'position' => 'both', 'sort_order' => 1],
            ['label' => 'Tentang', 'type' => 'anchor', 'anchor' => 'about', 'position' => 'header', 'sort_order' => 2],
            ['label' => 'Layanan', 'type' => 'anchor', 'anchor' => 'services', 'position' => 'header', 'sort_order' => 3],
            ['label' => 'Koleksi', 'type' => 'anchor', 'anchor' => 'collection', 'position' => 'header', 'sort_order' => 4],
            ['label' => 'Gallery', 'type' => 'anchor', 'anchor' => 'gallery', 'position' => 'header', 'sort_order' => 5],
            ['label' => 'Artikel', 'type' => 'custom', 'url' => '/articles', 'position' => 'both', 'sort_order' => 6],
            ['label' => 'Kontak', 'type' => 'anchor', 'anchor' => 'contact', 'position' => 'both', 'sort_order' => 7],
        ];

        foreach ($menus as $menu) {
            NavigationMenu::query()->updateOrCreate(
                ['label' => $menu['label'], 'position' => $menu['position']],
                [
                    ...$menu,
                    'target' => '_self',
                    'is_active' => true,
                ]
            );
        }
    }
}
