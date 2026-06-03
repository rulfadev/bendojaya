@php
    $ctaImage = $homepage?->cta_image
        ? asset('storage/' . $homepage->cta_image)
        : asset('assets/frontend/hero-product.jpg');

    $ctaUrl =
        $homepage?->cta_button_url ?:
        ($setting?->consultation_url ?:
        'https://wa.me/' . ($setting?->whatsapp_number ?? '6280000000000'));
    $ctaHref = str_starts_with($ctaUrl, '/') ? url($ctaUrl) : $ctaUrl;
@endphp

<section id="contact" class="bg-[#FFF8ED] py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-[#3C3B39] text-[#FBE9CB]">
            <div class="absolute inset-0 bg-cover bg-center opacity-25"
                style="background-image: url('{{ $ctaImage }}');"></div>

            <div class="absolute inset-0 bg-[#3C3B39]/80"></div>

            <div class="relative grid gap-10 p-8 sm:p-12 lg:grid-cols-[0.9fr_1.1fr] lg:p-16">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                        {{ $homepage?->cta_eyebrow ?: 'Mulai Diskusi' }}
                    </p>

                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                        {{ $homepage?->cta_title ?: 'Siap membuat koleksi batik bersama Bendo Jaya?' }}
                    </h2>

                    <p class="mt-6 text-base leading-8 text-[#E6D8C8]">
                        {{ $homepage?->cta_description ?: 'Ceritakan kebutuhan koleksi, custom pakaian, seragam, atau kerja sama brand Anda.' }}
                    </p>

                    @if ($homepage?->cta_button_label)
                        <a href="{{ $ctaHref }}"
                            class="mt-8 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] transition hover:-translate-y-1 hover:bg-white">
                            {{ $homepage->cta_button_label }}
                        </a>
                    @endif
                </div>

                <div class="rounded-[2rem] bg-[#FFF8ED] p-6 text-left">
                    @include('partials.frontend.contact-form')
                </div>
            </div>
        </div>
    </div>
</section>
