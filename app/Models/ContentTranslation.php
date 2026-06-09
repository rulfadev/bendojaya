<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['translatable_type', 'translatable_id', 'locale', 'data'])]
class ContentTranslation extends Model
{
    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }
}
