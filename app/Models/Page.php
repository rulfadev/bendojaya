<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[Fillable(['title', 'slug', 'excerpt', 'content', 'featured_image', 'meta_title', 'meta_description', 'meta_keywords', 'show_in_navigation', 'is_active', 'sort_order', 'published_at'])]

class Page extends Model
{
    protected function casts(): array
    {
        return [
            'show_in_navigation' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeNavigation(Builder $query): Builder
    {
        return $query->where('show_in_navigation', true);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function activeSections(): HasMany
    {
        return $this->sections()->where('is_active', true);
    }
}
