@extends('layouts.frontend')

@section('content')
    @php
        $heroImage = $homepage?->hero_image
            ? asset('storage/' . $homepage->hero_image)
            : asset('assets/frontend/hero-product.jpg');

        $whatsapp = $setting?->whatsapp_number ?? '6280000000000';
    @endphp

    @if ($homepage?->show_hero)
        @include('partials.frontend.home.hero')
    @endif

    @if ($homepage?->show_value_strip)
        @include('partials.frontend.home.value-strip')
    @endif

    @if ($homepage?->show_about)
        @include('partials.frontend.home.about')
    @endif

    @if ($homepage?->show_services)
        @include('partials.frontend.home.services')
    @endif

    @if ($homepage?->show_collections)
        @include('partials.frontend.home.collection')
    @endif

    @if ($homepage?->show_gallery)
        @include('partials.frontend.home.gallery')
    @endif

    @if ($homepage?->show_partners)
        @include('partials.frontend.home.partners')
    @endif

    @if ($homepage?->show_testimonials)
        @include('partials.frontend.home.testimonials')
    @endif

    @if ($homepage?->show_articles)
        @include('partials.frontend.home.articles')
    @endif

    @if ($homepage?->show_faq)
        @include('partials.frontend.home.faqs')
    @endif

    @if ($homepage?->show_cta)
        @include('partials.frontend.home.cta')
    @endif
@endsection
