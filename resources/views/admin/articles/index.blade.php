@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between">
        <p class="text-sm font-semibold text-stone-500">Total artikel: {{ $articles->total() }}</p>

        <a href="{{ route('admin.articles.create') }}"
            class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah Artikel
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Artikel</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Publish</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($articles as $article)
                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <div class="flex gap-4">
                                    <div class="h-20 w-24 shrink-0 overflow-hidden rounded-2xl bg-stone-200">
                                        @if ($article->featured_image)
                                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                class="h-full w-full object-cover" alt="{{ $article->title }}">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center bg-stone-950 text-xs font-black text-amber-200">
                                                BJ
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="font-black text-stone-950">{{ $article->title }}</h3>
                                        <a href="{{ route('articles.show', $article) }}" target="_blank"
                                            class="mt-1 inline-flex text-xs font-semibold text-amber-800">
                                            /articles/{{ $article->slug }}
                                        </a>
                                        <p class="mt-2 max-w-xl leading-6 text-stone-500">{{ $article->excerpt }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">{{ $article->category ?: '-' }}</td>
                            <td class="px-6 py-5">{{ $article->published_at?->format('d M Y H:i') ?: '-' }}</td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $article->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-500' }}">
                                    {{ $article->is_featured ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black {{ $article->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $article->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.articles.destroy', $faq) }}" method="POST"
                                        data-confirm-delete data-confirm-message="Artikel ini akan dihapus permanen.">
                                        @csrf
                                        @method('DELETE')

                                        <button class="rounded-xl bg-red-100 px-4 py-2 text-xs font-black text-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
