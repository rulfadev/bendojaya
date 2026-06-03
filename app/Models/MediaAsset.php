<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['user_id', 'title', 'alt_text', 'folder', 'disk', 'path', 'original_name', 'mime_type', 'size'])]
class MediaAsset extends Model
{
    protected function casts(): array
    {
        return [
            'size' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getHumanSizeAttribute(): string
    {
        if ($this->size >= 1048576) {
            return round($this->size / 1048576, 2).' MB';
        }

        if ($this->size >= 1024) {
            return round($this->size / 1024, 2).' KB';
        }

        return $this->size.' B';
    }

    public function isImage(): bool
    {
        return str_starts_with((string) $this->mime_type, 'image/');
    }
}
