@props([
    'label' => null,
    'name',
])

<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-black text-stone-800">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select id="{{ $name }}" name="{{ $name }}" data-admin-select
            {{ $attributes->merge([
                'class' =>
                    'h-auto w-full appearance-none rounded-[1.25rem] border border-stone-200 bg-white px-4 pr-12 text-sm font-black text-stone-900 outline-none transition hover:bg-[#fffaf2] focus:border-stone-950 focus:ring-4 focus:ring-amber-200 disabled:cursor-not-allowed disabled:opacity-60',
            ]) }}>
            {{ $slot }}
        </select>

        <span data-native-select-icon
            class="pointer-events-none absolute right-3 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-stone-100 text-stone-500">
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </span>
    </div>

    @error($name)
        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
