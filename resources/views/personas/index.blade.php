<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <h2 class="h4 font-weight-bold mb-0 text-white">
                <i class="bi bi-people-fill me-2 text-primary"></i>{{ __('Gestión de Personas / Motociclistas') }}
            </h2>
            <a href="{{ route('personas.create') }}"
                class="btn btn-primary btn-lg px-4 rounded-3 fw-bold shadow-lg transition-transform hover-scale">
                <i class="bi bi-person-plus-fill me-2"></i>Nueva Persona
            </a>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <!-- Dashboard Style Filters -->
        <div class="card border-0 mb-4 rounded-4 shadow-lg overflow-hidden"
            style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
            <div class="card-body p-4">
                <form action="{{ route('personas.index') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Búsqueda Rápida</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark-soft border-glass-thin text-secondary">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control bg-dark-soft border-glass-thin text-white"
                                placeholder="Nombre, Cédula, Apodo o Placa..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Estado</label>
                        <select name="activo" class="form-select bg-dark-soft border-glass-thin text-white">
                            <option value="">Todos los estados</option>
                            <option value="1" {{ request('activo') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ request('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-indigo w-100 py-2 rounded-3 fw-bold shadow-sm">
                            <i class="bi bi-filter me-1"></i> Filtrar
                        </button>
                        @if(request()->anyFilled(['search', 'activo']))
                            <a href="{{ route('personas.index') }}"
                                class="btn btn-dark-soft py-2 px-3 rounded-3 border-glass">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Responsive Card/Table Wrapper -->
        <div class="card border-0 rounded-4 shadow-lg overflow-hidden"
            style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">

            {{-- Desktop View --}}
            <div class="d-none d-lg-block">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 align-middle custom-personas-table">
                        <thead>
                            <tr class="bg-dark-soft border-bottom border-secondary border-opacity-10">
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Información Personal
                                </th>
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Identificación</th>
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Contacto / Vehículo
                                </th>
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Estado</th>
                                <th class="px-4 py-3 text-end text-secondary small fw-bold text-uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary border-opacity-10">
                            @forelse($personas as $persona)
                                <tr class="border-bottom border-secondary border-opacity-5 transition-all hover-highlight">
                                    <td class="px-4 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary-soft text-primary me-3">
                                                {{ substr($persona->nombre, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-white">{{ $persona->nombre }}</div>
                                                <div class="text-xs text-secondary">{{ $persona->apodo ?? 'Sin apodo' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="d-flex flex-column">
                                            <span class="text-white-50 small">CC: {{ $persona->cedula }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-white-50">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="small"><i
                                                    class="bi bi-phone me-2 text-indigo-400"></i>{{ $persona->celular ?? '-' }}
                                            </div>
                                            <div class="small"><i
                                                    class="bi bi-car-front-fill me-2 text-indigo-400"></i>{{ $persona->placa ?? '-' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($persona->activo)
                                            <span class="status-chip status-success">Activo</span>
                                        @else
                                            <span class="status-chip status-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('personas.edit', $persona->id) }}"
                                                class="btn btn-sm btn-dark-soft border-glass-thin text-indigo-400">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('¿Eliminar esta persona?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-dark-soft border-glass-thin text-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-5 text-center text-secondary italic">
                                        <i class="bi bi-people fs-2 mb-2 d-block opacity-25"></i>
                                        No se encontraron personas registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile & Tablet View --}}
            <div class="d-lg-none p-3">
                <div class="row g-3">
                    @forelse($personas as $persona)
                        <div class="col-12 col-md-6">
                            <div class="persona-mobile-card p-4 rounded-4 border-glass-thin h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm-circle bg-primary-soft text-primary me-3">
                                            {{ substr($persona->nombre, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white fs-5">{{ $persona->nombre }}</div>
                                            <div class="text-xs text-secondary">CC: {{ $persona->cedula }}</div>
                                        </div>
                                    </div>
                                    @if($persona->activo)
                                        <span class="status-chip status-success">Activo</span>
                                    @else
                                        <span class="status-chip status-danger">Inactivo</span>
                                    @endif
                                </div>
                                <div class="info-grid mb-4">
                                    <div
                                        class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary border-opacity-10">
                                        <span class="text-secondary small fw-bold text-uppercase">Apodo</span>
                                        <span class="text-white small">{{ $persona->apodo ?? '-' }}</span>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary border-opacity-10">
                                        <span class="text-secondary small fw-bold text-uppercase">Celular</span>
                                        <span class="text-white small">{{ $persona->celular ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-0">
                                        <span class="text-secondary small fw-bold text-uppercase">Placa</span>
                                        <span class="text-white-50 small mono">{{ $persona->placa ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="d-grid grid-cols-2 gap-2 mt-auto">
                                    <a href="{{ route('personas.edit', $persona->id) }}"
                                        class="btn btn-outline-indigo py-2 rounded-3 fw-bold">
                                        <i class="bi bi-pencil me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('personas.destroy', $persona->id) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar persona?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold">
                                            <i class="bi bi-trash me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center text-secondary italic">
                            No se encontraron personas registradas.
                        </div>
                    @endforelse
                </div>
            </div>

            @if($personas->hasPages())
                <div class="card-footer bg-transparent border-top border-secondary border-opacity-10 p-4">
                    {{ $personas->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .custom-personas-table {
            background: transparent !important;
        }

        .bg-dark-soft {
            background-color: rgba(255, 255, 255, 0.03) !important;
        }

        .bg-primary-soft {
            background-color: rgba(79, 70, 229, 0.1) !important;
        }

        .border-glass {
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .border-glass-thin {
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
        }

        .grid-cols-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .avatar-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            border: 2px solid rgba(79, 70, 229, 0.2);
        }

        .avatar-sm-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .status-chip {
            padding: 4px 14px;
            border-radius: 2rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .status-danger {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .hover-highlight:hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
            transform: scale(1.002);
            z-index: 10;
        }

        .persona-mobile-card {
            background-color: rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
        }

        .persona-mobile-card:hover {
            background-color: rgba(255, 255, 255, 0.04);
            border-color: rgba(79, 70, 229, 0.2) !important;
        }

        .text-xs {
            font-size: 0.7rem;
        }

        .mono {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
        }

        .btn-indigo {
            background-color: #4f46e5;
            color: white;
        }

        .btn-indigo:hover {
            background-color: #4338ca;
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-indigo {
            color: #818cf8;
            border-color: rgba(129, 140, 248, 0.3);
        }

        .btn-outline-indigo:hover {
            background-color: rgba(79, 70, 229, 0.1);
            color: #818cf8;
            border-color: #818cf8;
        }

        .btn-dark-soft {
            background-color: rgba(26, 26, 26, 0.8);
            color: #9ca3af;
        }

        .btn-dark-soft:hover {
            background-color: #262626;
            color: white;
        }

        .hover-scale {
            transition: transform 0.2s;
        }

        .hover-scale:hover {
            transform: scale(1.03);
        }

        .hover-scale:active {
            transform: scale(0.98);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 1rem;
        }
    </style>
</x-app-layout>