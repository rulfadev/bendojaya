    {{-- HERO --}}
    <section id="home" class="relative min-h-[calc(100vh-80px)] overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: linear-gradient(90deg, rgba(60, 59, 57, 0.92) 0%, rgba(60, 59, 57, 0.72) 42%, rgba(60, 59, 57, 0.28) 100%), url('{{ $heroImage }}');">
        </div>

        <div class="absolute inset-0 opacity-[0.12]"
            style="background-image: radial-gradient(circle at 1px 1px, #FBE9CB 1px, transparent 0); background-size: 28px 28px;">
        </div>

        <div class="relative mx-auto flex min-h-[calc(100vh-80px)] max-w-7xl items-center px-5 py-24 lg:px-8">
            <div class="max-w-3xl">
                <div
                    class="mb-8 inline-flex rounded-full border border-[#FBE9CB]/25 bg-[#FBE9CB]/10 px-5 py-2 text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5] backdrop-blur">
                    Bendo Jaya Batik Fashion
                </div>

                <h1
                    class="font-['Playfair_Display'] text-5xl font-black leading-[1.05] tracking-tight text-[#FBE9CB] sm:text-6xl lg:text-7xl">
                    Batik Elegan untuk Gaya yang Lebih Berkarakter.
                </h1>

                <p class="mt-7 max-w-2xl text-base leading-8 text-[#E6D8C8] sm:text-lg">
                    Koleksi batik wanita dengan sentuhan tradisional, warna hangat, dan desain nyaman untuk daily wear,
                    custom seragam, maupun kerja sama brand fashion.
                </p>

                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#collection"
                        class="inline-flex justify-center rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39] shadow-xl shadow-black/10 transition hover:-translate-y-1 hover:bg-white">
                        Lihat Koleksi
                    </a>

                    <x-frontend.consultation-link label="Konsultasi Kerja Sama" variant="outline-light" />
                </div>

                <div class="mt-14 grid max-w-2xl gap-4 border-t border-[#FBE9CB]/20 pt-8 sm:grid-cols-3">
                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black text-[#FBE9CB]">100+</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">Koleksi</p>
                    </div>

                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black text-[#FBE9CB]">Custom</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">Produksi</p>
                    </div>

                    <div>
                        <p class="font-['Playfair_Display'] text-3xl font-black text-[#FBE9CB]">Brand</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-[#EEBDB5]">Partner</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
