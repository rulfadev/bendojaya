    {{-- PARTNER --}}
    <section class="py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div
                class="grid overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-[#F6EFE4] lg:grid-cols-[1.1fr_0.9fr]">
                <div class="p-8 sm:p-12 lg:p-16">
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Kerja Sama</p>

                    <h2
                        class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        Terbuka untuk brand, komunitas, dan kebutuhan custom.
                    </h2>

                    <p class="mt-6 text-base leading-8 text-[#7F756D]">
                        Bendo Jaya dapat menjadi partner untuk kebutuhan koleksi fashion, custom pakaian batik, seragam
                        komunitas, maupun pengembangan produk bersama brand.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        @foreach (['Fashion Brand', 'Komunitas', 'Instansi', 'Custom Production'] as $item)
                            <span
                                class="rounded-full border border-[#D8C5AF] bg-white/70 px-5 py-2 text-xs font-black uppercase tracking-[0.18em] text-[#765A4F]">
                                {{ $item }}
                            </span>
                        @endforeach
                    </div>

                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                        class="mt-10 inline-flex rounded-full bg-[#3C3B39] px-8 py-4 text-sm font-black text-[#FBE9CB] transition hover:bg-[#58433D]">
                        Ajukan Kerja Sama
                    </a>
                </div>

                <div class="relative min-h-[420px]">
                    <img src="{{ $heroImage }}" alt="Kerja sama Bendo Jaya"
                        class="absolute inset-0 h-full w-full object-cover object-right">
                </div>
            </div>
        </div>
    </section>
