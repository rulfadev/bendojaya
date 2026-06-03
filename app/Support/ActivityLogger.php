<?php

namespace App\Support;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function record(
        string $action,
        ?Model $subject = null,
        array $oldValues = [],
        array $newValues = [],
        ?string $description = null
    ): void {
        if ($subject instanceof ActivityLog) {
            return;
        }

        $request = request();

        ActivityLog::query()->create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'description' => $description,
            'old_values' => filled($oldValues) ? $oldValues : null,
            'new_values' => filled($newValues) ? $newValues : null,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
            'url' => $request?->fullUrl(),
            'method' => $request?->method(),
        ]);
    }
}
