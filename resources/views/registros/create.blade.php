<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Registrar Actividad') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
                    <div class="card-header border-bottom-0 py-4 px-4" style="background-color: transparent;">
                        <h4 class="card-title fw-bold mb-0 text-primary">Detalles del Registro</h4>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('registros.store') }}" id="registro-form">
                            @csrf

                            {{-- 1. PERSONA --}}
                            <div class="mb-4">
                                <label for="persona_id" class="form-label fw-bold mb-2">
                                    <i class="bi bi-person-fill text-primary me-1"></i>
                                    {{ __('Persona / Motociclista') }}
                                </label>
                                <select id="persona_id" name="persona_id" class="form-select select2-bs5" required
                                    autofocus>
                                    <option value="" disabled selected>Seleccione una persona...</option>
                                    @foreach($personas as $persona)
                                        <option value="{{ $persona->id }}">
                                            {{ $persona->nombre }} ({{ $persona->placa ?? 'Sin placa' }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('persona_id')" class="mt-2" />
                            </div>

                            {{-- 2. ESTADO --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-2">
                                    <i class="bi bi-activity text-primary me-1"></i> {{ __('Estado del Registro') }}
                                </label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="tipo" id="btn-llegada"
                                            value="llegada" required>
                                        <label
                                            class="btn btn-outline-success w-100 py-3 rounded-3 d-flex flex-column align-items-center justify-content-center border-2 transition-all"
                                            for="btn-llegada">
                                            <span class="fs-2 mb-1">🟢</span>
                                            <span class="fw-bold uppercase tracking-tight">Llegó</span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="tipo" id="btn-salida"
                                            value="salida">
                                        <label
                                            class="btn btn-outline-danger w-100 py-3 rounded-3 d-flex flex-column align-items-center justify-content-center border-2 transition-all"
                                            for="btn-salida">
                                            <span class="fs-2 mb-1">🔴</span>
                                            <span class="fw-bold uppercase tracking-tight">Salió</span>
                                        </label>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                            </div>

                            {{-- 3. PUNTO DE APOYO --}}
                            <div class="mb-4">
                                <label for="punto_apoyo_id" class="form-label fw-bold mb-2">
                                    <i class="bi bi-geo-alt-fill text-primary me-1"></i> {{ __('Punto de Apoyo') }}
                                </label>
                                <select id="punto_apoyo_id" name="punto_apoyo_id" class="form-select select2-bs5"
                                    required>
                                    <option value="" disabled selected>Seleccione un punto de apoyo...</option>
                                    @foreach($puntosApoyo as $punto)
                                        <option value="{{ $punto->id }}">{{ $punto->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('punto_apoyo_id')" class="mt-2" />
                            </div>

                            {{-- SECCIÓN DE VOTACIÓN (SOLO LLEGADA) --}}
                            <div id="seccion-votacion" class="d-none">
                                <hr class="my-4 border-secondary opacity-25">
                                <h5 class="text-primary fw-bold mb-3 small uppercase tracking-wider">Información de Votación</h5>

                                {{-- Referido / Votante --}}
                                <div class="mb-4">
                                    <label for="referido" class="form-label fw-bold mb-2">
                                        <i class="bi bi-person-plus-fill text-primary me-1"></i> {{ __('Nombre del Referido / Votante') }}
                                    </label>
                                    <input type="text" id="referido" name="referido" class="form-control rounded-4 border-0 p-3" 
                                           style="background-color: #1a1a1a; color: #f3f4f6; border: 1px solid #334155 !important;"
                                           placeholder="Ej: Pedro Pérez" value="{{ old('referido') }}">
                                    <x-input-error :messages="$errors->get('referido')" class="mt-2" />
                                </div>

                                {{-- Puesto de Votación --}}
                                <div class="mb-4">
                                    <label for="ubicacion_id" class="form-label fw-bold mb-2">
                                        <i class="bi bi-geo-fill text-primary me-1"></i> {{ __('Puesto de Votación') }}
                                    </label>
                                    <select id="ubicacion_id" name="ubicacion_id" class="form-select select2-bs5">
                                        <option value="">Seleccione el puesto...</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('ubicacion_id')" class="mt-2" />
                                </div>

                                {{-- Tipo de Voto --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-people-fill text-primary me-1"></i> {{ __('¿A quién va a votar?') }}
                                    </label>
                                    <input type="hidden" name="voto_tipo" id="voto_tipo" value="{{ old('voto_tipo', 'ambas') }}">
                                    <div class="tipo-voto-group">
                                        <button type="button" class="btn-tipo tipo-camara {{ old('voto_tipo', 'ambas') === 'camara' ? 'active' : '' }}" data-value="camara">
                                            <i class="bi bi-building-fill"></i>
                                            Cámara
                                        </button>
                                        <button type="button" class="btn-tipo tipo-ambas {{ old('voto_tipo', 'ambas') === 'ambas' ? 'active' : '' }}" data-value="ambas">
                                            <i class="bi bi-people-fill"></i>
                                            Ambas
                                        </button>
                                        <button type="button" class="btn-tipo tipo-senado {{ old('voto_tipo', 'ambas') === 'senado' ? 'active' : '' }}" data-value="senado">
                                            <i class="bi bi-bank2"></i>
                                            Senado
                                        </button>
                                    </div>
                                    <x-input-error :messages="$errors->get('voto_tipo')" class="mt-2" />
                                </div>

                                {{-- Mesa Grid --}}
                                <div id="mesa-container" class="mb-4 d-none">
                                    <label class="form-label fw-bold mb-2 text-secondary small">
                                        <i class="bi bi-hash me-1"></i> {{ __('Seleccione la Mesa') }}
                                    </label>
                                    <div id="mesa-grid" class="row row-cols-4 row-cols-sm-5 g-2">
                                        <!-- Generado por JS -->
                                    </div>
                                    
                                    <div id="mesa-alert" class="mt-3 p-3 rounded-4 d-none animate-fade-in"
                                        style="background: rgba(79, 70, 229, 0.1); border: 1px solid rgba(79, 70, 229, 0.2);">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="badge bg-primary rounded-pill px-3 py-2 me-2">MESA <span
                                                    id="mesa-val-display" class="fs-6">0</span></span>
                                            <span class="text-primary fw-bold small">¡Seleccionada!</span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="mesa_vota" name="mesa_vota">
                                    <x-input-error :messages="$errors->get('mesa_vota')" class="mt-2" />
                                </div>
                            </div>

                            {{-- SUBMIT --}}
                            <div class="mt-5 border-top pt-4">
                                <button type="submit"
                                    class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow-lg transition-transform hover-scale">
                                    <i class="bi bi-check2-circle me-2 h4 mb-0"></i>
                                    GUARDAR REGISTRO
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rounded-4 {
            border-radius: 1.25rem !important;
        }

        .hover-scale:active {
            transform: scale(0.98);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            border-radius: 1rem;
            padding: 1rem;
        }

        .select2-search__field {
            background-color: #111827 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 0.5rem !important;
            padding: 8px 12px !important;
        }

        .select2-search--dropdown {
            background-color: #121212 !important;
            padding: 10px !important;
        }

        /* Custom State Buttons - Dark Mode Refined */
        .btn-check:checked+.btn-outline-success {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
            border-color: #10b981;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        .btn-check:checked+.btn-outline-danger {
            background-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-color: #ef4444;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
        }

        /* Select2 BS5 Dark Overrides */
        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 0.75rem !important;
            min-height: 56px !important;
            padding: 0.75rem 0.5rem !important;
            border-color: #374151 !important;
            background-color: #1f2937 !important;
            color: #f3f4f6 !important;
            font-size: 1rem !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            color: #f3f4f6 !important;
        }

        .select2-container--bootstrap-5 .select2-selection:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
            border-color: #3b82f6 !important;
        }

        .select2-dropdown {
            background-color: #1f2937 !important;
            border-color: #374151 !important;
            color: #f3f4f6 !important;
        }

        .select2-container--bootstrap-5 .select2-search__field {
            background-color: #111827 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 0.5rem !important;
            padding: 8px 12px !important;
            outline: none !important;
        }

        .select2-search--dropdown {
            background-color: #1f2937 !important;
            padding: 10px !important;
        }

        /* Mesa Grid Refined */
        .btn-mesa {
            aspect-ratio: 1/1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            border-radius: 12px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.1rem;
            border-width: 2px;
            background-color: #1f2937;
            border-color: #374151;
            color: #9ca3af;
        }

        .btn-mesa:hover {
            transform: translateY(-2px);
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .btn-mesa.selected {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
            transform: scale(1.05);
        }

        /* Form Labels for Dark Theme */
        .form-label {
            color: #9ca3af !important;
        }

        .text-secondary {
            color: #6b7280 !important;
        }

        /* Selector de tipo de voto */
        .tipo-voto-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .btn-tipo {
            background-color: #1f2937;
            border: 2px solid #374151;
            border-radius: 0.75rem;
            padding: 0.85rem 0.5rem;
            color: #6b7280;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            line-height: 1.2;
        }

        .btn-tipo i { font-size: 1.4rem; }

        .btn-tipo:hover {
            border-color: #3b82f6;
            color: #93c5fd;
            background-color: rgba(59, 130, 246, 0.08);
        }

        .btn-tipo.active {
            border-color: transparent !important;
            color: #ffffff !important;
        }

        .btn-tipo.active.tipo-ambas {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
        }

        .btn-tipo.active.tipo-camara {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            box-shadow: 0 6px 18px rgba(14, 165, 233, 0.35);
        }

        .btn-tipo.active.tipo-senado {
            background: linear-gradient(135deg, #dc2626 0%, #9f1239 100%);
            box-shadow: 0 6px 18px rgba(220, 38, 38, 0.35);
        }
    </style>

    <!-- External Assets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            const s2Config = {
                theme: 'bootstrap-5',
                width: '100%',
                dropdownCssClass: 'select2-dark-dropdown',
                language: { noResults: () => "Sin resultados", searching: () => "Buscando..." }
            };

            $('#persona_id, #punto_apoyo_id, #ubicacion_id').select2(s2Config);

            // ─── Tipo Change (Llegada/Salida) ───
            $('input[name="tipo"]').on('change', function () {
                const tipo = $(this).val();
                const $votacion = $('#seccion-votacion');

                if (tipo === 'llegada') {
                    $votacion.removeClass('d-none').hide().fadeIn(400);
                } else {
                    $votacion.fadeOut(300, function() {
                        $(this).addClass('d-none');
                        // Reset fields
                        $('#referido').val('');
                        $('#ubicacion_id').val('').trigger('change');
                        $('#mesa_vota').val('');
                        $('.btn-mesa').removeClass('selected');
                        $('#mesa-alert').addClass('d-none');
                    });
                }
            });

            // ─── AJAX Puestos ───
            $('#punto_apoyo_id').on('change', function () {
                const puntoId = $(this).val();
                const $puestoSelect = $('#ubicacion_id');
                const $mesaContainer = $('#mesa-container');

                $puestoSelect.empty().append('<option value="">Cargando puestos...</option>').trigger('change');
                $mesaContainer.addClass('d-none');

                if (!puntoId) return;

                $.getJSON('/api/ubicaciones-por-punto/' + puntoId, function (data) {
                    $puestoSelect.empty().append('<option value="">Seleccione el puesto...</option>');
                    $.each(data, function (i, item) {
                        $puestoSelect.append(`<option value="${item.id}" data-mesas="${item.total_mesas}">${item.nombre}</option>`);
                    });
                    $puestoSelect.trigger('change');
                });
            });

            // ─── Mesa Grid Logic ───
            $('#ubicacion_id').on('change', function () {
                const totalMesas = parseInt($(this).find(':selected').data('mesas')) || 0;
                const $grid = $('#mesa-grid');
                const $container = $('#mesa-container');
                const $hiddenInput = $('#mesa_vota');

                $grid.empty();
                $hiddenInput.val('');
                $('#mesa-alert').addClass('d-none');

                if (totalMesas > 0) {
                    for (let i = 1; i <= totalMesas; i++) {
                        $grid.append(`
                            <div class="col">
                                <button type="button" class="btn btn-mesa w-100" data-num="${i}">
                                    ${i}
                                </button>
                            </div>
                        `);
                    }
                    $container.removeClass('d-none').hide().fadeIn(300);
                } else {
                    $container.addClass('d-none');
                }
            });

            // Selection Logic
            $(document).on('click', '.btn-mesa', function () {
                $('.btn-mesa').removeClass('selected');
                $(this).addClass('selected');

                const val = $(this).data('num');
                $('#mesa_vota').val(val);
                $('#mesa-val-display').text(val);
                $('#mesa-alert').removeClass('d-none').hide().fadeIn(200);
            });

            // Tipo de Voto Logic
            $('.btn-tipo').on('click', function () {
                $('.btn-tipo').removeClass('active');
                $(this).addClass('active');
                $('#voto_tipo').val($(this).data('value'));
            });

            // Select2 Search Fix
            $(document).on('select2:open', () => {
                const searchField = document.querySelector('.select2-search__field');
                if (searchField) {
                    searchField.focus();
                    searchField.style.backgroundColor = '#111827';
                    searchField.style.color = 'white';
                }
            });
        });
    </script>
</x-app-layout>