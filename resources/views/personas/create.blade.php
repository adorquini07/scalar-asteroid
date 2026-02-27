<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('personas.index') }}" class="btn btn-sm btn-dark-soft border-glass-thin text-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="h4 fw-bold mb-0 text-white">
                <i class="bi bi-person-plus-fill me-2 text-primary"></i>Nueva Persona / Motociclista
            </h2>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('personas.store') }}">
                            @csrf

                            <!-- Cédula -->
                            <div class="mb-4">
                                <label for="cedula" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-card-text me-1 text-indigo-400"></i>Cédula o Documento de Identidad <span class="text-danger">*</span>
                                </label>
                                <input id="cedula" type="text" name="cedula"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('cedula') is-invalid @enderror"
                                    value="{{ old('cedula') }}" required autofocus placeholder="Ej: 1045612345">
                                @error('cedula')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombre -->
                            <div class="mb-4">
                                <label for="nombre" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-person me-1 text-indigo-400"></i>Nombre Completo <span class="text-danger">*</span>
                                </label>
                                <input id="nombre" type="text" name="nombre"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre') }}" required placeholder="Ej: Adrián Fernández">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Apodo -->
                            <div class="mb-4">
                                <label for="apodo" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-chat-quote me-1 text-indigo-400"></i>Apodo / Alias
                                    <span class="badge bg-secondary fw-normal ms-1" style="font-size:0.65rem;">Opcional</span>
                                </label>
                                <input id="apodo" type="text" name="apodo"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('apodo') is-invalid @enderror"
                                    value="{{ old('apodo') }}" placeholder="Ej: El Rápido">
                                @error('apodo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Celular -->
                            <div class="mb-4">
                                <label for="celular" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-phone me-1 text-indigo-400"></i>Celular / WhatsApp
                                    <span class="badge bg-secondary fw-normal ms-1" style="font-size:0.65rem;">Opcional</span>
                                </label>
                                <input id="celular" type="text" name="celular"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('celular') is-invalid @enderror"
                                    value="{{ old('celular') }}" placeholder="Ej: 3001234567">
                                @error('celular')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Placa -->
                            <div class="mb-4">
                                <label for="placa" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-motorcycle me-1 text-indigo-400"></i>Placa de la Moto
                                    <span class="badge bg-secondary fw-normal ms-1" style="font-size:0.65rem;">Opcional</span>
                                </label>
                                <input id="placa" type="text" name="placa"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 text-uppercase @error('placa') is-invalid @enderror"
                                    value="{{ old('placa') }}" placeholder="Ej: ABC-12D">
                                @error('placa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado activo -->
                            <div class="mb-4 p-4 rounded-3 border-glass"
                                style="background-color: rgba(79, 70, 229, 0.05); border: 1px solid rgba(79, 70, 229, 0.2) !important;">
                                <div class="form-check form-switch d-flex align-items-center gap-3 m-0">
                                    <input id="activo" type="checkbox"
                                        class="form-check-input" role="switch"
                                        name="activo" value="1" checked
                                        style="width: 3rem; height: 1.5rem; cursor: pointer;">
                                    <div>
                                        <label for="activo" class="form-check-label fw-semibold text-white mb-0" style="cursor:pointer;">
                                            <i class="bi bi-toggle-on me-1 text-success"></i>¿Persona Activa / Disponible?
                                        </label>
                                        <p class="text-secondary small mb-0 mt-1">
                                            Si está desactivado, no aparecerá en el formulario de registros.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-10 gap-2">
                                <a href="{{ route('personas.index') }}"
                                    class="btn btn-dark-soft border-glass-thin px-4 py-2 rounded-3 text-secondary">
                                    <i class="bi bi-x-lg me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-indigo px-5 py-2 rounded-3 fw-bold shadow-sm">
                                    <i class="bi bi-person-check-fill me-2"></i>Guardar Persona
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

        .border-glass {
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .border-glass-thin {
            border: 1px solid rgba(255, 255, 255, 0.07) !important;
        }

        .form-control.bg-dark-soft:focus {
            background-color: rgba(255, 255, 255, 0.07) !important;
            border-color: rgba(79, 70, 229, 0.5) !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
            color: white !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.2) !important;
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

        .form-check-input:checked {
            background-color: #4f46e5 !important;
            border-color: #4f46e5 !important;
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
