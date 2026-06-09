<form action="{{ route('contact-messages.store') }}" method="POST" class="grid gap-4">

    @csrf

    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">
    <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('frontend.name') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('frontend.email') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">
    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('frontend.phone') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="{{ __('frontend.subject') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    <textarea name="message" rows="5" placeholder="{{ __('frontend.contact_message_placeholder') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">{{ old('message') }}</textarea>

    <button type="submit"
        class="rounded-2xl bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">

        {{ __('frontend.send_message') }}

    </button>

</form>
