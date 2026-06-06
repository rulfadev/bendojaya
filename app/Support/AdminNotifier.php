<?php

namespace App\Support;

use App\Models\AdminNotification;

class AdminNotifier
{
    public static function send(
        string $type,
        string $title,
        ?string $message = null,
        ?string $url = null,
        array $data = []
    ): void {
        AdminNotification::query()->create([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'url' => $url,
            'data' => $data ?: null,
        ]);
    }
}
