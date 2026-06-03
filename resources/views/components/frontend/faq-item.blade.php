@props(['question', 'answer'])

<div class="rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm">
    <button type="button" data-faq-trigger class="flex w-full items-center justify-between gap-5 px-6 py-5 text-left">
        <span class="font-['Playfair_Display'] text-xl font-black text-[#3C3B39]">
            {{ $question }}
        </span>

        <span data-faq-icon
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#3C3B39] text-[#FBE9CB] transition duration-300">
            <i class="fa-solid fa-plus text-sm"></i>
        </span>
    </button>

    <div data-faq-panel class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
        <div class="border-t border-[#E6D8C8] px-6 py-5 text-sm leading-7 text-[#7F756D]">
            {!! nl2br(e($answer)) !!}
        </div>
    </div>
</div>
