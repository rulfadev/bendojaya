<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            AdminUserSeeder::class,
            ServiceSeeder::class,
            PageSeeder::class,
            FashionCollectionSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
