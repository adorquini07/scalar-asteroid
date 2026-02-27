<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold mb-0 text-white">
                <i class="bi bi-clock-history me-2 text-primary"></i>{{ __('Historial de Registros') }}
            </h2>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <!-- Dashboard Style Filters -->
        <div class="card border-0 mb-4 rounded-4 shadow-lg overflow-hidden" 
             style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
            <div class="card-body p-4">
                <form action="{{ route('registros.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Persona / Moto</label>
                        <select name="persona_id" class="form-select select2-filter">
                            <option value="">Todas las personas</option>
                            @foreach($personas as $persona)
                                <option value="{{ $persona->id }}" {{ request('persona_id') == $persona->id ? 'selected' : '' }}>
                                    {{ $persona->nombre }} ({{ $persona->placa ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Tipo de Registro</label>
                        <select name="tipo" class="form-select select2-filter">
                            <option value="">Todos los tipos</option>
                            <option value="llegada" {{ request('tipo') == 'llegada' ? 'selected' : '' }}>Llegada 🟢</option>
                            <option value="salida" {{ request('tipo') == 'salida' ? 'selected' : '' }}>Salida 🔴</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Punto de Apoyo</label>
                        <select name="punto_apoyo_id" class="form-select select2-filter">
                            <option value="">Todos los puntos</option>
                            @foreach($puntosApoyo as $punto)
                                <option value="{{ $punto->id }}" {{ request('punto_apoyo_id') == $punto->id ? 'selected' : '' }}>
                                    {{ $punto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm">
                            <i class="bi bi-filter me-1"></i> Filtrar
                        </button>
                        @if(request()->anyFilled(['persona_id', 'tipo', 'punto_apoyo_id']))
                            <a href="{{ route('registros.index') }}" class="btn btn-dark-soft py-2 px-3 rounded-3 border-glass">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Stylish Table Card -->
        <div class="card border-0 rounded-4 shadow-lg overflow-hidden" 
             style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle custom-historial-table">
                    <thead>
                        <tr class="bg-dark-soft border-bottom border-secondary border-opacity-10">
                            <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Fecha y Hora</th>
                            <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Persona/Moto</th>
                            <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Tipo</th>
                            <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Punto de Apoyo</th>
                            <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Registrado Por</th>
                        </tr>
                    </thead>
                    <tbody class="border-secondary border-opacity-10">
                        @forelse($registros as $registro)
                            <tr class="border-bottom border-secondary border-opacity-5 transition-all hover-highlight">
                                <td class="px-4 py-4 text-white-50">
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium text-white">{{ $registro->created_at->format('d/m/Y') }}</span>
                                        <span class="text-xs">{{ $registro->created_at->format('h:i A') }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm-circle bg-dark-soft text-primary me-3">
                                            <i class="bi bi-person text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white">{{ $registro->persona->nombre }}</div>
                                            <div class="text-xs text-secondary">{{ $registro->persona->placa ?? 'Sin placa' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @if($registro->tipo === 'llegada')
                                        <span class="status-chip status-success">
                                            <i class="bi bi-arrow-down-left-circle me-1"></i> Llegada
                                        </span>
                                    @else
                                        <span class="status-chip status-danger">
                                            <i class="bi bi-arrow-up-right-circle me-1"></i> Salida
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-white-50">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt me-2 text-indigo-400"></i>
                                        {{ $registro->puntoApoyo ? $registro->puntoApoyo->nombre : '-' }}
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="d-flex align-items-center text-xs text-secondary">
                                        <span class="badge bg-dark-soft border-glass-thin rounded-pill px-2 py-1">
                                            {{ optional($registro->user)->name }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-5 text-center text-secondary italic">
                                    <i class="bi bi-inbox fs-2 mb-2 d-block opacity-25"></i>
                                    No se encontraron registros activos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($registros->hasPages())
                <div class="card-footer bg-transparent border-top border-secondary border-opacity-10 p-4">
                    {{ $registros->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .custom-historial-table { background: transparent !important; }
        .bg-dark-soft { background-color: rgba(255, 255, 255, 0.03) !important; }
        .border-glass { border: 1px solid rgba(255, 255, 255, 0.1) !important; }
        .border-glass-thin { border: 1px solid rgba(255, 255, 255, 0.05) !important; }
        
        .avatar-sm-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .status-chip {
            padding: 4px 12px;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .hover-highlight:hover {
            background-color: rgba(255,255,255,0.02) !important;
            transform: scale(1.002);
            z-index: 10;
        }

        .text-xs { font-size: 0.7rem; }
        .btn-dark-soft { background-color: #1a1a1a; color: #9ca3af; }
        .btn-dark-soft:hover { background-color: #262626; color: white; }

        .form-select.select2-filter {
            background-color: #1a1a1a;
            border-color: #334155;
            color: #f3f4f6;
            border-radius: 0.75rem;
            padding: 0.6rem 1rem;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Pagination custom style for dark mode */
        .pagination .page-link {
            background-color: #1a1a1a;
            border-color: #334155;
            color: #94a3b8;
        }
        .pagination .page-item.active .page-link {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
    </style>

    <!-- External Assets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-filter').select2({
                theme: 'bootstrap-5',
                width: '100%',
                dropdownCssClass: 'select2-dark-dropdown'
            });
        });
    </script>
</x-app-layout>