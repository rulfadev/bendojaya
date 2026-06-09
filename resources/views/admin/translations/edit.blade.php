@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.translations.update', [$resource, $item->id, $locale]) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-xs font-black uppercase tracking-[0.2em] text-stone-400">
                    Original Content
                </p>

                <h2 class="mt-2 text-xl font-black text-stone-950">
                    {{ $item->{$config['title_field']} ?? 'Untitled' }}
                </h2>
            </div>

            <div class="space-y-5">
                @foreach ($config['fields'] as $field => $label)
                    <div>
                        <label class="mb-2 block text-sm font-black text-stone-700">
                            {{ $label }} - English
                        </label>

                        @if (str_contains($field, 'content') ||
                                str_contains($field, 'description') ||
                                str_contains($field, 'answer') ||
                                str_contains($field, 'message'))
                            <textarea name="data[{{ $field }}]" rows="6"
                                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-700 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-100">{{ old('data.' . $field, $data[$field] ?? '') }}</textarea>
                        @else
                            <input type="text" name="data[{{ $field }}]"
                                value="{{ old('data.' . $field, $data[$field] ?? '') }}"
                                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-700 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-100">
                        @endif

                        <p class="mt-2 text-xs font-semibold text-stone-400">
                            Original:
                            {{ str($item->{$field} ?? '-')->limit(180) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.translations.list', $resource) }}"
                class="rounded-full bg-white px-5 py-3 text-sm font-black text-stone-600 shadow-sm">
                Batal
            </a>

            <button class="rounded-full bg-stone-950 px-5 py-3 text-sm font-black text-amber-200 shadow-sm">
                Simpan Translate
            </button>
        </div>
    </form>
@endsection
