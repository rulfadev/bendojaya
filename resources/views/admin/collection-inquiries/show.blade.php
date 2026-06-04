@extends('layouts.admin')

@section('content')
    <div class="grid gap-8 xl:grid-cols-3">
        <div class="space-y-8 xl:col-span-2">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Detail Inquiry
                </p>

                <h3 class="mt-3 text-2xl font-black text-stone-950">
                    {{ $inquiry->name }}
                </h3>

                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    <div>
                        <p class="font-black text-stone-950">Koleksi</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->collection?->name ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Kategori Koleksi</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->collection?->category ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">WhatsApp</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->phone }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Email</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->email ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Kebutuhan</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->need_type_label }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Ukuran</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->size ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Jumlah</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->quantity ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Tanggal Masuk</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->created_at?->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-8 rounded-[1.5rem] border border-stone-200 bg-white p-5">
                    <p class="font-black text-stone-950">Pesan</p>
                    <p class="mt-3 whitespace-pre-line text-sm leading-7 text-stone-600">
                        {{ $inquiry->message ?: '-' }}
                    </p>
                </div>
            </section>
        </div>

        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Follow Up
                </p>

                <form action="{{ route('admin.collection-inquiries.destroy', $inquiry) }}" method="POST"
                    data-confirm-delete data-confirm-message="Inquiry ini akan dihapus permanen." class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.select name="status" label="Status">
                        @foreach (\App\Models\CollectionInquiry::STATUSES as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $inquiry->status) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </x-admin.form.select>

                    <x-admin.form.textarea name="follow_up_note" label="Catatan Follow Up" :value="$inquiry->follow_up_note"
                        rows="5" />

                    <x-admin.button class="w-full">
                        <i class="fa-solid fa-save"></i>
                        Simpan Status
                    </x-admin.button>
                </form>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-sm">
                <x-admin.link-button :href="route('admin.collection-inquiries.index')" variant="light" class="w-full">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </x-admin.link-button>

                <x-admin.link-button :href="$inquiry->whatsapp_url" variant="gold" target="_blank" class="mt-3 w-full">
                    <i class="fa-brands fa-whatsapp"></i>
                    Balas via WhatsApp
                </x-admin.link-button>

                <x-admin.link-button :href="route('admin.quotations.create', ['collection_inquiry_id' => $inquiry->id])" class="mt-3 w-full">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Buat Penawaran
                </x-admin.link-button>
            </section>

            <form action="{{ route('admin.collection-inquiries.destroy', $inquiry) }}" method="POST"
                onsubmit="return confirm('Yakin hapus inquiry ini?')">
                @csrf
                @method('DELETE')

                <x-admin.button variant="danger" class="w-full">
                    <i class="fa-solid fa-trash"></i>
                    Hapus Inquiry
                </x-admin.button>
            </form>
        </div>
    </div>
@endsection
