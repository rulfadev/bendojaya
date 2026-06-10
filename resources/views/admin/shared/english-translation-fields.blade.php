@php
    $englishData = [];

    if (($model ?? null) && $model->exists) {
        $englishData =
            \App\Models\ContentTranslation::query()
                ->where('translatable_type', $model::class)
                ->where('translatable_id', $model->getKey())
                ->where('locale', 'en')
                ->value('data') ?? [];
    }

    if (!is_array($englishData)) {
        $englishData = [];
    }

    $jsonFields = ['settings', 'value_items', 'about_points', 'partners_points'];
@endphp

<div class="rounded-[2rem] border border-stone-200 bg-white p-6 shadow-sm">
    <div class="mb-6">
        <p class="text-xs font-black uppercase tracking-[0.2em] text-stone-400">
            English Translation
        </p>

        <h2 class="mt-2 text-lg font-black text-stone-950">
            Terjemahan Bahasa Inggris
        </h2>

        <p class="mt-2 text-sm font-semibold leading-7 text-stone-500">
            Opsional. Jika dikosongkan, halaman English akan memakai data utama bahasa Indonesia sebagai fallback.
        </p>
    </div>

    <div class="grid gap-5">
        @foreach ($fields as $field => $options)
            @php
                $label = $options['label'] ?? str($field)->headline();
                $type = $options['type'] ?? 'text';
                $rows = $options['rows'] ?? 4;

                $value = old('translation_en.' . $field, data_get($englishData, $field, ''));

                if (is_array($value)) {
                    $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                }

                if ($value === null) {
                    $value = '';
                }

                $isJsonField = in_array($field, $jsonFields, true);
            @endphp

            <div>
                <label class="mb-2 block text-sm font-black text-stone-700">
                    {{ $label }} - English
                </label>

                @if ($type === 'editor')
                    @include('admin.shared.trix-editor', [
                        'name' => 'translation_en[' . $field . ']',
                        'value' => $value,
                        'id' => 'translation_en_' . $field,
                    ])
                @elseif ($type === 'textarea' || $isJsonField)
                    <textarea name="translation_en[{{ $field }}]" rows="{{ $rows }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold leading-7 text-stone-700 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-100"
                        @if ($isJsonField) spellcheck="false" @endif>{{ $value }}</textarea>

                    @if ($isJsonField)
                        <p class="mt-2 text-xs font-semibold leading-6 text-stone-500">
                            Format JSON. Untuk mengosongkan, hapus semua isi field ini.
                        </p>
                    @endif
                @else
                    <input type="text" name="translation_en[{{ $field }}]" value="{{ $value }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-700 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-100">
                @endif

                @error('translation_en.' . $field)
                    <p class="mt-2 text-xs font-bold text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        @endforeach
    </div>
</div>
