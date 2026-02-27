<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #000;
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Fondo con patrón de puntos sutil */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(79, 70, 229, 0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        /* Resplandor superior */
        body::after {
            content: '';
            position: fixed;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse, rgba(79, 70, 229, 0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .login-card {
            background-color: #0d0d0d;
            border: 1px solid #1e1e1e;
            position: relative;
            z-index: 1;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(79, 70, 229, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border: none;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-check-input:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .app-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.35);
        }
    </style>
</head>
<body>
    <div class="w-100 px-3" style="max-width: 440px;">
        {{ $slot }}
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
