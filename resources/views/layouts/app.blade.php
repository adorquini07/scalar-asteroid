<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #000000; font-family: 'Figtree', sans-serif;">
    <div style="min-height: 100vh; background-color: #000000;">
        @include('layouts.navigation')
        @isset($header)
            <header class="shadow-sm" style="background-color: #0d0d0d; border-bottom: 1px solid #1a1a1a;">
                <div class="container-xl py-3">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <main>
            {{ $slot }}
        </main>
    </div>
    @if(session('success'))
        <script>
            Swal.fire({ title: '¡Exito!', text: "{{ session('success') }}", icon: 'success', confirmButtonText: 'Aceptar', confirmButtonColor: '#4f46e5' });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({ title: 'Error', text: "{{ session('error') }}", icon: 'error', confirmButtonText: 'Aceptar', confirmButtonColor: '#ef4444' });
        </script>
    @endif
    @if($errors->any())
        <script>
            let errorMessages = '';
            @foreach($errors->all() as $error)
                errorMessages += '<li>{{ $error }}</li>';
            @endforeach
            Swal.fire({ title: 'Verifica los datos', html: `<ul style="text-align: left;">${errorMessages}</ul>`, icon: 'warning', confirmButtonText: 'Entendido', confirmButtonColor: '#eab308' });
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-confirm-delete').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const form = this.closest('form');
                    const nombre = this.dataset.nombre || 'este registro';
                    Swal.fire({
                        title: '¿Eliminar?',
                        html: `¿Estas seguro de que deseas eliminar <strong>${nombre}</strong>?<br><span class="text-secondary small">Esta accion no se puede deshacer.</span>`,
                        icon: 'warning', showCancelButton: true,
                        confirmButtonColor: '#ef4444', cancelButtonColor: '#374151',
                        confirmButtonText: 'Si, eliminar', cancelButtonText: 'Cancelar',
                        background: '#0d0d0d', color: '#ffffff',
                    }).then(function (result) { if (result.isConfirmed) { form.submit(); } });
                });
            });
        });
    </script>
</body>
</html>