@extends('layouts.admin')

@section('content')
    <div class="grid gap-8 xl:grid-cols-3">
        <div class="space-y-8 xl:col-span-2">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Detail Inquiry Kerja Sama
                </p>

                <h3 class="mt-3 text-2xl font-black text-stone-950">
                    {{ $inquiry->company_name ?: 'Kerja Sama Bendo Jaya' }}
                </h3>

                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    <div>
                        <p class="font-black text-stone-950">Perusahaan / Brand</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->company_name ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">PIC</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->pic_name }}</p>
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
                        <p class="font-black text-stone-950">Jenis Kerja Sama</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->partnership_type_label }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Estimasi Jumlah</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->estimated_quantity ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Budget</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->budget_range ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Deadline</p>
                        <p class="mt-1 text-stone-600">{{ $inquiry->deadline_date?->format('d M Y') ?: '-' }}</p>
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

                <form action="{{ route('admin.partnership-inquiries.status', $inquiry) }}" method="POST"
                    class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.select name="status" label="Status">
                        @foreach (\App\Models\PartnershipInquiry::STATUSES as $value => $label)
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
                <x-admin.link-button :href="route('admin.partnership-inquiries.index')" variant="light" class="w-full">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </x-admin.link-button>

                <x-admin.link-button :href="$inquiry->whatsapp_url" variant="gold" target="_blank" class="mt-3 w-full">
                    <i class="fa-brands fa-whatsapp"></i>
                    Balas via WhatsApp
                </x-admin.link-button>
            </section>

            <form action="{{ route('admin.partnership-inquiries.destroy', $inquiry) }}" method="POST"
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
