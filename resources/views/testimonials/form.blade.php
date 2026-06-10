@extends('layouts.frontend')

@section('content')
    @php
        $isEnglish = app()->getLocale() === 'en';

        $submitUrl =
            $isEnglish && \Illuminate\Support\Facades\Route::has('en.testimonial-form.submit')
                ? route('en.testimonial-form.submit', $testimonial)
                : route('testimonial-form.submit', $testimonial);
    @endphp

    <section class="bg-[#3C3B39] py-24 text-[#FBE9CB]">
        <div class="mx-auto max-w-3xl px-5 text-center lg:px-8">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-[#EEBDB5]">
                {{ __('frontend.testimonial_form_eyebrow') }}
            </p>

            <h1 class="mt-5 font-['Playfair_Display'] text-5xl font-black">
                {{ __('frontend.testimonial_form_title') }}
            </h1>

            <p class="mt-6 text-sm leading-7 text-[#E6D8C8]">
                {{ __('frontend.testimonial_form_description') }}
            </p>
        </div>
    </section>

    <section class="py-20">
        <div class="mx-auto max-w-3xl px-5 lg:px-8">
            <form action="{{ $submitUrl }}" method="POST" enctype="multipart/form-data"
                class="rounded-[2rem] border border-[#E6D8C8] bg-white p-7 shadow-sm">
                @csrf

                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                <div class="grid gap-5 md:grid-cols-2">
                    <input name="name" value="{{ old('name', $testimonial->name) }}"
                        placeholder="{{ __('frontend.testimonial_name') }}"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="company_name" value="{{ old('company_name', $testimonial->company_name) }}"
                        placeholder="{{ __('frontend.testimonial_company') }}"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="position" value="{{ old('position', $testimonial->position) }}"
                        placeholder="{{ __('frontend.testimonial_position') }}"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="email" value="{{ old('email', $testimonial->email) }}"
                        placeholder="{{ __('frontend.email') }}"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <input name="phone" value="{{ old('phone', $testimonial->phone) }}"
                        placeholder="{{ __('frontend.whatsapp') }}"
                        class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">

                    <select name="rating" class="rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">
                        <option value="">{{ __('frontend.testimonial_select_rating') }}</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating) === $i)>
                                {{ __('frontend.testimonial_star_label', ['count' => $i]) }}
                            </option>
                        @endfor
                    </select>

                    <div>
                        <label class="mb-2 block text-sm font-black text-[#3C3B39]">
                            {{ __('frontend.testimonial_photo_optional') }}
                        </label>
                        <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-black text-[#3C3B39]">
                            {{ __('frontend.testimonial_logo_optional') }}
                        </label>
                        <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,.svg"
                            class="block w-full text-sm">
                    </div>

                    <textarea name="message" rows="7" placeholder="{{ __('frontend.testimonial_message_placeholder') }}"
                        class="md:col-span-2 rounded-2xl border border-[#E6D8C8] px-5 py-4 text-sm font-semibold">{{ old('message', $testimonial->message) }}</textarea>
                </div>

                <label class="mt-6 flex gap-3 text-sm leading-6 text-[#58433D]">
                    <input type="checkbox" name="consent_to_publish" value="1" class="mt-1"
                        @checked(old('consent_to_publish', $testimonial->consent_to_publish))>
                    <span>{{ __('frontend.testimonial_consent') }}</span>
                </label>

                <button class="mt-7 w-full rounded-2xl bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB]">
                    {{ __('frontend.testimonial_submit_button') }}
                </button>
            </form>
        </div>
    </section>
@endsection
