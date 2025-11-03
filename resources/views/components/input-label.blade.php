@props(['value'])

<label {{ $attributes->merge(['class' => 'font-medium font-leading text-sm text-gray-950 ']) }}>
    {{ $value ?? $slot }}
</label>
