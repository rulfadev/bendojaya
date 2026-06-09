<?php

namespace App\Models;

use App\Models\Concerns\HasContentTranslations;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['label', 'type', 'url', 'page_id', 'article_id', 'anchor', 'position', 'target', 'is_active', 'sort_order'])]
class NavigationMenu extends Model
{
    use HasContentTranslations;

    protected array $translatable = [
        'label',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public const TYPES = [
        'custom' => 'Custom URL',
        'page' => 'Custom Page',
        'article' => 'Artikel',
        'anchor' => 'Section Anchor',
    ];

    public const POSITIONS = [
        'header' => 'Header',
        'footer' => 'Footer',
        'both' => 'Header & Footer',
    ];

    public const TARGETS = [
        '_self' => 'Same Tab',
        '_blank' => 'New Tab',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeForHeader(Builder $query): Builder
    {
        return $query->whereIn('position', ['header', 'both']);
    }

    public function scopeForFooter(Builder $query): Builder
    {
        return $query->whereIn('position', ['footer', 'both']);
    }

    public function getHrefAttribute(): string
    {
        return match ($this->type) {
            'page' => $this->page ? route('pages.show', $this->page) : '#',
            'article' => $this->article ? route('articles.show', $this->article) : '#',
            'anchor' => $this->formatAnchorUrl(),
            default => $this->formatCustomUrl(),
        };
    }

    private function formatCustomUrl(): string
    {
        if (! $this->url) {
            return '#';
        }

        if (str_starts_with($this->url, 'http://') || str_starts_with($this->url, 'https://')) {
            return $this->url;
        }

        if (str_starts_with($this->url, '#')) {
            return route('home').$this->url;
        }

        if (str_starts_with($this->url, '/')) {
            return url($this->url);
        }

        return url('/'.$this->url);
    }

    private function formatAnchorUrl(): string
    {
        $anchor = ltrim((string) $this->anchor, '#');

        if ($anchor === '' || $anchor === 'home') {
            return route('home');
        }

        return route('home').'#'.$anchor;
    }
}
