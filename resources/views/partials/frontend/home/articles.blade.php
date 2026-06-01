    {{-- ARTICLES --}}
    <section id="articles" class="bg-[#FFF8ED] pb-24 lg:pb-32">
        <div class="mx-auto max-w-7xl border-t border-[#E6D8C8] px-5 pt-20 lg:px-8">
            <div class="mb-12 max-w-2xl">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Artikel</p>
                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    Cerita, inspirasi, dan edukasi batik.
                </h2>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                @foreach ($articles as $article)
                    <article
                        class="grid overflow-hidden rounded-[2rem] border border-[#E6D8C8] bg-white shadow-sm sm:grid-cols-[0.85fr_1.15fr]">
                        <img src="{{ $heroImage }}" alt="{{ $article }}"
                            class="h-72 w-full object-cover {{ $loop->first ? 'object-left' : 'object-right' }} sm:h-full">

                        <div class="p-7">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">Batik Insight</p>

                            <h3 class="mt-4 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#3C3B39]">
                                {{ $article }}
                            </h3>

                            <p class="mt-4 text-sm leading-7 text-[#7F756D]">
                                Inspirasi singkat seputar batik, gaya berpakaian, dan cara menjaga koleksi tetap indah.
                            </p>

                            <a href="#" class="mt-6 inline-flex text-sm font-black text-[#8A3F35]">
                                Baca Artikel →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
