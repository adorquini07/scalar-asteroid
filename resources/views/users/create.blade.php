<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="h4 fw-bold mb-0 text-white">
                <i class="bi bi-person-plus-fill me-2 text-primary"></i>Crear Nuevo Usuario
            </h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-lg"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Nombre -->
                            <div class="mb-4">
                                <label for="name" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-person me-1 text-primary"></i>Nombre Completo <span class="text-danger">*</span>
                                </label>
                                <input id="name" type="text" name="name"
                                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required autofocus placeholder="Ej: Juan Pérez">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-envelope me-1 text-primary"></i>Correo Electrónico <span class="text-danger">*</span>
                                </label>
                                <input id="email" type="email" name="email"
                                    class="form-control rounded-3 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required placeholder="Ej: usuario@correo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-4">
                                <label for="password" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-lock me-1 text-primary"></i>Contraseña <span class="text-danger">*</span>
                                </label>
                                <input id="password" type="password" name="password"
                                    class="form-control rounded-3 @error('password') is-invalid @enderror"
                                    required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rol -->
                            <div class="mb-4">
                                <label for="rol" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-shield-check me-1 text-primary"></i>Rol del Sistema <span class="text-danger">*</span>
                                </label>
                                <select id="rol" name="rol"
                                    class="form-select rounded-3 @error('rol') is-invalid @enderror"
                                    required>
                                    <option value="" disabled selected>Seleccione un rol...</option>
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
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-25 gap-2">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                    <i class="bi bi-x-lg me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 fw-bold">
                                    <i class="bi bi-person-check-fill me-2"></i>Crear Usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
