@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.seo-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid gap-8 xl:grid-cols-3">
            <div class="space-y-8 xl:col-span-2">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Default Meta
                    </p>

                    <div class="mt-6 grid gap-5">
                        <x-admin.form.input name="default_meta_title" label="Default Meta Title" :value="$seo->default_meta_title" />

                        <x-admin.form.textarea name="default_meta_description" label="Default Meta Description"
                            :value="$seo->default_meta_description" rows="3" />

                        <x-admin.form.textarea name="default_meta_keywords" label="Default Meta Keywords" :value="$seo->default_meta_keywords"
                            rows="3" />

                        <x-admin.form.file name="default_og_image" label="Default OG Image" accept=".jpg,.jpeg,.png,.webp"
                            :preview="$seo->default_og_image ? asset('storage/' . $seo->default_og_image) : null" preview-alt="Default OG Image" />
                    </div>
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Organization Schema
                    </p>

                    <div class="mt-6 grid gap-5 md:grid-cols-2">
                        <x-admin.form.input name="organization_name" label="Organization Name" :value="$seo->organization_name" />

                        <x-admin.form.input name="organization_type" label="Schema Type" :value="$seo->organization_type"
                            placeholder="Organization / ClothingStore" />

                        <x-admin.form.input name="same_as_instagram" label="Instagram URL" type="url"
                            :value="$seo->same_as_instagram" />

                        <x-admin.form.input name="same_as_tiktok" label="TikTok URL" type="url" :value="$seo->same_as_tiktok" />

                        <div class="md:col-span-2">
                            <x-admin.form.file name="organization_logo" label="Organization Logo"
                                accept=".jpg,.jpeg,.png,.webp,.svg" :preview="$seo->organization_logo ? asset('storage/' . $seo->organization_logo) : null" preview-alt="Organization Logo" />
                        </div>
                    </div>
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Robots & AI Search
                    </p>

                    <div class="mt-6 grid gap-5">
                        <x-admin.form.textarea name="robots_extra_rules" label="Robots Extra Rules" :value="$seo->robots_extra_rules"
                            rows="6" placeholder="Disallow: /private" />

                        <x-admin.form.textarea name="llms_txt_content" label="LLMS.txt Content" :value="$seo->llms_txt_content"
                            rows="8" placeholder="Ringkasan website untuk AI crawler." />
                    </div>
                </section>
            </div>

            <div class="space-y-8">
                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Indexing
                    </p>

                    <div class="mt-6 space-y-4">
                        <x-admin.form.toggle name="allow_indexing" label="Allow Indexing" :checked="$seo->allow_indexing" />

                        <x-admin.form.toggle name="enable_sitemap" label="Enable Sitemap" :checked="$seo->enable_sitemap" />

                        <x-admin.form.toggle name="enable_json_ld" label="Enable JSON-LD" :checked="$seo->enable_json_ld" />

                        <x-admin.form.toggle name="enable_llms_txt" label="Enable LLMS.txt" :checked="$seo->enable_llms_txt" />
                    </div>
                </section>

                <section class="rounded-[2rem] border border-stone-200 bg-[#fbf7ef] p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.25em] text-amber-700">
                        Verification
                    </p>

                    <div class="mt-6 space-y-5">
                        <x-admin.form.input name="canonical_base_url" label="Canonical Base URL" type="url"
                            :value="$seo->canonical_base_url" placeholder="https://bendojaya.id" />

                        <x-admin.form.input name="google_site_verification" label="Google Verification"
                            :value="$seo->google_site_verification" />

                        <x-admin.form.input name="bing_site_verification" label="Bing Verification" :value="$seo->bing_site_verification" />
                    </div>
                </section>

                <section class="rounded-[2rem] bg-stone-950 p-6">
                    <x-admin.button variant="gold" class="w-full">
                        <i class="fa-solid fa-save"></i>
                        Simpan SEO Settings
                    </x-admin.button>
                </section>
            </div>
        </div>
    </form>
@endsection
