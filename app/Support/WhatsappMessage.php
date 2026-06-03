<?php

namespace App\Support;

use App\Models\SiteSetting;
use App\Models\WhatsappTemplate;

class WhatsappMessage
{
    public static function url(string $key = 'default', array $data = []): string
    {
        $setting = SiteSetting::query()->first();

        $number = self::normalizeNumber($setting?->whatsapp_number ?? '6280000000000');

        $message = self::message($key, $data);

        return 'https://wa.me/'.$number.'?text='.rawurlencode($message);
    }

    public static function message(string $key = 'default', array $data = []): string
    {
        $setting = SiteSetting::query()->first();

        $template = WhatsappTemplate::query()
            ->where('key', $key)
            ->where('is_active', true)
            ->first();

        if (! $template) {
            $template = WhatsappTemplate::query()
                ->where('key', 'default')
                ->where('is_active', true)
                ->first();
        }

        $message = $template?->message
            ?: WhatsappTemplate::defaultMessages()['default'];

        $replacements = array_merge([
            'site_name' => $setting?->site_name ?? config('app.name', 'Bendo Jaya'),
            'page_title' => $data['page_title'] ?? null,
            'service_title' => $data['service_title'] ?? null,
            'collection_name' => $data['collection_name'] ?? null,
            'collection_category' => $data['collection_category'] ?? null,
            'current_url' => $data['current_url'] ?? url()->current(),
        ], $data);

        foreach ($replacements as $placeholder => $value) {
            $message = str_replace('{'.$placeholder.'}', (string) ($value ?? '-'), $message);
        }

        return trim($message);
    }

    private static function normalizeNumber(string $number): string
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        if (str_starts_with($number, '0')) {
            return '62'.substr($number, 1);
        }

        return $number;
    }
}
