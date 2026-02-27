<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-dark-soft border-glass-thin text-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="h4 fw-bold mb-0 text-white">
                <i class="bi bi-person-plus-fill me-2 text-primary"></i>Crear Nuevo Usuario
            </h2>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Nombre -->
                            <div class="mb-4">
                                <label for="name" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-person me-1 text-indigo-400"></i>Nombre Completo <span class="text-danger">*</span>
                                </label>
                                <input id="name" type="text" name="name"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required autofocus placeholder="Ej: Juan Pérez">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-envelope me-1 text-indigo-400"></i>Correo Electrónico <span class="text-danger">*</span>
                                </label>
                                <input id="email" type="email" name="email"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required placeholder="Ej: usuario@correo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-4">
                                <label for="password" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-lock me-1 text-indigo-400"></i>Contraseña <span class="text-danger">*</span>
                                </label>
                                <input id="password" type="password" name="password"
                                    class="form-control bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('password') is-invalid @enderror"
                                    required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rol -->
                            <div class="mb-4">
                                <label for="rol" class="form-label text-secondary small fw-bold text-uppercase">
                                    <i class="bi bi-shield-check me-1 text-indigo-400"></i>Rol del Sistema <span class="text-danger">*</span>
                                </label>
                                <select id="rol" name="rol"
                                    class="form-select bg-dark-soft border-glass-thin text-white rounded-3 py-2 px-3 @error('rol') is-invalid @enderror"
                                    required>
                                    <option value="" disabled selected class="text-secondary">Seleccione un rol...</option>
                                    <option value="admin" {{ old('rol') === 'admin' ? 'selected' : '' }}>
                                        Administrador — Acceso total
                                    </option>
                                    <option value="registradora" {{ old('rol') === 'registradora' ? 'selected' : '' }}>
                                        Registradora — Solo formularios y listado actual
                                    </option>
                                    <option value="visor" {{ old('rol') === 'visor' ? 'selected' : '' }}>
                                        Visor — Solo ver ubicaciones
                                    </option>
                                </select>
                                @error('rol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-10 gap-2">
                                <a href="{{ route('users.index') }}"
                                    class="btn btn-dark-soft border-glass-thin px-4 py-2 rounded-3 text-secondary">
                                    <i class="bi bi-x-lg me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-indigo px-5 py-2 rounded-3 fw-bold shadow-sm">
                                    <i class="bi bi-person-check-fill me-2"></i>Crear Usuario
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
