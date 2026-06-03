@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-black text-stone-800">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $attributes->merge([
            'class' =>
                'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition placeholder:text-stone-400 focus:border-stone-950 focus:ring-4 focus:ring-amber-200',
        ]) }}>

    @error($name)
        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
