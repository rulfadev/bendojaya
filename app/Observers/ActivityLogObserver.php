<?php

namespace App\Observers;

use App\Support\ActivityLogger;
use Illuminate\Database\Eloquent\Model;

class ActivityLogObserver
{
    public function created(Model $model): void
    {
        if ($this->shouldSkip()) {
            return;
        }

        ActivityLogger::record(
            'created',
            $model,
            [],
            $this->cleanValues($model->getAttributes()),
            'Menambahkan '.$this->subjectLabel($model)
        );
    }

    public function updated(Model $model): void
    {
        if ($this->shouldSkip()) {
            return;
        }

        $changes = $this->cleanValues($model->getChanges());

        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        $oldValues = [];

        foreach (array_keys($changes) as $field) {
            $oldValues[$field] = $model->getOriginal($field);
        }

        ActivityLogger::record(
            'updated',
            $model,
            $this->cleanValues($oldValues),
            $changes,
            'Memperbarui '.$this->subjectLabel($model)
        );
    }

    public function deleted(Model $model): void
    {
        if ($this->shouldSkip()) {
            return;
        }

        ActivityLogger::record(
            'deleted',
            $model,
            $this->cleanValues($model->getAttributes()),
            [],
            'Menghapus '.$this->subjectLabel($model)
        );
    }

    private function shouldSkip(): bool
    {
        return app()->runningInConsole();
    }

    private function subjectLabel(Model $model): string
    {
        $name = $model->title
            ?? $model->name
            ?? $model->label
            ?? $model->question
            ?? $model->email
            ?? ('ID #'.$model->getKey());

        return class_basename($model).' - '.$name;
    }

    private function cleanValues(array $values): array
    {
        $hidden = [
            'password',
            'remember_token',
            'current_password',
            'password_confirmation',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'api_token',
            'token',
        ];

        foreach ($hidden as $field) {
            unset($values[$field]);
        }

        foreach ($values as $key => $value) {
            if ($value instanceof \DateTimeInterface) {
                $values[$key] = $value->format('Y-m-d H:i:s');

                continue;
            }

            if (is_array($value)) {
                $values[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);

                continue;
            }

            if (is_string($value) && mb_strlen($value) > 1000) {
                $values[$key] = mb_substr($value, 0, 1000).'...';
            }
        }

        return $values;
    }
}
