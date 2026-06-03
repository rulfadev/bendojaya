@props(['label', 'name', 'checked' => false])

<label class="flex items-center justify-between rounded-2xl border border-stone-200 bg-white px-4 py-3">
    <span class="text-sm font-black text-stone-800">{{ $label }}</span>

    <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked))
        {{ $attributes->merge([
            'class' =>
                'h-5 w-5 rounded border-stone-300 text-stone-950 focus:ring-amber-300 disabled:cursor-not-allowed disabled:opacity-50',
        ]) }}>
</label>

@error($name)
    <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
@enderror
