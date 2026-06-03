<div class="grid gap-8 xl:grid-cols-3">
    <div class="space-y-8 xl:col-span-2">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <div class="grid gap-5 md:grid-cols-2">
                <x-admin.form.input name="label" label="Label Menu" :value="$menu->label" />

                <x-admin.form.select name="type" label="Tipe Link">
                    @foreach (\App\Models\NavigationMenu::TYPES as $value => $label)
                        <option value="{{ $value }}" @selected(old('type', $menu->type) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </x-admin.form.select>

                <div class="md:col-span-2">
                    <x-admin.form.input name="url" label="Custom URL" :value="$menu->url"
                        placeholder="/articles atau https://..." />
                </div>

                <x-admin.form.select name="page_id" label="Custom Page">
                    <option value="">Pilih page</option>

                    @foreach ($pages as $page)
                        <option value="{{ $page->id }}" @selected((int) old('page_id', $menu->page_id) === $page->id)>
                            {{ $page->title }}
                        </option>
                    @endforeach
                </x-admin.form.select>

                <x-admin.form.select name="article_id" label="Artikel">
                    <option value="">Pilih artikel</option>

                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}" @selected((int) old('article_id', $menu->article_id) === $article->id)>
                            {{ $article->title }}
                        </option>
                    @endforeach
                </x-admin.form.select>

                <x-admin.form.input name="anchor" label="Anchor" :value="$menu->anchor"
                    placeholder="home / about / services / contact" />

                <x-admin.form.input name="sort_order" label="Urutan" type="number" :value="$menu->sort_order" min="0" />
            </div>
        </section>
    </div>

    <div class="space-y-8">
        <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
            <x-admin.form.select name="position" label="Posisi">
                @foreach (\App\Models\NavigationMenu::POSITIONS as $value => $label)
                    <option value="{{ $value }}" @selected(old('position', $menu->position) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-admin.form.select>

            <div class="mt-5">
                <x-admin.form.select name="target" label="Target">
                    @foreach (\App\Models\NavigationMenu::TARGETS as $value => $label)
                        <option value="{{ $value }}" @selected(old('target', $menu->target) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </x-admin.form.select>
            </div>

            <div class="mt-5">
                <x-admin.form.toggle name="is_active" label="Aktif" :checked="$menu->is_active ?? true" />
            </div>
        </section>

        <x-admin.button class="w-full">
            <i class="fa-solid fa-save"></i>
            Simpan Menu
        </x-admin.button>
    </div>
</div>
