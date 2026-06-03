<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['user_id', 'action', 'subject_type', 'subject_id', 'description', 'old_values', 'new_values', 'ip_address', 'user_agent', 'url', 'method'])]
class ActivityLog extends Model
{
    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    public const ACTIONS = [
        'created' => 'Tambah Data',
        'updated' => 'Edit Data',
        'deleted' => 'Hapus Data',
        'login' => 'Login',
        'logout' => 'Logout',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function getSubjectNameAttribute(): string
    {
        if (! $this->subject_type) {
            return '-';
        }

        return class_basename($this->subject_type);
    }

    public function getActionLabelAttribute(): string
    {
        return self::ACTIONS[$this->action] ?? ucfirst($this->action);
    }
}
