@extends('layouts.frontend')

@section('content')
    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">FAQ</p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black leading-tight">
                Pertanyaan yang sering diajukan.
            </h1>

            <p class="mt-6 max-w-2xl text-sm leading-7 text-[#E6D8C8]">
                Informasi seputar Bendo Jaya, custom batik, kerja sama, pemesanan, dan konsultasi.
            </p>
        </div>
    </section>

    <section class="bg-[#FFF8ED] py-24">
        <div class="mx-auto max-w-5xl px-5 lg:px-8">
            <div class="space-y-10">
                @forelse ($faqs as $category => $items)
                    <div>
                        <p class="mb-5 text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                            {{ $category }}
                        </p>

                        <div class="space-y-4">
                            @foreach ($items as $faq)
                                <x-frontend.faq-item :question="$faq->question" :answer="$faq->answer" />
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="rounded-[2rem] border border-[#E6D8C8] bg-white p-10 text-center text-[#7F756D]">
                        Belum ada FAQ.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
