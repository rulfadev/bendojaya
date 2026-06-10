<form action="{{ route('collections.inquiries.store', $collection) }}" method="POST" class="grid gap-4">

    @csrf
    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

    <div class="grid gap-4 md:grid-cols-2">

        <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('frontend.name') }}"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('frontend.phone') }}"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    </div>

    <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('frontend.optional_email') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

    <div class="grid gap-4 md:grid-cols-3">

        <input type="text" name="size" value="{{ old('size') }}" placeholder="{{ __('frontend.size') }}"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <input type="number" name="quantity" value="{{ old('quantity') }}" min="1"
            placeholder="{{ __('frontend.quantity') }}"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

        <select name="need_type"
            class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">

            <option value="">{{ __('frontend.select_need') }}</option>

            @foreach (\App\Models\CollectionInquiry::NEED_TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('need_type') === $value)>

                    {{ __('frontend.collection_need_types.' . $value) !== 'frontend.collection_need_types.' . $value ? __('frontend.collection_need_types.' . $value) : $label }}

                </option>
            @endforeach

        </select>

    </div>

    <textarea name="message" rows="5" placeholder="{{ __('frontend.collection_message_placeholder') }}"
        class="rounded-2xl border border-[#E6D8C8] bg-white px-5 py-4 text-sm font-semibold text-[#3C3B39] outline-none focus:border-[#765A4F]">{{ old('message') }}</textarea>

    <button type="submit"
        class="rounded-2xl bg-[#3C3B39] px-6 py-4 text-sm font-black text-[#FBE9CB] transition hover:-translate-y-1 hover:bg-[#58433D]">

        {{ __('frontend.send_collection_inquiry') }}

    </button>

</form>
