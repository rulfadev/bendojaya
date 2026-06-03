@props([
    'label' => null,
    'name',
    'preview' => null,
    'previewAlt' => 'Preview',
    'accept' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-black text-stone-800">
            {{ $label }}
        </label>
    @endif

    @if ($preview)
        <div class="mb-4 overflow-hidden rounded-2xl border border-stone-200 bg-white p-3">
            <img src="{{ $preview }}" alt="{{ $previewAlt }}" class="h-44 w-full rounded-xl object-cover">
        </div>
    @endif

    <input type="file" id="{{ $name }}" name="{{ $name }}"
        @if ($accept) accept="{{ $accept }}" @endif
        {{ $attributes->merge([
            'class' =>
                'block w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-700 file:mr-4 file:rounded-xl file:border-0 file:bg-stone-950 file:px-4 file:py-2 file:text-sm file:font-black file:text-amber-200 hover:file:bg-stone-800',
        ]) }}>

    @error($name)
        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
