@props([
    'label' => null,
    'name',
    'value' => null,
    'rows' => 5,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-black text-stone-800">
            {{ $label }}
        </label>
    @endif

    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' =>
                'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200',
        ]) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
