<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('ubicaciones.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="h4 fw-bold mb-0 text-white">
                <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Agregar Puesto de Votación
            </h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-lg"
                    style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('ubicaciones.store') }}">
                            @csrf

                            <!-- Punto de Apoyo -->
                            <div class="mb-4">
                                <label for="punto_apoyo_id" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-diagram-3 me-1 text-primary"></i>Punto de Apoyo al que pertenece <span class="text-danger">*</span>
                                </label>
                                <select id="punto_apoyo_id" name="punto_apoyo_id"
                                    class="form-select rounded-3 @error('punto_apoyo_id') is-invalid @enderror"
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
                                <label for="nombre" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-building me-1 text-primary"></i>Nombre del Puesto de Votación <span class="text-danger">*</span>
                                </label>
                                <input id="nombre" type="text" name="nombre"
                                    class="form-control rounded-3 @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre') }}" required autofocus
                                    placeholder="Ej: Institución Educativa Divino Niño">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total de Mesas -->
                            <div class="mb-4">
                                <label for="total_mesas" class="form-label text-secondary fw-semibold text-uppercase small">
                                    <i class="bi bi-table me-1 text-primary"></i>Total de Mesas en este Puesto <span class="text-danger">*</span>
                                </label>
                                <input id="total_mesas" type="number" min="0" name="total_mesas"
                                    class="form-control rounded-3 @error('total_mesas') is-invalid @enderror"
                                    value="{{ old('total_mesas', 0) }}" required placeholder="Ej: 7">
                                <div class="form-text text-secondary">
                                    <i class="bi bi-info-circle me-1"></i>Número de mesas habilitadas. Las mesas se generan del 1 al N.
                                </div>
                                @error('total_mesas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-25 gap-2">
                                <a href="{{ route('ubicaciones.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                    <i class="bi bi-x-lg me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 fw-bold">
                                    <i class="bi bi-geo-alt me-2"></i>Guardar Puesto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
