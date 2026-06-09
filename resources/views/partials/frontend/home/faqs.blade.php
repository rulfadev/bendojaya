@php
    $faqItems = collect($faqs ?? []);
    $isEnglish = app()->getLocale() === 'en';

    $faqIndexUrl =
        $isEnglish && \Illuminate\Support\Facades\Route::has('en.faqs.index')
            ? route('en.faqs.index')
            : route('faqs.index');
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

                <a href="{{ $faqIndexUrl }}"
                    class="mt-8 inline-flex items-center gap-3 rounded-full bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">
                    {{ __('frontend.view_all_faq') }}
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="space-y-4">
                @foreach ($faqItems as $faq)
                    <x-frontend.faq-item :question="$faq->question" :answer="$faq->answer" />
                @endforeach
            </div>
        </div>
    </section>
@endif
