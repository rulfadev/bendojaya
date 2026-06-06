<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'type', 'title', 'message', 'url', 'data', 'read_at'])]
class AdminNotification extends Model
{
    protected function casts(): array
    {
        return [
            'data' => 'array',
            'read_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIsReadAttribute(): bool
    {
        return filled($this->read_at);
    }

    public function getIconAttribute(): string
    {
        return match ($this->type) {
            'collection_inquiry' => 'fa-solid fa-clipboard-question',
            'partnership_inquiry' => 'fa-solid fa-handshake-angle',
            'quotation_viewed' => 'fa-solid fa-eye',
            'quotation_approved' => 'fa-solid fa-circle-check',
            'quotation_rejected' => 'fa-solid fa-circle-xmark',
            default => 'fa-solid fa-bell',
        };
    }

    public function getColorClassAttribute(): string
    {
        return match ($this->type) {
            'collection_inquiry',
            'partnership_inquiry' => 'bg-amber-100 text-amber-800',
            'quotation_viewed' => 'bg-blue-100 text-blue-700',
            'quotation_approved' => 'bg-emerald-100 text-emerald-700',
            'quotation_rejected' => 'bg-red-100 text-red-700',
            default => 'bg-stone-100 text-stone-700',
        };
    }
}
