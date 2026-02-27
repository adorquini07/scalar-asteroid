@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'nav-link fw-semibold text-white border-start border-3 border-primary ps-3 py-2 d-block'
        : 'nav-link text-secondary ps-3 py-2 d-block';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
