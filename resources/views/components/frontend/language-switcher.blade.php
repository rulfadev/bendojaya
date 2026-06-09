@php
    $locale = app()->getLocale();
@endphp

<div class="flex items-center gap-2 rounded-full border border-stone-200 bg-white/90 p-1 text-xs font-black shadow-sm">
    <a href="{{ \App\Support\LocalizedUrl::switchTo('id') }}"
        class="rounded-full px-3 py-1.5 transition
       {{ $locale === 'id' ? 'bg-stone-950 text-amber-200' : 'text-stone-500 hover:bg-stone-100 hover:text-stone-950' }}">
        ID
    </a>

    <a href="{{ \App\Support\LocalizedUrl::switchTo('en') }}"
        class="rounded-full px-3 py-1.5 transition
       {{ $locale === 'en' ? 'bg-stone-950 text-amber-200' : 'text-stone-500 hover:bg-stone-100 hover:text-stone-950' }}">
        EN
    </a>
</div>
