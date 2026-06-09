@extends('layouts.admin')

@section('content')
    @php
        $jsonFields = ['value_items', 'about_points', 'partners_points'];

        $resourceTitle = $item->{$config['title_field']} ?? 'Untitled';
    @endphp

    <form method="POST" action="{{ route('admin.translations.update', [$resource, $item->id, $locale]) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-stone-400">
                        Original Content
                    </p>

                    <h2 class="mt-2 text-xl font-black text-stone-950">
                        {{ $resourceTitle }}
                    </h2>

                    <p class="mt-2 text-sm font-semibold text-stone-500">
                        Locale: <span class="font-black uppercase text-stone-950">{{ $locale }}</span>
                    </p>
                </div>

                <a href="{{ route('admin.translations.list', $resource) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-black text-stone-600 shadow-sm transition hover:-translate-y-0.5 hover:text-stone-950">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Kembali
                </a>
            </div>

            <div class="space-y-6">
                @foreach ($config['fields'] as $field => $label)
                    @php
                        $originalValue = $item->{$field} ?? null;

                        $isJsonField =
                            in_array($field, $jsonFields, true) ||
                            is_array($originalValue) ||
                            is_array($data[$field] ?? null);

                        $translationValue = old('data.' . $field, $data[$field] ?? '');

                        if (is_array($translationValue)) {
                            $translationValue = json_encode(
                                $translationValue,
                                JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                            );
                        }

                        $originalPreview = $originalValue;

                        if (is_array($originalPreview)) {
                            $originalPreview = json_encode(
                                $originalPreview,
                                JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                            );
                        }

                        if ($originalPreview === null || $originalPreview === '') {
                            $originalPreview = '-';
                        }

                        $useTextarea =
                            $isJsonField ||
                            str_contains($field, 'content') ||
                            str_contains($field, 'description') ||
                            str_contains($field, 'answer') ||
                            str_contains($field, 'message') ||
                            str_contains($field, 'address') ||
                            str_contains($field, 'hours');
                    @endphp

                    <div class="rounded-[1.5rem] border border-stone-200 bg-white/45 p-5">
                        <label class="mb-2 block text-sm font-black text-stone-800">
                            {{ $label }} - {{ strtoupper($locale) }}
                        </label>

                        @if ($useTextarea)
                            <textarea name="data[{{ $field }}]" rows="{{ $isJsonField ? 10 : 6 }}"
                                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold leading-7 text-stone-700 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-100"
                                @if ($isJsonField) spellcheck="false" @endif>{{ $translationValue }}</textarea>
                        @else
                            <input type="text" name="data[{{ $field }}]" value="{{ $translationValue }}"
                                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-700 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-100">
                        @endif

                        @error('data.' . $field)
                            <p class="mt-2 text-xs font-bold text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        @if ($isJsonField)
                            <p
                                class="mt-3 rounded-2xl bg-amber-50 px-4 py-3 text-xs font-semibold leading-6 text-amber-800">
                                Field ini menggunakan format JSON. Pastikan tanda kurung, koma, dan tanda kutip valid.
                            </p>
                        @endif

                        <div class="mt-4">
                            <p class="text-xs font-black uppercase tracking-[0.16em] text-stone-400">
                                Original
                            </p>

                            <pre
                                class="mt-2 max-h-56 overflow-auto whitespace-pre-wrap rounded-2xl bg-white/80 p-4 text-xs font-semibold leading-6 text-stone-500">{{ $originalPreview }}</pre>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.translations.list', $resource) }}"
                class="inline-flex items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-black text-stone-600 shadow-sm transition hover:-translate-y-0.5 hover:text-stone-950">
                Batal
            </a>

            <button type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-full bg-stone-950 px-5 py-3 text-sm font-black text-amber-200 shadow-sm transition hover:-translate-y-0.5 hover:bg-stone-800">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                Simpan Translate
            </button>
        </div>
    </form>
@endsection
