<?php

namespace App\Models\Concerns;

use App\Models\ContentTranslation;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContentTranslations
{
    protected array $translationDataCache = [];

    public function contentTranslations(): MorphMany
    {
        return $this->morphMany(ContentTranslation::class, 'translatable');
    }

    public function getAttribute($key): mixed
    {
        $value = parent::getAttribute($key);

        if (! $this->shouldAutoTranslateAttribute($key)) {
            return $value;
        }

        return $this->translateAttributeValue($key, $value);
    }

    public function translated(string $field, ?string $locale = null, mixed $fallback = null): mixed
    {
        $locale ??= app()->getLocale();

        $fallback ??= parent::getAttribute($field);

        if ($locale === 'id') {
            return $fallback;
        }

        $data = $this->translationData($locale);
        $value = data_get($data, $field);

        if ($value !== null && $value !== '') {
            return $value;
        }

        return $fallback;
    }

    protected function shouldAutoTranslateAttribute(string $key): bool
    {
        if (app()->getLocale() === 'id') {
            return false;
        }

        if (request()->is('admin') || request()->is('admin/*')) {
            return false;
        }

        if (! property_exists($this, 'translatable')) {
            return false;
        }

        return in_array($key, $this->translatable ?? [], true);
    }

    protected function translateAttributeValue(string $key, mixed $fallback): mixed
    {
        $locale = app()->getLocale();

        $data = $this->translationData($locale);
        $value = data_get($data, $key);

        if ($value !== null && $value !== '') {
            return $value;
        }

        return $fallback;
    }

    protected function translationData(string $locale): array
    {
        if (array_key_exists($locale, $this->translationDataCache)) {
            return $this->translationDataCache[$locale];
        }

        $translation = $this->relationLoaded('contentTranslations')
            ? $this->contentTranslations->firstWhere('locale', $locale)
            : $this->contentTranslations()->where('locale', $locale)->first();

        return $this->translationDataCache[$locale] = $translation?->data ?? [];
    }
}
