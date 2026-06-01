    {{-- FEATURED COLLECTION --}}
    <section id="collection" class="py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-14 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Koleksi Pilihan</p>
                    <h2
                        class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        Koleksi batik dengan warna hangat dan motif berkarakter.
                    </h2>
                </div>

                <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                    class="inline-flex rounded-full border border-[#765A4F] px-7 py-4 text-sm font-black text-[#765A4F] transition hover:bg-[#765A4F] hover:text-white">
                    Tanya Koleksi
                </a>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                @foreach ($collections as $collection)
                    <article class="group">
                        <div class="overflow-hidden rounded-[2.5rem] bg-[#F6EFE4] p-3">
                            <img src="{{ $heroImage }}" alt="{{ $collection['name'] }}"
                                class="h-[520px] w-full rounded-[2rem] object-cover transition duration-700 group-hover:scale-105
                                 {{ $loop->iteration === 1 ? 'object-left' : ($loop->iteration === 2 ? 'object-center' : 'object-right') }}">
                        </div>

                        <div class="pt-6">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-[#8A3F35]">
                                {{ $collection['category'] }}
                            </p>

                            <h3 class="mt-3 font-['Playfair_Display'] text-3xl font-black text-[#3C3B39]">
                                {{ $collection['name'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-7 text-[#7F756D]">
                                {{ $collection['desc'] }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
