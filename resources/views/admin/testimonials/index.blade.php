@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between">
        <p class="text-sm font-semibold text-stone-500">Total testimoni: {{ $testimonials->total() }}</p>

        <a href="{{ route('admin.testimonials.create') }}"
            class="rounded-2xl bg-stone-950 px-5 py-3 text-sm font-black text-amber-200">
            Tambah / Buat Link
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-[#fbf7ef] shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1100px] text-left text-sm">
                <thead
                    class="border-b border-stone-200 bg-[#f6efe4] text-xs font-black uppercase tracking-[0.18em] text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Rating</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Link Form</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-200">
                    @forelse ($testimonials as $testimonial)
                        <tr class="align-top">
                            <td class="px-6 py-5">
                                <h3 class="font-black text-stone-950">{{ $testimonial->name ?: 'Belum diisi' }}</h3>
                                <p class="mt-1 text-xs font-semibold text-stone-500">{{ $testimonial->company_name ?: '-' }}
                                </p>
                                <p class="mt-2 max-w-xl leading-6 text-stone-500">
                                    {{ str($testimonial->message)->limit(120) }}</p>
                            </td>

                            <td class="px-6 py-5">
                                {{ $testimonial->rating ? str_repeat('★', $testimonial->rating) : '-' }}
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-black
                                    {{ $testimonial->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($testimonial->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-800') }}">
                                    {{ \App\Models\Testimonial::STATUSES[$testimonial->status] ?? $testimonial->status }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <input type="text" readonly value="{{ route('testimonial-form.show', $testimonial) }}"
                                    class="w-80 rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs text-stone-600">
                            </td>

                            <td class="px-6 py-5">
                                {{ $testimonial->is_featured ? 'Ya' : 'Tidak' }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    @if ($testimonial->status !== 'approved')
                                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="rounded-xl bg-emerald-100 px-4 py-2 text-xs font-black text-emerald-700">
                                                Approve
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                        class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-black text-stone-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                        data-confirm-delete data-confirm-message="Testimoni ini akan dihapus permanen.">
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
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada testimoni.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-stone-200 px-6 py-4">
            {{ $testimonials->links() }}
        </div>
    </div>
@endsection
