@php
    $testimonialItems = collect($testimonials ?? []);
@endphp

@if ($testimonialItems->isNotEmpty())
    <section id="testimonials" class="bg-[#F6EFE4] py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-12 max-w-3xl">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">
                    {{ $homepage?->testimonials_eyebrow ?: 'Testimoni' }}
                </p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    {{ $homepage?->testimonials_title ?: 'Cerita client yang pernah bekerja sama.' }}
                </h2>

                @if ($homepage?->testimonials_description)
                    <p class="mt-5 text-base leading-8 text-[#7F756D]">
                        {{ $homepage->testimonials_description }}
                    </p>
                @endif
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($testimonialItems as $testimonial)
                    <article class="rounded-[2rem] border border-[#E6D8C8] bg-white p-7 shadow-sm">
                        <div class="text-lg text-[#C99A45]">
                            {{ str_repeat('★', $testimonial->rating ?? 5) }}
                        </div>

                        <p class="mt-5 text-sm leading-7 text-[#58433D]">
                            “{{ $testimonial->message }}”
                        </p>

                        <div class="mt-7 flex items-center gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-2xl bg-[#3C3B39] text-sm font-black text-[#FBE9CB]">
                                @if ($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                        alt="{{ $testimonial->name }}" class="h-full w-full object-cover">
                                @else
                                    {{ strtoupper(mb_substr($testimonial->name ?? 'C', 0, 1)) }}
                                @endif
                            </div>

                            <div>
                                <h3 class="font-black text-[#3C3B39]">{{ $testimonial->name }}</h3>
                                <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8A3F35]">
                                    {{ $testimonial->company_name ?: $testimonial->position }}
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
