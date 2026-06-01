    {{-- GALLERY --}}
    <section id="gallery" class="bg-[#3C3B39] py-24 text-[#FBE9CB] lg:py-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-14 grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Gallery</p>
                    <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight sm:text-5xl">
                        Detail motif, koleksi, dan cerita visual Bendo Jaya.
                    </h2>
                </div>

                <p class="text-sm leading-7 text-[#E6D8C8]">
                    Gallery menjadi ruang untuk memperlihatkan detail produk, dokumentasi pemotretan, dan proses kreatif
                    yang membentuk karakter Bendo Jaya Batik Fashion.
                </p>
            </div>

            <div class="grid gap-5 md:grid-cols-4">
                <div class="md:col-span-2">
                    <img src="{{ $heroImage }}" alt="Gallery Bendo Jaya"
                        class="h-[520px] w-full rounded-[2.5rem] object-cover object-left">
                </div>

                <div class="space-y-5">
                    <img src="{{ $heroImage }}" alt="Gallery Bendo Jaya"
                        class="h-[250px] w-full rounded-[2rem] object-cover object-center">

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-7">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-[#EEBDB5]">Visual Identity</p>
                        <p class="mt-4 font-['Playfair_Display'] text-2xl font-black leading-tight text-[#FBE9CB]">
                            Batik yang terasa lembut, hangat, dan mudah dikenakan.
                        </p>
                    </div>
                </div>

                <div>
                    <img src="{{ $heroImage }}" alt="Gallery Bendo Jaya"
                        class="h-[520px] w-full rounded-[2.5rem] object-cover object-right">
                </div>
            </div>
        </div>
    </section>
