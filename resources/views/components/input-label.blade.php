@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label fw-medium text-light']) }}>
    {{ $value ?? $slot }}
</label>
