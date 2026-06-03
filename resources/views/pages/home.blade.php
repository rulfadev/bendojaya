@extends('layouts.frontend')

@section('content')
    @php
        $heroImage = asset('assets/frontend/hero-product.jpg');
        $whatsapp = $setting?->whatsapp_number ?? '6280000000000';
    @endphp

    @include('partials.frontend.home.hero')
    @include('partials.frontend.home.value-strip')
    @include('partials.frontend.home.about')
    @include('partials.frontend.home.services')
    @include('partials.frontend.home.collection')
    @include('partials.frontend.home.gallery')
    @include('partials.frontend.home.partners')
    @include('partials.frontend.home.testimonials')
    @include('partials.frontend.home.articles')
    @include('partials.frontend.home.cta')
@endsection
