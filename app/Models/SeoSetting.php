<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['default_meta_title', 'default_meta_description', 'default_meta_keywords', 'default_og_image', 'allow_indexing', 'enable_sitemap', 'enable_json_ld', 'enable_llms_txt', 'canonical_base_url', 'google_site_verification', 'bing_site_verification', 'organization_name', 'organization_logo', 'organization_type', 'same_as_instagram', 'same_as_tiktok', 'robots_extra_rules', 'llms_txt_content'])]
class SeoSetting extends Model
{
    protected function casts(): array
    {
        return [
            'allow_indexing' => 'boolean',
            'enable_sitemap' => 'boolean',
            'enable_json_ld' => 'boolean',
            'enable_llms_txt' => 'boolean',
        ];
    }

    public static function current(): self
    {
        return static::query()->first() ?? static::query()->create([
            'default_meta_title' => 'Bendo Jaya Batik Fashion',
            'default_meta_description' => 'Bendo Jaya Batik Fashion menghadirkan koleksi batik elegan, custom pakaian batik, dan kerja sama brand fashion.',
            'default_meta_keywords' => 'Bendo Jaya, batik fashion, batik wanita, custom batik, seragam batik, kerja sama brand fashion',
            'allow_indexing' => true,
            'enable_sitemap' => true,
            'enable_json_ld' => true,
            'enable_llms_txt' => true,
            'organization_name' => 'Bendo Jaya Batik Fashion',
            'organization_type' => 'ClothingStore',
        ]);
    }

    public function getDefaultOgImageUrlAttribute(): ?string
    {
        return $this->default_og_image ? Storage::url($this->default_og_image) : null;
    }

    public function getOrganizationLogoUrlAttribute(): ?string
    {
        return $this->organization_logo ? Storage::url($this->organization_logo) : null;
    }
}
