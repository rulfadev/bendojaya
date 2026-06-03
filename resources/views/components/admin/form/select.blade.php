@props([
    'label' => null,
    'name',
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-black text-stone-800">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select id="{{ $name }}" name="{{ $name }}" data-admin-select
            {{ $attributes->merge([
                'class' =>
                    'w-full appearance-none rounded-2xl border border-stone-200 bg-white px-4 py-3 pr-11 text-sm font-semibold text-stone-800 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-200',
            ]) }}>
            {{ $slot }}
        </select>

        <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-stone-400">
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </span>
    </div>

    @error($name)
        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
