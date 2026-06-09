<?php

namespace App\Models;

use App\Models\Concerns\HasContentTranslations;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'slug', 'category', 'main_image', 'short_description', 'description', 'material', 'color_palette', 'size_info', 'is_featured', 'is_active', 'sort_order'])]
class FashionCollection extends Model
{
    use HasContentTranslations;

    protected array $translatable = [
        'name',
        'category',
        'short_description',
        'description',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getMainImageUrlAttribute(): ?string
    {
        return $this->main_image ? Storage::url($this->main_image) : null;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(CollectionInquiry::class, 'collection_id');
    }
}
