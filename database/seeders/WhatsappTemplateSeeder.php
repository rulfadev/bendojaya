<?php

namespace Database\Seeders;

use App\Models\WhatsappTemplate;
use Illuminate\Database\Seeder;

class WhatsappTemplateSeeder extends Seeder
{
    public function run(): void
    {
        foreach (WhatsappTemplate::KEYS as $key => $label) {
            WhatsappTemplate::query()->updateOrCreate(
                ['key' => $key],
                [
                    'label' => $label,
                    'message' => WhatsappTemplate::defaultMessages()[$key],
                    'is_active' => true,
                    'sort_order' => array_search($key, array_keys(WhatsappTemplate::KEYS), true) + 1,
                ]
            );
        }
    }
}
