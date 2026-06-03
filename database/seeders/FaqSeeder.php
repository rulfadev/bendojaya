<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'question' => 'Apakah Bendo Jaya menerima custom pakaian batik?',
                'answer' => 'Ya, Bendo Jaya menerima kebutuhan custom pakaian batik untuk personal, komunitas, instansi, maupun brand.',
                'category' => 'Custom',
                'sort_order' => 1,
            ],
            [
                'question' => 'Apakah bisa kerja sama produksi dengan brand?',
                'answer' => 'Bisa. Kami terbuka untuk kerja sama pengembangan koleksi, seragam, dan produksi pakaian batik sesuai kebutuhan brand.',
                'category' => 'Kerja Sama',
                'sort_order' => 2,
            ],
            [
                'question' => 'Bagaimana cara konsultasi kebutuhan batik?',
                'answer' => 'Anda bisa menghubungi kami melalui WhatsApp atau mengisi formulir kontak di website.',
                'category' => 'Konsultasi',
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Faq::query()->updateOrCreate(
                ['question' => $item['question']],
                [
                    ...$item,
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
