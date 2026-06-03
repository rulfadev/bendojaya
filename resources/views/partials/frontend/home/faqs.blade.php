@php
    $faqItems = collect($faqs ?? []);
@endphp

@if ($faqItems->isNotEmpty())
    <section id="faq" class="bg-[#FFF8ED] py-24 lg:py-32">
        <div class="mx-auto grid max-w-7xl gap-12 px-5 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $homepage?->faq_eyebrow ?: 'FAQ' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $homepage?->faq_title ?: 'Pertanyaan yang sering diajukan.' }}
                </h2>

                <p class="mt-5 text-base leading-8 text-[#7F756D]">
                    {{ $homepage?->faq_description ?: 'Informasi singkat seputar layanan, custom batik, kerja sama, dan pemesanan.' }}
                </p>

                <a href="{{ route('faqs.index') }}"
                    class="mt-8 inline-flex items-center gap-3 rounded-full bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">
                    Lihat Semua FAQ
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="space-y-4">
                @foreach ($faqItems as $faq)
                    <details class="group rounded-[2rem] border border-[#E6D8C8] bg-white p-6 shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-5">
                            <span class="font-black text-[#3C3B39]">
                                {{ $faq->question }}
                            </span>

                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#3C3B39] text-[#FBE9CB] transition group-open:rotate-45">
                                <i class="fa-solid fa-plus text-xs"></i>
                            </span>
                        </summary>

                        <div class="mt-5 border-t border-[#E6D8C8] pt-5 text-sm leading-7 text-[#7F756D]">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
@endif
