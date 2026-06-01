<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Bendo Jaya',
                'tagline' => 'Solusi Produksi Pakaian dan Batik Berkualitas',
                'short_description' => 'Bendo Jaya adalah bisnis pakaian yang berfokus pada produksi, koleksi, dan kerja sama brand fashion dengan kualitas terbaik.',

                'email' => 'info@bendojaya.id',
                'phone' => '6285878617889',
                'whatsapp_number' => '6285878617889',
                'address' => 'Indonesia',

                'instagram_url' => 'https://www.instagram.com/bendojayaid/',
                'tiktok_url' => 'https://www.tiktok.com/@bendojayaid',
                'facebook_url' => 'https://www.facebook.com/bendojayaid',
                'youtube_url' => 'https://www.youtube.com/@bendojayaid',

                'meta_title' => 'Bendo Jaya - Produksi Pakaian dan Batik Berkualitas',
                'meta_description' => 'Bendo Jaya adalah website bisnis pakaian, batik, koleksi produk, gallery, artikel, dan kerja sama brand fashion.',
                'meta_keywords' => 'Bendo Jaya, pakaian, batik, fashion, produksi pakaian, brand fashion, konveksi, gallery pakaian',
            ]
        );
    }
}