@props(['value'])

<label for="{{ $for ?? null }}" {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
