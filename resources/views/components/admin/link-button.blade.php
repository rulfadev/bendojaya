@props(['href', 'variant' => 'dark'])

@php
    $classes = match ($variant) {
        'gold' => 'bg-amber-300 text-stone-950 hover:bg-amber-200',
        'danger' => 'bg-red-100 text-red-700 hover:bg-red-200',
        'light' => 'border border-stone-200 bg-white text-stone-700 hover:bg-stone-50',
        default => 'bg-stone-950 text-amber-200 hover:bg-stone-800',
    };
@endphp

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'inline-flex items-center justify-center gap-2 rounded-2xl px-5 py-3 text-sm font-black transition ' . $classes,
    ]) }}>
    {{ $slot }}
</a>
