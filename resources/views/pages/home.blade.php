@extends('layouts.frontend')

@section('content')
    @php
        $heroImage = asset('assets/frontend/hero-product.jpg');
        $whatsapp = $setting?->whatsapp_number ?? '6280000000000';

        $collections = [
            [
                'name' => 'Batik Dress Coklat Klasik',
                'category' => 'Signature Collection',
                'desc' => 'Nuansa coklat hangat dengan motif batik klasik untuk tampilan harian yang anggun.',
            ],
            [
                'name' => 'Batik Dress Abu Natural',
                'category' => 'Soft Traditional',
                'desc' => 'Warna natural dengan karakter lembut, cocok untuk gaya santai maupun semi-formal.',
            ],
            [
                'name' => 'Batik Dress Maroon Elegan',
                'category' => 'Elegant Series',
                'desc' => 'Pilihan warna maroon yang tegas, feminin, dan tetap membawa sentuhan tradisional.',
            ],
        ];

        $services = [
            'Koleksi batik wanita ready to wear',
            'Custom pakaian dan seragam batik',
            'Kerja sama brand fashion dan komunitas',
        ];

        $articles = [
            'Mengenal Karakter Motif Batik dalam Fashion Modern',
            'Cara Merawat Pakaian Batik agar Tetap Indah',
        ];
    @endphp

    @include('partials.frontend.home.hero')
    @include('partials.frontend.home.value-strip')
    @include('partials.frontend.home.about')
    @include('partials.frontend.home.services')
    @include('partials.frontend.home.collection')
    @include('partials.frontend.home.gallery')
    @include('partials.frontend.home.partners')
    @include('partials.frontend.home.articles')
    @include('partials.frontend.home.cta')
@endsection
