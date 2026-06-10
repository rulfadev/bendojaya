@extends('layouts.frontend')

@section('content')
    @php
        $getText = function ($item, string $field, mixed $fallback = null) {
            if (is_object($item) && method_exists($item, 'translated')) {
                return $item->translated($field, null, data_get($item, $field, $fallback));
            }

            return data_get($item, $field, $fallback);
        };
    @endphp

    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ __('frontend.faq') }}
            </p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight">
                {{ __('frontend.faq_page_title') }}
            </h1>

            <p class="mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                {{ __('frontend.faq_page_description') }}
            </p>
        </div>
    </section>

    <section class="bg-[#FFF8ED] py-24">
        <div class="mx-auto max-w-5xl px-5 lg:px-8">
            <div class="space-y-10">
                @forelse ($faqs as $category => $items)
                    @php
                        $firstFaq = $items->first();
                        $categoryLabel = $firstFaq ? $getText($firstFaq, 'category', $category) : $category;
                    @endphp

                    <div>
                        <p class="mb-5 text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                            {{ $categoryLabel ?: __('frontend.faq') }}
                        </p>

                        <div class="space-y-4">
                            @foreach ($items as $faq)
                                @php
                                    $question = $getText($faq, 'question', 'FAQ');
                                    $answer = $getText($faq, 'answer', '');
                                @endphp

                                <x-frontend.faq-item :question="$question" :answer="$answer" />
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-10 text-center text-[#7F756D]">
                        {{ __('frontend.no_faq') }}
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
