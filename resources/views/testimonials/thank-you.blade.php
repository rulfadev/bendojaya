@extends('layouts.frontend')

@section('content')
    <section class="flex min-h-[70vh] items-center bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-3xl px-5 text-center lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">Terima Kasih</p>
            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black">Testimoni berhasil dikirim.</h1>
            <p class="mt-6 text-sm leading-7 text-[#E6D8C8]">
                Testimoni Anda akan kami review terlebih dahulu sebelum ditampilkan.
            </p>

            <a href="{{ route('home') }}"
                class="mt-8 inline-flex rounded-full bg-[#FBE9CB] px-8 py-4 text-sm font-black text-[#3C3B39]">
                Kembali ke Beranda
            </a>
        </div>
    </section>
@endsection
