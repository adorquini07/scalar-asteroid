<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('personas.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="h4 fw-bold mb-0 text-white">
                <i class="bi bi-pencil-square me-2 text-primary"></i>Editar Persona / Motociclista
            </h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-lg"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('personas.update', $persona->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Cédula -->
                            <div class="mb-4">
                                <label for="cedula" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-card-text me-1 text-primary"></i>Cédula o Documento de Identidad <span class="text-danger">*</span>
                                </label>
                                <input id="cedula" type="text" name="cedula"
                                    class="form-control rounded-3 @error('cedula') is-invalid @enderror"
                                    value="{{ old('cedula', $persona->cedula) }}" required autofocus
                                    placeholder="Ej: 1045612345">
                                @error('cedula')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombre -->
                            <div class="mb-4">
                                <label for="nombre" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-person me-1 text-primary"></i>Nombre Completo <span class="text-danger">*</span>
                                </label>
                                <input id="nombre" type="text" name="nombre"
                                    class="form-control rounded-3 @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre', $persona->nombre) }}" required
                                    placeholder="Ej: Adrián Fernández">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Apodo -->
                            <div class="mb-4">
                                <label for="apodo" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-chat-quote me-1 text-primary"></i>Apodo / Alias
                                    <span class="badge bg-secondary fw-normal ms-1" style="font-size:0.65rem;">Opcional</span>
                                </label>
                                <input id="apodo" type="text" name="apodo"
                                    class="form-control rounded-3 @error('apodo') is-invalid @enderror"
                                    value="{{ old('apodo', $persona->apodo) }}" placeholder="Ej: El Rápido">
                                @error('apodo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Celular -->
                            <div class="mb-4">
                                <label for="celular" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-phone me-1 text-primary"></i>Celular / WhatsApp
                                    <span class="badge bg-secondary fw-normal ms-1" style="font-size:0.65rem;">Opcional</span>
                                </label>
                                <input id="celular" type="text" name="celular"
                                    class="form-control rounded-3 @error('celular') is-invalid @enderror"
                                    value="{{ old('celular', $persona->celular) }}" placeholder="Ej: 3001234567">
                                @error('celular')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Placa -->
                            <div class="mb-4">
                                <label for="placa" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-motorcycle me-1 text-primary"></i>Placa de la Moto
                                    <span class="badge bg-secondary fw-normal ms-1" style="font-size:0.65rem;">Opcional</span>
                                </label>
                                <input id="placa" type="text" name="placa"
                                    class="form-control rounded-3 text-uppercase @error('placa') is-invalid @enderror"
                                    value="{{ old('placa', $persona->placa) }}" placeholder="Ej: ABC-12D">
                                @error('placa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado activo -->
                            <div class="mb-4 p-3 rounded-3 border border-primary border-opacity-25 bg-primary bg-opacity-10">
                                <div class="form-check form-switch d-flex align-items-center gap-3 m-0">
                                    <input id="activo" type="checkbox" class="form-check-input" role="switch"
                                        name="activo" value="1"
                                        {{ old('activo', $persona->activo) ? 'checked' : '' }}
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
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-25 gap-2">
                                <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                    <i class="bi bi-x-lg me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 fw-bold">
                                    <i class="bi bi-floppy me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
