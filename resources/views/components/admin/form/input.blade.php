@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => null,
    'containerClass' => '',
    'labelClass' => '',
])

@php
    $defaultClasses = [
        'h-[50px]',
        'w-full',
        'rounded-[1.25rem]',
        'border',
        'border-stone-200',
        'bg-white',
        'px-4',
        'py-3',
        'text-sm',
        'font-bold',
        'text-stone-900',
        'outline-none',
        'transition',
        'placeholder:text-stone-400',
        'hover:bg-[#fffaf2]',
        'focus:border-stone-950',
        'focus:ring-4',
        'focus:ring-amber-200',
        'disabled:cursor-not-allowed',
        'disabled:opacity-60',
    ];

    $customClass = trim((string) $attributes->get('class'));
    $customClasses = collect(preg_split('/\s+/', $customClass, -1, PREG_SPLIT_NO_EMPTY));

    $hasCustomClass = function (callable $callback) use ($customClasses) {
        return $customClasses->contains(fn($class) => $callback($class));
    };

    $hasCustomHeight = $hasCustomClass(function ($class) {
        // h-full jangan dianggap override height default,
        // karena sering bikin input gepeng kalau parent tidak punya tinggi.
        return preg_match('/^h-(\d|px|screen|\[)/', $class);
    });

    $hasCustomWidth = $hasCustomClass(fn($class) => preg_match('/^(w|min-w|max-w)-/', $class));
    $hasCustomRadius = $hasCustomClass(fn($class) => str_starts_with($class, 'rounded'));
    $hasCustomBg = $hasCustomClass(fn($class) => str_starts_with($class, 'bg-'));
    $hasCustomHoverBg = $hasCustomClass(fn($class) => str_starts_with($class, 'hover:bg-'));

    $hasCustomPx = $hasCustomClass(fn($class) => preg_match('/^(p|px|pl|pr)-/', $class));
    $hasCustomPy = $hasCustomClass(fn($class) => preg_match('/^(p|py|pt|pb)-/', $class));

    $hasCustomTextSize = $hasCustomClass(
        fn($class) => preg_match('/^text-(xs|sm|base|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl|8xl|9xl)$/', $class),
    );
    $hasCustomTextColor = $hasCustomClass(
        fn($class) => preg_match('/^text-(?!xs$|sm$|base$|lg$|xl$|2xl$|3xl$|4xl$|5xl$|6xl$|7xl$|8xl$|9xl$)/', $class),
    );
    $hasCustomFont = $hasCustomClass(fn($class) => str_starts_with($class, 'font-'));

    $hasCustomBorderWidth = $hasCustomClass(fn($class) => preg_match('/^border(-0|-2|-4|-8)?$/', $class));
    $hasCustomBorderColor = $hasCustomClass(
        fn($class) => str_starts_with($class, 'border-') && !preg_match('/^border(-0|-2|-4|-8)?$/', $class),
    );

    $hasCustomFocusBorder = $hasCustomClass(fn($class) => str_starts_with($class, 'focus:border-'));
    $hasCustomFocusRing = $hasCustomClass(fn($class) => str_starts_with($class, 'focus:ring-'));
    $hasCustomPlaceholder = $hasCustomClass(fn($class) => str_starts_with($class, 'placeholder:'));

    $filteredDefaultClasses = collect($defaultClasses)
        ->reject(function ($class) use (
            $hasCustomHeight,
            $hasCustomWidth,
            $hasCustomRadius,
            $hasCustomBg,
            $hasCustomHoverBg,
            $hasCustomPx,
            $hasCustomPy,
            $hasCustomTextSize,
            $hasCustomTextColor,
            $hasCustomFont,
            $hasCustomBorderWidth,
            $hasCustomBorderColor,
            $hasCustomFocusBorder,
            $hasCustomFocusRing,
            $hasCustomPlaceholder,
        ) {
            return match (true) {
                $class === 'h-[50px]' => $hasCustomHeight,
                $class === 'w-full' => $hasCustomWidth,

                str_starts_with($class, 'rounded') => $hasCustomRadius,

                $class === 'border' => $hasCustomBorderWidth,
                $class === 'border-stone-200' => $hasCustomBorderColor,

                $class === 'bg-white' => $hasCustomBg,
                $class === 'hover:bg-[#fffaf2]' => $hasCustomHoverBg,

                $class === 'px-4' => $hasCustomPx,
                $class === 'py-3' => $hasCustomPy,

                $class === 'text-sm' => $hasCustomTextSize,
                $class === 'text-stone-900' => $hasCustomTextColor,
                $class === 'font-bold' => $hasCustomFont,

                $class === 'focus:border-stone-950' => $hasCustomFocusBorder,
                $class === 'focus:ring-4' => $hasCustomFocusRing,
                $class === 'focus:ring-amber-200' => $hasCustomFocusRing,

                $class === 'placeholder:text-stone-400' => $hasCustomPlaceholder,

                default => false,
            };
        })
        ->implode(' ');

    $inputClass = trim($filteredDefaultClasses . ' ' . $customClass);
@endphp

<div class="w-full {{ $containerClass }}">
    @if ($label)
        <label for="{{ $name }}" class="mb-2 block text-sm font-black text-stone-800 {{ $labelClass }}">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $attributes->except('class')->merge([
            'class' => $inputClass,
        ]) }}>

    @error($name)
        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
