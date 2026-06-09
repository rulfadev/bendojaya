@extends('layouts.admin')

@section('content')
    <div class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-5 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left">
                <thead>
                    <tr class="border-b border-stone-200 text-xs uppercase tracking-[0.2em] text-stone-400">
                        <th class="px-4 py-3">Konten</th>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-4 py-4">
                                <p class="font-black text-stone-950">
                                    {{ $item->{$config['title_field']} ?? 'Untitled' }}
                                </p>
                            </td>

                            <td class="px-4 py-4 text-sm font-semibold text-stone-500">
                                #{{ $item->id }}
                            </td>

                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.translations.edit', [$resource, $item->id, 'en']) }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-stone-950 px-4 py-2 text-xs font-black text-amber-200">
                                    <i class="fa-solid fa-language"></i>
                                    Translate EN
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-10 text-center text-sm font-semibold text-stone-500">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $items->links() }}
        </div>
    </div>
@endsection
