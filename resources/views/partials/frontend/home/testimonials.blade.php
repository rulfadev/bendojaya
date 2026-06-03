@php
    $testimonialItems = collect($testimonials ?? []);
@endphp

@if ($testimonialItems->isNotEmpty())
    <section id="testimonials" class="relative overflow-hidden bg-[#F6EFE4] py-24 lg:py-32">
        <div class="absolute -left-40 top-20 h-96 w-96 rounded-full bg-[#8A3F35]/10 blur-3xl"></div>
        <div class="absolute -right-40 bottom-10 h-96 w-96 rounded-full bg-[#C99A45]/10 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-14 grid gap-8 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                        {{ $homepage?->testimonials_eyebrow ?: 'Testimoni' }}
                    </p>

                    <h2
                        class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        {{ $homepage?->testimonials_title ?: 'Cerita client yang pernah bekerja sama.' }}
                    </h2>
                </div>

                <p class="text-base leading-8 text-[#7F756D]">
                    {{ $homepage?->testimonials_description ?: 'Pengalaman client, brand, dan komunitas bersama Bendo Jaya.' }}
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($testimonialItems as $testimonial)
                    <article
                        class="group relative overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#3C3B39]/10">
                        <div
                            class="absolute right-3 top-6 text-5xl text-[#F6EFE4] transition group-hover:text-[#E6D8C8]">
                            <i class="fa-solid fa-quote-right"></i>
                        </div>

                        <div class="relative pt-10">
                            <div class="mb-3 flex items-center justify-between">
                                <div class="flex gap-1 text-lg text-[#C99A45]">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa-solid fa-star {{ $i <= ($testimonial->rating ?? 5) ? '' : 'opacity-20' }}"></i>
                                    @endfor
                                </div>

                                @if ($testimonial->logo)
                                    <img src="{{ asset('storage/' . $testimonial->logo) }}"
                                        alt="{{ $testimonial->company_name ?: $testimonial->name }}"
                                        class="max-h-24 max-w-24 object-contain grayscale opacity-60 transition group-hover:grayscale-0 group-hover:opacity-100">
                                @endif
                            </div>

                            <p class="min-h-10 text-sm leading-7 text-[#58433D]">
                                “{{ $testimonial->message }}”
                            </p>

                            <div class="mt-8 flex items-center gap-4 border-t border-[#E6D8C8] pt-6">
                                <div
                                    class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-[#3C3B39] text-sm font-black text-[#FBE9CB] shadow-lg transition group-hover:scale-105">
                                    @if ($testimonial->photo)
                                        <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                            alt="{{ $testimonial->name }}" class="h-full w-full object-cover">
                                    @else
                                        {{ strtoupper(mb_substr($testimonial->name ?? 'C', 0, 1)) }}
                                    @endif
                                </div>

                                <div>
                                    <h3 class="font-black text-[#3C3B39]">
                                        {{ $testimonial->name ?: 'Client Bendo Jaya' }}
                                    </h3>

                                    <p class="mt-1 text-xs font-bold uppercase tracking-[0.15em] text-[#8A3F35]">
                                        {{ $testimonial->company_name ?: ($testimonial->position ?: 'Client') }}
                                    </p>

                                    @if ($testimonial->position && $testimonial->company_name)
                                        <p class="mt-1 text-xs font-semibold text-[#7F756D]">
                                            {{ $testimonial->position }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
