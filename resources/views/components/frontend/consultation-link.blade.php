@props([
    'label' => null,
    'class' => '',
    'template' => 'default',
    'data' => [],
])

@php
    $href = \App\Support\WhatsappMessage::url($template, $data);

    $slotContent = trim($slot->toHtml());

    $buttonLabel = $label;
@endphp

<a href="{{ $href }}" target="_blank" rel="noopener noreferrer"
    {{ $attributes->merge([
        'class' => trim(
            'inline-flex items-center justify-center gap-3 rounded-full bg-[#3C3B39] px-7 py-4 text-sm font-black text-[#FBE9CB] shadow-xl shadow-[#3C3B39]/10 transition hover:-translate-y-1 hover:bg-[#58433D] ' .
                $class,
        ),
    ]) }}>
    <i class="fa-brands fa-whatsapp text-lg"></i>
    @if ($buttonLabel)
        {{ $buttonLabel }}
    @elseif ($slotContent !== '')
        {{ $slot }}
    @else
        {{ __('frontend.consult_now') }}
    @endif

</a>
