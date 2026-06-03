@php
    $valueItems = collect(
        $homepage?->value_items ?? [
            ['title' => 'Batik Fashion', 'description' => 'Koleksi pakaian batik berkarakter.'],
            ['title' => 'Custom Produksi', 'description' => 'Untuk brand, komunitas, dan instansi.'],
            ['title' => 'Kerja Sama', 'description' => 'Kolaborasi produk dan seragam batik.'],
        ],
    );
@endphp

<section class="bg-[#3C3B39] py-10 text-[#FBE9CB]">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div
            class="grid overflow-hidden rounded-[2rem] border border-[#FBE9CB]/15 bg-[#FBE9CB]/8 backdrop-blur md:grid-cols-3">
            @foreach ($valueItems as $item)
                <div class="border-b border-[#FBE9CB]/15 p-7 md:border-b-0 md:border-r last:md:border-r-0">
                    <h3 class="font-['Playfair_Display'] text-2xl font-black">
                        {{ data_get($item, 'title', 'Bendo Jaya') }}
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-[#E6D8C8]">
                        {{ data_get($item, 'description', 'Batik fashion dengan karakter hangat dan elegan.') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
