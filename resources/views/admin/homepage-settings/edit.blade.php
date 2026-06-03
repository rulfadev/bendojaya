@extends('layouts.admin')

@section('content')
    @php
        $inputClass =
            'w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-800 outline-none transition focus:border-stone-950 focus:ring-4 focus:ring-amber-200';
        $labelClass = 'mb-2 block text-sm font-black text-stone-800';
        $cardClass = 'rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm';
        $valueItemsText = old(
            'value_items_text',
            $homepage->value_items
                ? json_encode($homepage->value_items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                : '',
        );
    @endphp

    <form action="{{ route('admin.homepage-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <section class="{{ $cardClass }}">
                <label class="mb-6 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black">Tampilkan Hero</span>
                    <input type="checkbox" name="show_hero" value="1" @checked(old('show_hero', $homepage->show_hero))>
                </label>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="{{ $labelClass }}">Hero Eyebrow</label>
                        <input name="hero_eyebrow" value="{{ old('hero_eyebrow', $homepage->hero_eyebrow) }}"
                            class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">Hero Image</label>
                        <input type="file" name="hero_image" class="{{ $inputClass }}">
                    </div>

                    <div class="md:col-span-2">
                        <label class="{{ $labelClass }}">Hero Title</label>
                        <input name="hero_title" value="{{ old('hero_title', $homepage->hero_title) }}"
                            class="{{ $inputClass }}">
                    </div>

                    <div class="md:col-span-2">
                        <label class="{{ $labelClass }}">Hero Subtitle</label>
                        <textarea name="hero_subtitle" rows="3" class="{{ $inputClass }}">{{ old('hero_subtitle', $homepage->hero_subtitle) }}</textarea>
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">Primary Button Label</label>
                        <input name="hero_primary_label"
                            value="{{ old('hero_primary_label', $homepage->hero_primary_label) }}"
                            class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">Primary Button URL</label>
                        <input name="hero_primary_url" value="{{ old('hero_primary_url', $homepage->hero_primary_url) }}"
                            class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">Secondary Button Label</label>
                        <input name="hero_secondary_label"
                            value="{{ old('hero_secondary_label', $homepage->hero_secondary_label) }}"
                            class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">Secondary Button URL</label>
                        <input name="hero_secondary_url"
                            value="{{ old('hero_secondary_url', $homepage->hero_secondary_url) }}"
                            class="{{ $inputClass }}">
                    </div>
                </div>
            </section>

            <section class="{{ $cardClass }}">
                <label
                    class="mb-6 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                    <span class="text-sm font-black">Tampilkan Value Strip</span>
                    <input type="checkbox" name="show_value_strip" value="1" @checked(old('show_value_strip', $homepage->show_value_strip))>
                </label>

                <label class="{{ $labelClass }}">Value Items JSON</label>
                <textarea name="value_items_text" rows="10" class="{{ $inputClass }}">{{ $valueItemsText }}</textarea>
            </section>

            @foreach ([
            'about' => 'About',
            'services' => 'Services',
            'collections' => 'Collections',
            'gallery' => 'Gallery',
            'partners' => 'Partners',
            'testimonials' => 'Testimonials',
            'articles' => 'Articles',
            'cta' => 'CTA',
        ] as $key => $sectionLabel)
                <section class="{{ $cardClass }}">
                    <label
                        class="mb-6 flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                        <span class="text-sm font-black">Tampilkan {{ $sectionLabel }}</span>
                        <input type="checkbox" name="show_{{ $key }}" value="1" @checked(old('show_' . $key, $homepage->{'show_' . $key}))>
                    </label>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="{{ $labelClass }}">Eyebrow</label>
                            <input name="{{ $key }}_eyebrow"
                                value="{{ old($key . '_eyebrow', $homepage->{$key . '_eyebrow'} ?? null) }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Title</label>
                            <input name="{{ $key }}_title"
                                value="{{ old($key . '_title', $homepage->{$key . '_title'} ?? null) }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Description</label>
                            <textarea name="{{ $key }}_description" rows="3" class="{{ $inputClass }}">{{ old($key . '_description', $homepage->{$key . '_description'} ?? null) }}</textarea>
                        </div>

                        @if (in_array($key, ['about', 'partners', 'cta']))
                            <div>
                                <label class="{{ $labelClass }}">Image</label>
                                <input type="file" name="{{ $key }}_image" class="{{ $inputClass }}">
                            </div>
                        @endif

                        @if ($key === 'about')
                            <div>
                                <label class="{{ $labelClass }}">Button Label</label>
                                <input name="about_button_label"
                                    value="{{ old('about_button_label', $homepage->about_button_label) }}"
                                    class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Button URL</label>
                                <input name="about_button_url"
                                    value="{{ old('about_button_url', $homepage->about_button_url) }}"
                                    class="{{ $inputClass }}">
                            </div>

                            <label
                                class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
                                <span class="text-sm font-black">Tampilkan Button About</span>
                                <input type="checkbox" name="show_about_button" value="1" @checked(old('show_about_button', $homepage->show_about_button))>
                            </label>
                        @endif

                        @if ($key === 'cta')
                            <div>
                                <label class="{{ $labelClass }}">Button Label</label>
                                <input name="cta_button_label"
                                    value="{{ old('cta_button_label', $homepage->cta_button_label) }}"
                                    class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Button URL</label>
                                <input name="cta_button_url" value="{{ old('cta_button_url', $homepage->cta_button_url) }}"
                                    class="{{ $inputClass }}">
                            </div>
                        @endif
                    </div>
                </section>
            @endforeach

            <section class="rounded-[2rem] bg-stone-950 p-6">
                <button class="w-full rounded-2xl bg-amber-300 px-5 py-4 text-sm font-black text-stone-950">
                    Simpan Homepage Settings
                </button>
            </section>
        </div>
    </form>
@endsection
