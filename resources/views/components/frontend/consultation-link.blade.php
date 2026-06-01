@props([
    'label' => null,
    'variant' => 'dark',
    'class' => '',
])

@php
    $globalSetting = $setting ?? \App\Models\SiteSetting::query()->first();

    $whatsapp = $globalSetting?->whatsapp_number ?? '6280000000000';

    $buttonLabel = $label ?? ($globalSetting?->consultation_label ?? 'Konsultasi');

    $buttonUrl = $globalSetting?->consultation_url ?: 'https://wa.me/' . $whatsapp;

    $isExternal =
        str_starts_with($buttonUrl, 'http://') ||
        str_starts_with($buttonUrl, 'https://') ||
        str_starts_with($buttonUrl, '//');

    $href = str_starts_with($buttonUrl, '/') ? url($buttonUrl) : $buttonUrl;

    $baseClass =
        'inline-flex items-center justify-center rounded-full px-7 py-4 text-sm font-black transition hover:-translate-y-1';

    $variantClass = match ($variant) {
        'light' => 'bg-[#FBE9CB] text-[#3C3B39] hover:bg-white',
        'outline-light' => 'border border-[#FBE9CB]/35 bg-white/5 text-[#FBE9CB] backdrop-blur hover:bg-white/10',
        'outline-brown' => 'border border-[#765A4F] text-[#765A4F] hover:bg-[#765A4F] hover:text-white',
        'text' => 'px-0 py-0 text-[#8A3F35] hover:text-[#3C3B39]',
        default => 'bg-[#3C3B39] text-[#FBE9CB] hover:bg-[#58433D]',
    };
@endphp

<a href="{{ $href }}" @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
    {{ $attributes->merge(['class' => trim($baseClass . ' ' . $variantClass . ' ' . $class)]) }}>
    {{ $buttonLabel }}
</a>
