@extends('layouts.frontend')

@section('content')
    @php
        $isEnglish = app()->getLocale() === 'en';

        $homeUrl = $isEnglish && \Illuminate\Support\Facades\Route::has('en.home') ? route('en.home') : route('home');
    @endphp

    <section class="flex min-h-[70vh] items-center bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-3xl px-5 text-center lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ __('frontend.testimonial_thankyou_eyebrow') }}
            </p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black">
                {{ __('frontend.testimonial_thankyou_title') }}
            </h1>

            <p class="mt-6 text-sm leading-7 text-[#E6D8C8]">
                {{ __('frontend.testimonial_thankyou_description') }}
            </p>

            <a href="{{ $homeUrl }}"
                class="mt-8 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39]">
                {{ __('frontend.back_to_home') }}
            </a>
        </div>
    </section>
@endsection
