<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <h2 class="h4 font-weight-bold mb-0 text-white">
                <i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ __('Gestión de Puntos de Apoyo (Ubicaciones)') }}
            </h2>
            <a href="{{ route('ubicaciones.create') }}"
                class="btn btn-primary btn-lg px-4 rounded-3 fw-bold shadow-lg transition-transform hover-scale">
                <i class="bi bi-plus-circle-fill me-2"></i>Nuevo Punto
            </a>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <!-- Dashboard Style Filters -->
        <div class="card border-0 mb-4 rounded-4 shadow-lg overflow-hidden"
            style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
            <div class="card-body p-4">
                <form action="{{ route('ubicaciones.index') }}" method="GET" class="row g-3">
                    <div class="col-md-9">
                        <label class="form-label text-secondary small fw-bold text-uppercase">Búsqueda de Punto</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark-soft border-glass-thin text-secondary">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control bg-dark-soft border-glass-thin text-white"
                                placeholder="Nombre del punto de apoyo..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-indigo w-100 py-2 rounded-3 fw-bold shadow-sm">
                            <i class="bi bi-filter me-1"></i> Filtrar
                        </button>
                        @if(request()->anyFilled(['search']))
                            <a href="{{ route('ubicaciones.index') }}"
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

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Responsive Card/Table Wrapper -->
        <div class="card border-0 rounded-4 shadow-lg overflow-hidden"
            style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">

            {{-- Desktop View --}}
            <div class="d-none d-lg-block">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 align-middle custom-ubicaciones-table">
                        <thead>
                            <tr class="bg-dark-soft border-bottom border-secondary border-opacity-10">
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Nombre del Punto</th>
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase text-center">Registros
                                    Asociados</th>
                                <th class="px-4 py-3 text-end text-secondary small fw-bold text-uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary border-opacity-10">
                            @forelse($ubicaciones as $ubicacion)
                                <tr class="border-bottom border-secondary border-opacity-5 transition-all hover-highlight">
                                    <td class="px-4 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="location-icon bg-blue-soft text-blue-400 me-3">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-white fs-5">{{ $ubicacion->nombre }}</div>
                                                <div class="small text-secondary italic">Punto de Apoyo Principal</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span
                                            class="badge-count {{ $ubicacion->registros_count > 0 ? 'count-active' : 'count-zero' }}">
                                            <i class="bi bi-file-earmark-text me-1"></i>
                                            {{ $ubicacion->registros_count }} reporte(s)
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('ubicaciones.edit', $ubicacion->id) }}"
                                                class="btn btn-sm btn-dark-soft border-glass-thin text-indigo-400">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('ubicaciones.destroy', $ubicacion->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-nombre="{{ $ubicacion->nombre }}"
                                                    class="btn btn-sm btn-dark-soft border-glass-thin text-danger btn-confirm-delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-5 text-center text-secondary italic">
                                        <i class="bi bi-geo-fill fs-2 mb-2 d-block opacity-25"></i>
                                        No se encontraron puntos de apoyo registrados.
                                    </td>
                                </tr>
                                @-- slide --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile View --}}
            <div class="d-lg-none p-3">
                <div class="row g-3">
                    @forelse($ubicaciones as $ubicacion)
                        <div class="col-12 col-md-6">
                            <div class="location-mobile-card p-4 rounded-4 border-glass-thin h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="location-sm-icon bg-blue-soft text-blue-400 me-3">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white fs-5">{{ $ubicacion->nombre }}</div>
                                        </div>
                                    </div>
                                    <span
                                        class="badge-count {{ $ubicacion->registros_count > 0 ? 'count-active' : 'count-zero' }} py-1 px-2">
                                        {{ $ubicacion->registros_count }}
                                    </span>
                                </div>
                                <div class="d-flex gap-2 mt-3 pt-3 border-top border-secondary border-opacity-10">
                                    <a href="{{ route('ubicaciones.edit', $ubicacion->id) }}"
                                        class="btn btn-outline-indigo flex-grow-1 py-2 rounded-3 fw-bold">
                                        <i class="bi bi-pencil me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('ubicaciones.destroy', $ubicacion->id) }}" method="POST"
                                        class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" data-nombre="{{ $ubicacion->nombre }}"
                                            class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold btn-confirm-delete">
                                            <i class="bi bi-trash me-1"></i> Borrar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center text-secondary italic">
                            No se encontraron puntos de apoyo registrados.
                        </div>
                    @endforelse
                </div>
            </div>

            @if($ubicaciones->hasPages())
                <div class="card-footer bg-transparent border-top border-secondary border-opacity-10 p-4">
                    {{ $ubicaciones->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .custom-ubicaciones-table {
            background: transparent !important;
        }

        .bg-dark-soft {
            background-color: rgba(255, 255, 255, 0.03) !important;
        }

        .bg-blue-soft {
            background-color: rgba(59, 130, 246, 0.1) !important;
        }

        .border-glass {
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .border-glass-thin {
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
        }

        .location-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(59, 130, 246, 0.2);
            font-size: 1.5rem;
        }

        .location-sm-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .badge-count {
            padding: 6px 14px;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .count-active {
            background: rgba(52, 211, 153, 0.12);
            color: #34d399;
            border: 1px solid rgba(52, 211, 153, 0.25);
            box-shadow: 0 0 15px rgba(52, 211, 153, 0.1);
        }

        .count-zero {
            background: rgba(156, 163, 175, 0.12);
            color: #9ca3af;
            border: 1px solid rgba(156, 163, 175, 0.25);
        }

        .hover-highlight:hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
            transform: scale(1.002);
            z-index: 10;
        }

        .location-mobile-card {
            background-color: rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
        }

        .location-mobile-card:hover {
            background-color: rgba(255, 255, 255, 0.04);
            border-color: rgba(59, 130, 246, 0.2) !important;
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

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 1rem;
        }
    </style>
</x-app-layout>