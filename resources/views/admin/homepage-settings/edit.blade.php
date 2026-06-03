@extends('layouts.admin')

@section('content')
    @php
        $valueItemsText = old(
            'value_items_text',
            $homepage->value_items
                ? json_encode($homepage->value_items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                : '',
        );

        $sectionFields = [
            'about' => [
                'label' => 'About',
                'image' => true,
                'button' => true,
            ],
            'services' => [
                'label' => 'Services',
            ],
            'collections' => [
                'label' => 'Collections',
            ],
            'gallery' => [
                'label' => 'Gallery',
            ],
            'partners' => [
                'label' => 'Partners',
                'image' => true,
            ],
            'testimonials' => [
                'label' => 'Testimonials',
            ],
            'articles' => [
                'label' => 'Articles',
            ],
            'faq' => [
                'label' => 'FAQ',
            ],
            'cta' => [
                'label' => 'CTA',
                'image' => true,
                'button' => true,
            ],
        ];
    @endphp

    <form action="{{ route('admin.homepage-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between gap-5">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            Hero
                        </p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">
                            Section Utama Landing Page
                        </h3>
                    </div>

                    <x-admin.form.toggle name="show_hero" label="Tampilkan" :checked="$homepage->show_hero" />
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <x-admin.form.input name="hero_eyebrow" label="Hero Eyebrow" :value="$homepage->hero_eyebrow" />

                    <x-admin.form.file name="hero_image" label="Hero Image" accept=".jpg,.jpeg,.png,.webp" :preview="$homepage->hero_image ? asset('storage/' . $homepage->hero_image) : null"
                        preview-alt="Hero Image" />

                    <div class="md:col-span-2">
                        <x-admin.form.input name="hero_title" label="Hero Title" :value="$homepage->hero_title" />
                    </div>

                    <div class="md:col-span-2">
                        <x-admin.form.textarea name="hero_subtitle" label="Hero Subtitle" :value="$homepage->hero_subtitle"
                            rows="3" />
                    </div>

                    <x-admin.form.input name="hero_primary_label" label="Primary Button Label" :value="$homepage->hero_primary_label" />

                    <x-admin.form.input name="hero_primary_url" label="Primary Button URL" :value="$homepage->hero_primary_url" />

                    <x-admin.form.input name="hero_secondary_label" label="Secondary Button Label" :value="$homepage->hero_secondary_label" />

                    <x-admin.form.input name="hero_secondary_url" label="Secondary Button URL" :value="$homepage->hero_secondary_url" />
                </div>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between gap-5">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                            Value Strip
                        </p>
                        <h3 class="mt-2 text-xl font-black text-stone-950">
                            Highlight Singkat
                        </h3>
                    </div>

                    <x-admin.form.toggle name="show_value_strip" label="Tampilkan" :checked="$homepage->show_value_strip" />
                </div>

                <x-admin.form.textarea name="value_items_text" label="Value Items JSON" :value="$valueItemsText" rows="10" />
            </section>

            @foreach ($sectionFields as $key => $section)
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <div class="mb-6 flex items-center justify-between gap-5">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                                {{ $section['label'] }}
                            </p>
                            <h3 class="mt-2 text-xl font-black text-stone-950">
                                Pengaturan Section {{ $section['label'] }}
                            </h3>
                        </div>

                        <x-admin.form.toggle name="show_{{ $key }}" label="Tampilkan" :checked="$homepage->{'show_' . $key}" />
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <x-admin.form.input name="{{ $key }}_eyebrow" label="Eyebrow" :value="$homepage->{$key . '_eyebrow'} ?? null" />

                        <x-admin.form.input name="{{ $key }}_title" label="Title" :value="$homepage->{$key . '_title'} ?? null" />

                        <div class="md:col-span-2">
                            <x-admin.form.textarea name="{{ $key }}_description" label="Description"
                                :value="$homepage->{$key . '_description'} ?? null" rows="3" />
                        </div>

                        @if ($section['image'] ?? false)
                            <div class="md:col-span-2">
                                <x-admin.form.file name="{{ $key }}_image" label="Image"
                                    accept=".jpg,.jpeg,.png,.webp" :preview="$homepage->{$key . '_image'}
                                        ? asset('storage/' . $homepage->{$key . '_image'})
                                        : null" preview-alt="Section Image" />
                            </div>
                        @endif

                        @if ($key === 'about')
                            <x-admin.form.input name="about_button_label" label="Button Label" :value="$homepage->about_button_label" />

                            <x-admin.form.input name="about_button_url" label="Button URL" :value="$homepage->about_button_url" />

                            <div class="md:col-span-2">
                                <x-admin.form.toggle name="show_about_button" label="Tampilkan Button About"
                                    :checked="$homepage->show_about_button" />
                            </div>
                        @endif

                        @if ($key === 'cta')
                            <x-admin.form.input name="cta_button_label" label="Button Label" :value="$homepage->cta_button_label" />

                            <x-admin.form.input name="cta_button_url" label="Button URL" :value="$homepage->cta_button_url" />
                        @endif
                    </div>
                </section>
            @endforeach

            <section class="rounded-[2rem] bg-stone-950 p-6">
                <x-admin.button variant="gold" class="w-full">
                    <i class="fa-solid fa-save"></i>
                    Simpan Homepage Settings
                </x-admin.button>
            </section>
        </div>
    </form>
@endsection
