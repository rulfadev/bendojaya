@php
    $partnerItems = collect($partners ?? []);
@endphp

<section class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div
            class="grid overflow-hidden rounded-[2.5rem] border border-[#E6D8C8] bg-[#F6EFE4] lg:grid-cols-[1.1fr_0.9fr]">
            <div class="p-8 sm:p-12 lg:p-16">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-[#8A3F35]">Kerja Sama</p>

                <h2 class="mt-5 font-['Playfair_Display'] text-4xl font-black leading-tight text-[#3C3B39] sm:text-5xl">
                    Terbuka untuk brand, komunitas, dan kebutuhan custom.
                </h2>

                <p class="mt-6 text-base leading-8 text-[#7F756D]">
                    Bendo Jaya dapat menjadi partner untuk kebutuhan koleksi fashion, custom pakaian batik, seragam
                    komunitas, maupun pengembangan produk bersama brand.
                </p>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    @forelse ($partnerItems as $partner)
                        <div class="rounded-3xl border border-[#D8C5AF] bg-white/70 p-5">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#3C3B39] text-xs font-black text-[#FBE9CB]">
                                    @if ($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                            class="h-full w-full rounded-2xl object-cover">
                                    @else
                                        BJ
                                    @endif
                                </div>

                                <div>
                                    <h3 class="font-black text-[#3C3B39]">{{ $partner->name }}</h3>
                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8A3F35]">
                                        {{ $partner->category ?: 'Partner' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        @foreach (['Fashion Brand', 'Komunitas', 'Instansi', 'Custom Production'] as $item)
                            <span
                                class="rounded-full border border-[#D8C5AF] bg-white/70 px-5 py-3 text-xs font-black uppercase tracking-[0.18em] text-[#765A4F]">
                                {{ $item }}
                            </span>
                        @endforeach
                    @endforelse
                </div>

                <x-frontend.consultation-link label="Ajukan Kerja Sama" class="mt-10" />
            </div>

            <div class="relative min-h-[420px]">
                <img src="{{ asset('assets/frontend/hero-product.jpg') }}" alt="Kerja sama Bendo Jaya"
                    class="absolute inset-0 h-full w-full object-cover object-right">
            </div>
        </div>
    </div>
</section>
