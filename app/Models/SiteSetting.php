<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['site_name', 'tagline', 'short_description', 'logo', 'favicon', 'email', 'phone', 'whatsapp_number', 'consultation_label', 'consultation_url', 'address', 'instagram_url', 'tiktok_url', 'facebook_url', 'youtube_url', 'meta_title', 'meta_description', 'meta_keywords'])]
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
}
