@php
    $inputClass =
        'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
    $labelClass = 'mb-2 block text-sm font-black text-stone-800';
    $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
@endphp

<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="{{ $cardClass }}">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Label Menu</label>
                    <input type="text" name="label" value="{{ old('label', $menu->label) }}"
                        class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Tipe Link</label>
                    <select name="type" class="{{ $inputClass }}">
                        @foreach (\App\Models\NavigationMenu::TYPES as $value => $label)
                            <option value="{{ $value }}" @selected(old('type', $menu->type) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Custom URL</label>
                    <input type="text" name="url" value="{{ old('url', $menu->url) }}"
                        class="{{ $inputClass }}" placeholder="/articles atau https://...">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Custom Page</label>
                    <select name="page_id" class="{{ $inputClass }}">
                        <option value="">Pilih page</option>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}" @selected((int) old('page_id', $menu->page_id) === $page->id)>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="{{ $labelClass }}">Artikel</label>
                    <select name="article_id" class="{{ $inputClass }}">
                        <option value="">Pilih artikel</option>
                        @foreach ($articles as $article)
                            <option value="{{ $article->id }}" @selected((int) old('article_id', $menu->article_id) === $article->id)>
                                {{ $article->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="{{ $labelClass }}">Anchor</label>
                    <input type="text" name="anchor" value="{{ old('anchor', $menu->anchor) }}"
                        class="{{ $inputClass }}" placeholder="about / services / contact">
                </div>

                <div>
                    <label class="{{ $labelClass }}">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order) }}"
                        class="{{ $inputClass }}" min="0">
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="{{ $cardClass }}">
            <label class="{{ $labelClass }}">Posisi</label>
            <select name="position" class="{{ $inputClass }}">
                @foreach (\App\Models\NavigationMenu::POSITIONS as $value => $label)
                    <option value="{{ $value }}" @selected(old('position', $menu->position) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <label class="{{ $labelClass }} mt-5">Target</label>
            <select name="target" class="{{ $inputClass }}">
                @foreach (\App\Models\NavigationMenu::TARGETS as $value => $label)
                    <option value="{{ $value }}" @selected(old('target', $menu->target) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <label
                class="mt-5 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                <span class="text-sm font-black">Aktif</span>
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $menu->is_active))>
            </label>
        </section>

        <button type="submit" class="w-full rounded-2xl bg-stone-950 px-5 py-3.5 text-sm font-black text-amber-200">
            Simpan
        </button>
    </div>
</div>
