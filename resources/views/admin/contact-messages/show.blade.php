@extends('layouts.admin')

@section('content')
    <div class="grid gap-8 xl:grid-cols-3">
        <div class="xl:col-span-2">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Pesan
                </p>

                <h3 class="mt-3 text-2xl font-black text-stone-950">
                    {{ $message->subject ?: 'Tanpa subjek' }}
                </h3>

                <div class="mt-6 rounded-3xl bg-white p-6 text-sm leading-7 text-stone-700">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </section>
        </div>

        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Pengirim
                </p>

                <div class="mt-5 space-y-4 text-sm">
                    <div>
                        <p class="font-black text-stone-950">Nama</p>
                        <p class="mt-1 text-stone-600">{{ $message->name }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Email</p>
                        <p class="mt-1 text-stone-600">{{ $message->email ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Telepon / WhatsApp</p>
                        <p class="mt-1 text-stone-600">{{ $message->phone ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Tanggal</p>
                        <p class="mt-1 text-stone-600">{{ $message->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Source URL</p>
                        <p class="mt-1 break-all text-stone-600">{{ $message->source_url ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Dihubungi</p>
                        <p class="mt-1 text-stone-600">{{ $message->contacted_at?->format('d M Y H:i') ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="font-black text-stone-950">Selesai</p>
                        <p class="mt-1 text-stone-600">{{ $message->completed_at?->format('d M Y H:i') ?: '-' }}</p>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                    Follow Up
                </p>

                <form action="{{ route('admin.contact-messages.status', $message) }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.select name="status" label="Status">
                        @foreach (\App\Models\ContactMessage::STATUSES as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $message->status) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </x-admin.form.select>

                    <x-admin.form.textarea name="follow_up_note" label="Catatan Follow Up" :value="$message->follow_up_note" rows="5"
                        placeholder="Contoh: Sudah dibalas via WhatsApp, menunggu konfirmasi ukuran." />

                    <x-admin.button class="w-full">
                        <i class="fa-solid fa-save"></i>
                        Simpan Status
                    </x-admin.button>
                </form>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-stone-950 p-6 shadow-sm">
                <x-admin.link-button :href="route('admin.contact-messages.index')" variant="light" class="w-full">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </x-admin.link-button>

                @if ($message->phone)
                    <x-admin.link-button href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}"
                        variant="gold" target="_blank" class="mt-3 w-full">
                        <i class="fa-brands fa-whatsapp"></i>
                        Balas via WhatsApp
                    </x-admin.link-button>
                @endif

                @if ($message->email)
                    <x-admin.link-button href="mailto:{{ $message->email }}" variant="light" class="mt-3 w-full">
                        <i class="fa-solid fa-envelope"></i>
                        Balas via Email
                    </x-admin.link-button>
                @endif
            </section>
        </div>
    </div>
@endsection
