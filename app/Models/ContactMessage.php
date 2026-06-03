<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'subject', 'message', 'source_url', 'ip_address', 'user_agent', 'is_read', 'read_at', 'status', 'follow_up_note', 'contacted_at', 'completed_at'])]

class ContactMessage extends Model
{
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'contacted_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public const STATUSES = [
        'new' => 'Baru',
        'read' => 'Dibaca',
        'contacted' => 'Dihubungi',
        'completed' => 'Selesai',
        'archived' => 'Diarsipkan',
    ];

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    public function markAsRead(): void
    {
        if (! $this->is_read || $this->status === 'new') {
            $this->update([
                'is_read' => true,
                'read_at' => $this->read_at ?: now(),
                'status' => $this->status === 'new' ? 'read' : $this->status,
            ]);
        }
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return $status
            ? $query->where('status', $status)
            : $query;
    }
}
