<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Models\ContentTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait SavesInlineEnglishTranslation
{
    protected function saveInlineEnglishTranslation(Model $model, Request $request, array $fields): void
    {
        $input = $request->input('translation_en', []);

        $data = [];

        foreach ($fields as $field) {
            $value = data_get($input, $field);

            if (is_string($value)) {
                $value = trim($value);
            }

            if (in_array($field, ['settings', 'value_items', 'about_points', 'partners_points'], true) && is_string($value) && $value !== '') {
                $decoded = json_decode($value, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $value = $decoded;
                }
            }

            $data[$field] = $value;
        }

        $hasValue = collect($data)->contains(function ($value) {
            if (is_array($value)) {
                return ! empty(array_filter($value));
            }

            return $value !== null && $value !== '';
        });

        if (! $hasValue) {
            ContentTranslation::query()
                ->where('translatable_type', $model::class)
                ->where('translatable_id', $model->getKey())
                ->where('locale', 'en')
                ->delete();

            return;
        }

        ContentTranslation::query()->updateOrCreate(
            [
                'translatable_type' => $model::class,
                'translatable_id' => $model->getKey(),
                'locale' => 'en',
            ],
            [
                'data' => $data,
            ]
        );
    }
}
