<?php

namespace App\Models;

use App\Models\Concerns\HasContentTranslations;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['page_id', 'type', 'eyebrow', 'title', 'subtitle', 'content', 'image', 'image_position', 'button_label', 'button_url', 'settings', 'is_active', 'sort_order'])]
class PageSection extends Model
{
    use HasContentTranslations;

    protected array $translatable = [
        'eyebrow',
        'title',
        'subtitle',
        'content',
        'button_label',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'settings' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public const TYPES = [
        'hero' => 'Hero Section',
        'text' => 'Text Section',
        'image_text' => 'Image + Text',
        'cta' => 'CTA Section',
        'faq' => 'FAQ Section',
        'gallery' => 'Gallery Section',
        'raw_html' => 'Raw HTML',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
