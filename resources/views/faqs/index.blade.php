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
                                <details class="group rounded-[2rem] border border-[#E6D8C8] bg-white p-6 shadow-sm">
                                    <summary class="flex cursor-pointer list-none items-center justify-between gap-5">
                                        <span class="font-['Playfair_Display'] text-xl font-black text-[#3C3B39]">
                                            {{ $faq->question }}
                                        </span>

                                        <span
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#3C3B39] text-[#FBE9CB] transition group-open:rotate-45">
                                            <i class="fa-solid fa-plus text-sm"></i>
                                        </span>
                                    </summary>

                                    <div class="mt-5 border-t border-[#E6D8C8] pt-5 text-sm leading-7 text-[#7F756D]">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </details>
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
