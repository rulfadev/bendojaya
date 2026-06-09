<form action="{{ route('partnership-inquiries.store') }}" method="POST" class="grid gap-5">

    @csrf

    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

    <div class="grid gap-4 md:grid-cols-2">

        <x-admin.form.input name="company_name" label="{{ __('frontend.company_name') }}" :value="old('company_name')"
            placeholder="{{ __('frontend.company_name_placeholder') }}" />

        <x-admin.form.input name="pic_name" label="{{ __('frontend.pic_name') }}" :value="old('pic_name')"
            placeholder="{{ __('frontend.pic_name_placeholder') }}" />

    </div>
    <div class="grid gap-4 md:grid-cols-2">

        <x-admin.form.input name="email" label="{{ __('frontend.email') }}" type="email" :value="old('email')"
            placeholder="{{ __('frontend.optional_email') }}" />

        <x-admin.form.input name="phone" label="{{ __('frontend.phone') }}" :value="old('phone')"
            placeholder="{{ __('frontend.phone_placeholder') }}" />

    </div>

    <div class="grid gap-4 md:grid-cols-3">

        <x-admin.form.select name="partnership_type" label="{{ __('frontend.partnership_type') }}">

            <option value="">{{ __('frontend.select_partnership_type') }}</option>
            @foreach (\App\Models\PartnershipInquiry::PARTNERSHIP_TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('partnership_type') === $value)>

                    {{ __('frontend.partnership_types.' . $value) !== 'frontend.partnership_types.' . $value ? __('frontend.partnership_types.' . $value) : $label }}

                </option>
            @endforeach

        </x-admin.form.select>

        <x-admin.form.input name="estimated_quantity" label="{{ __('frontend.estimated_quantity') }}" type="number"
            :value="old('estimated_quantity')" min="1" placeholder="{{ __('frontend.estimated_quantity_placeholder') }}" />

        <x-admin.form.select name="budget_range" label="{{ __('frontend.budget_range') }}">

            <option value="">{{ __('frontend.select_budget') }}</option>
            @foreach (\App\Models\PartnershipInquiry::BUDGET_RANGES as $value => $label)
                <option value="{{ $value }}" @selected(old('budget_range') === $value)>

                    {{ __('frontend.budget_ranges.' . $value) !== 'frontend.budget_ranges.' . $value ? __('frontend.budget_ranges.' . $value) : $label }}

                </option>
            @endforeach

        </x-admin.form.select>

    </div>

    <x-admin.form.input name="deadline_date" label="{{ __('frontend.deadline_date') }}" type="date"
        :value="old('deadline_date')" />

    <x-admin.form.textarea name="message" label="{{ __('frontend.need_note') }}" :value="old('message')" rows="6"
        placeholder="{{ __('frontend.partnership_message_placeholder') }}" />

    <x-admin.button class="w-full">

        {{ __('frontend.send_partnership_proposal') }}

        <i class="fa-solid fa-arrow-right text-xs"></i>

    </x-admin.button>

</form>
