<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Votación | Sistema Electoral</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- Frameworks -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />

    <style>
        :root {
            --glass-bg: rgba(20, 20, 20, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --primary-glow: rgba(79, 70, 229, 0.4);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #050505;
            color: #ffffff;
            min-height: 100vh;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(79, 70, 229, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .auth-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 2rem;
            width: 100%;
            max-width: 500px;
            padding: 3rem 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
            font-size: 2.5rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .select2-container--bootstrap-5 .select2-selection {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 1rem !important;
            padding: 0.8rem 1rem !important;
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .select2-container--bootstrap-5.select2-container--focus .select2-selection {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15) !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 1rem;
            padding: 1rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
            filter: brightness(1.1);
        }

        /* Select2 Premium Styling */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 52px !important;
            display: flex !important;
            align-items: center !important;
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 1rem !important;
            transition: all 0.3s ease !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #ffffff !important;
            padding-left: 1rem !important;
            font-size: 0.95rem !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
            color: #64748b !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15) !important;
        }

        .select2-dropdown {
            background-color: #0f172a !important;
            /* Deep navy/black */
            border: 1px solid var(--glass-border) !important;
            border-radius: 1rem !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5) !important;
            overflow: hidden !important;
            z-index: 9999 !important;
        }

        .select2-search__field {
            background-color: #1e293b !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 0.75rem !important;
            color: #ffffff !important;
            margin-bottom: 8px !important;
        }

        .select2-results__option {
            padding: 12px 16px !important;
            font-size: 0.9rem !important;
            color: #94a3b8 !important;
            transition: background 0.2s ease !important;
        }

        .select2-results__option--highlighted {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
        }

        .select2-results__option[aria-selected=true] {
            background-color: rgba(79, 70, 229, 0.2) !important;
            color: #818cf8 !important;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            border-radius: 1rem;
            padding: 1rem;
        }

        .btn-mesa-grid {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            color: #94a3b8;
            border-radius: 0.75rem;
            padding: 0.5rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-mesa-grid:hover {
            border-color: rgba(79, 70, 229, 0.5);
            color: #ffffff;
            background-color: rgba(79, 70, 229, 0.1);
        }

        .btn-mesa-grid.active {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-color: transparent !important;
            color: #ffffff !important;
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        .text-indigo-400 {
            color: #818cf8 !important;
        }

        .bg-indigo-600 {
            background-color: #4f46e5 !important;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="logo-container">
                <i class="bi bi-fingerprint text-white"></i>
            </div>
            <h2 class="fw-extrabold mb-1">Registro de Voto</h2>
            <p class="text-secondary small">Reporte Oficial de Líderes</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-4 border-0">
                <i class="bi bi-patch-check-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <form method="POST" action="{{ route('votos.public_store') }}">
            @csrf

            <!-- Líder -->
            <div class="mb-3">
                <label for="nombre_lider" class="form-label">Tu Nombre (Líder)</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0"
                        style="border-radius: 1rem 0 0 1rem; border: 1px solid var(--glass-border);">
                        <i class="bi bi-shield-shaded text-indigo-400"></i>
                    </span>
                    <input type="text" id="nombre_lider" name="nombre_lider" class="form-control border-start-0"
                        placeholder="Ej: Juan Pérez" value="{{ old('nombre_lider') }}" required>
                </div>
                @error('nombre_lider') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Votante -->
            <div class="mb-3">
                <label for="nombre_votante" class="form-label">Nombre del Votante</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0"
                        style="border-radius: 1rem 0 0 1rem; border: 1px solid var(--glass-border);">
                        <i class="bi bi-person-fill text-indigo-400"></i>
                    </span>
                    <input type="text" id="nombre_votante" name="nombre_votante" class="form-control border-start-0"
                        placeholder="Nombre completo" value="{{ old('nombre_votante') }}" required>
                </div>
                @error('nombre_votante') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Puesto -->
            <div class="mb-3">
                <label for="ubicacion_id" class="form-label">Puesto de Votación</label>
                <select id="ubicacion_id" name="ubicacion_id" class="form-select select2" required>
                    <option value="">Seleccione el puesto...</option>
                    @foreach($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id }}" data-mesas="{{ $ubicacion->total_mesas }}">
                            {{ $ubicacion->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('ubicacion_id') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Mesa -->
            <div id="mesa-container" class="mb-4 d-none">
                <label class="form-label">Número de Mesa</label>
                <div id="mesa-grid" class="row row-cols-4 row-cols-sm-5 g-2 mb-3">
                    <!-- Botones generados por JS -->
                </div>

                <div id="mesa-selected-badge" class="d-none animate-fade-in">
                    <div class="d-flex align-items-center justify-content-center p-3 rounded-4"
                        style="background: rgba(79, 70, 229, 0.1); border: 1px solid rgba(79, 70, 229, 0.3);">
                        <span class="badge bg-indigo-600 rounded-pill px-3 py-2 me-2">MESA <span id="mesa-val-display"
                                class="fs-6">0</span></span>
                        <span class="text-indigo-400 fw-bold small uppercase">¡Seleccionada!</span>
                    </div>
                </div>

                <input type="hidden" id="mesa" name="mesa" value="{{ old('mesa') }}" required>
                @error('mesa') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-submit btn-lg">
                <i class="bi bi-send-fill me-2"></i> REGISTRAR REPORTE
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Select2 Initialization
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Seleccione el puesto...'
            });

            // Focus search field on open
            $(document).on('select2:open', () => {
                setTimeout(() => {
                    document.querySelector('.select2-search__field').focus();
                }, 10);
            });

            // Mesa Grid Logic
            $('#ubicacion_id').on('change', function () {
                const totalMesas = parseInt($(this).find(':selected').data('mesas')) || 0;
                const $container = $('#mesa-container');
                const $grid = $('#mesa-grid');
                const $hiddenInput = $('#mesa');

                $grid.empty();
                $hiddenInput.val('');
                $('#mesa-selected-badge').addClass('d-none');

                if (totalMesas > 0) {
                    for (let i = 1; i <= totalMesas; i++) {
                        $grid.append(`
                            <div class="col">
                                <button type="button" class="btn btn-mesa-grid w-100" data-num="${i}">
                                    ${i}
                                </button>
                            </div>
                        `);
                    }
                    $container.removeClass('d-none').hide().fadeIn(400);
                } else {
                    $container.fadeOut(300);
                }
            });

            // Selection Logic
            $(document).on('click', '.btn-mesa-grid', function () {
                $('.btn-mesa-grid').removeClass('active');
                $(this).addClass('active');

                const val = $(this).data('num');
                $('#mesa').val(val);
                $('#mesa-val-display').text(val);
                $('#mesa-selected-badge').removeClass('d-none').hide().fadeIn(300);
            });
        });
    </script>
</body>

</html>