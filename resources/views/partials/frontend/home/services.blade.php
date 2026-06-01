    {{-- SERVICES --}}
    <section id="services" class="bg-[#F6EFE4] py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Layanan</p>
                    <h2
                        class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                        Bukan hanya menjual koleksi, kami membangun cerita lewat batik.
                    </h2>
                </div>

                <p class="text-base leading-8 text-[#7F756D]">
                    Website ini menjadi ruang untuk menampilkan karya, koleksi, gallery, artikel, dan peluang kerja
                    sama.
                    E-commerce dapat dikembangkan setelah fondasi brand dan katalog visualnya matang.
                </p>
            </div>

            <div class="mt-14 divide-y divide-[#D8C5AF] border-y border-[#D8C5AF]">
                @foreach ($services as $service)
                    <div class="grid gap-5 py-8 sm:grid-cols-[120px_1fr_auto] sm:items-center">
                        <p class="font-['Playfair_Display'] text-4xl font-black text-[#C99A4A]">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </p>

                        <h3 class="text-2xl font-black text-[#3C3B39]">
                            {{ $service }}
                        </h3>

                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                            class="inline-flex text-sm font-black text-[#8A3F35] transition hover:text-[#3C3B39]">
                            Konsultasi →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
