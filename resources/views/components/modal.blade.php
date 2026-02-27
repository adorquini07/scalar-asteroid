@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$sizeClass = match ($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    default => '',
};
@endphp

<div
    class="modal fade"
    id="{{ $name }}"
    tabindex="-1"
    aria-hidden="{{ $show ? 'false' : 'true' }}"
    data-bs-backdrop="static"
>
    <div class="modal-dialog {{ $sizeClass }} modal-dialog-centered">
        <div class="modal-content bg-dark text-white border border-secondary">
            {{ $slot }}
        </div>
    </div>
</div>

@if($show)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('{{ $name }}'));
        modal.show();
    });
</script>
@endif
