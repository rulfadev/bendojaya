@props(['label', 'name', 'checked' => false, 'description' => null])

<label
    class="flex cursor-pointer items-center justify-between gap-5 rounded-[1.25rem] border border-stone-200 bg-white px-4 py-3 transition hover:border-stone-300 hover:bg-[#fffaf2]">
    <span>
        <span class="block text-sm font-black text-stone-800">
            {{ $label }}
        </span>

        @if ($description)
            <span class="mt-1 block text-xs font-semibold leading-5 text-stone-500">
                {{ $description }}
            </span>
        @endif
    </span>

    <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked))
        {{ $attributes->merge([
            'class' => 'peer sr-only',
        ]) }}>

    <span
        class="relative h-7 w-12 shrink-0 rounded-full bg-stone-200 transition peer-checked:bg-stone-950 peer-disabled:cursor-not-allowed peer-disabled:opacity-50 after:absolute after:left-1 after:top-1 after:h-5 after:w-5 after:rounded-full after:bg-white after:shadow-sm after:transition peer-checked:after:translate-x-5"></span>
</label>

@error($name)
    <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
@enderror
