<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['site_name', 'tagline', 'short_description', 'logo', 'favicon', 'email', 'phone', 'whatsapp_number', 'consultation_label', 'consultation_url', 'address', 'instagram_url', 'tiktok_url', 'facebook_url', 'youtube_url', 'meta_title', 'meta_description', 'meta_keywords', 'is_maintenance_mode', 'maintenance_title', 'maintenance_description', 'maintenance_image', 'allow_search_indexing', 'site_author', 'default_og_image', 'google_site_verification', 'bing_site_verification', 'show_about_button', 'about_button_label', 'about_button_url'])]
class SiteSetting extends Model
{
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon ? Storage::url($this->favicon) : null;
    }

    protected function casts(): array
    {
        return [
            'is_maintenance_mode' => 'boolean',
            'allow_search_indexing' => 'boolean',
            'show_about_button' => 'boolean',
        ];
    }

    public function getMaintenanceImageUrlAttribute(): ?string
    {
        return $this->maintenance_image ? Storage::url($this->maintenance_image) : null;
    }

    public function getDefaultOgImageUrlAttribute(): ?string
    {
        return $this->default_og_image ? Storage::url($this->default_og_image) : null;
    }
}
