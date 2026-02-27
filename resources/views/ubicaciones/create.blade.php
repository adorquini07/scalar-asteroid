<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('ubicaciones.index') }}" class="btn btn-sm btn-dark-soft border-glass-thin text-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="h4 fw-bold mb-0 text-white">
                <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Agregar Puesto de Votación
            </h2>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('ubicaciones.store') }}">
                            @csrf

                            <!-- Punto de Apoyo -->
                            <div class="mb-4">
                                <label for="punto_apoyo_id" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-diagram-3 me-1 text-indigo-400"></i>Punto de Apoyo al que pertenece <span class="text-danger">*</span>
                                </label>
                                <select id="punto_apoyo_id" name="punto_apoyo_id"
                                    class="form-select bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('punto_apoyo_id') is-invalid @enderror"
                                    required>
                                    <option value="" disabled selected>Seleccione un punto de apoyo...</option>
                                    @foreach($puntosApoyo as $punto)
                                        <option value="{{ $punto->id }}" {{ old('punto_apoyo_id') == $punto->id ? 'selected' : '' }}>
                                            {{ $punto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('punto_apoyo_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombre del Puesto -->
                            <div class="mb-4">
                                <label for="nombre" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-building me-1 text-indigo-400"></i>Nombre del Puesto de Votación <span class="text-danger">*</span>
                                </label>
                                <input id="nombre" type="text" name="nombre"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre') }}" required autofocus
                                    placeholder="Ej: Institución Educativa Divino Niño">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total de Mesas -->
                            <div class="mb-4">
                                <label for="total_mesas" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-table me-1 text-indigo-400"></i>Total de Mesas en este Puesto <span class="text-danger">*</span>
                                </label>
                                <input id="total_mesas" type="number" min="0" name="total_mesas"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('total_mesas') is-invalid @enderror"
                                    value="{{ old('total_mesas', 0) }}" required placeholder="Ej: 7">
                                <div class="mt-1 text-secondary" style="font-size: 0.75rem;">
                                    <i class="bi bi-info-circle me-1"></i>Número de mesas habilitadas. Las mesas se generan del 1 al N.
                                </div>
                                @error('total_mesas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-10 gap-2">
                                <a href="{{ route('ubicaciones.index') }}"
                                    class="btn btn-dark-soft border-glass-thin px-4 py-2 rounded-3 text-secondary">
                                    <i class="bi bi-x-lg me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-indigo px-5 py-2 rounded-3 fw-bold shadow-sm">
                                    <i class="bi bi-geo-alt me-2"></i>Guardar Puesto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dark-soft {
            background-color: rgba(255, 255, 255, 0.04) !important;
        }

        .border-glass-thin {
            border: 1px solid rgba(255, 255, 255, 0.07) !important;
        }

        .form-control.bg-dark-soft:focus,
        .form-select.bg-dark-soft:focus {
            background-color: rgba(255, 255, 255, 0.07) !important;
            border-color: rgba(79, 70, 229, 0.5) !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
            color: white !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.2) !important;
        }

        .form-select option {
            background-color: #1a1a1a;
            color: white;
        }

        .text-indigo-400 {
            color: #818cf8 !important;
        }

        .btn-indigo {
            background-color: #4f46e5;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-indigo:hover {
            background-color: #4338ca;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4) !important;
        }

        .btn-dark-soft {
            background-color: rgba(26, 26, 26, 0.8);
            color: #9ca3af;
            transition: all 0.2s ease;
        }

        .btn-dark-soft:hover {
            background-color: #262626;
            color: white;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
