<x-guest-layout>
    <div class="card login-card border-0 rounded-4 shadow-lg p-4 p-md-5">

        <!-- Cabecera -->
        <div class="text-center mb-4">
            <div class="app-icon mx-auto mb-3">
                <i class="bi bi-shield-lock-fill text-white fs-4"></i>
            </div>
            <h1 class="h4 fw-bold text-white mb-1">{{ config('app.name') }}</h1>
            <p class="text-secondary small mb-0">Ingresa tus credenciales para continuar</p>
        </div>

        <!-- Estado de sesión -->
        @if (session('status'))
            <div class="alert alert-success rounded-3 small py-2 mb-4" role="alert">
                <i class="bi bi-check-circle me-1"></i>{{ session('status') }}
            </div>
        @endif

        <!-- Errores -->
        @if ($errors->any())
            <div class="alert alert-danger rounded-3 small py-2 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Correo -->
            <div class="mb-3">
                <label for="email" class="form-label text-secondary fw-semibold text-uppercase small">
                    <i class="bi bi-envelope me-1"></i>Correo Electrónico
                </label>
                <input id="email" type="email" name="email"
                    class="form-control rounded-3 py-2 @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="usuario@correo.com">
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label text-secondary fw-semibold text-uppercase small">
                    <i class="bi bi-lock me-1"></i>Contraseña
                </label>
                <div class="input-group">
                    <input id="password" type="password" name="password"
                        class="form-control rounded-start-3 py-2 border-end-0 @error('password') is-invalid @enderror"
                        required autocomplete="current-password" placeholder="••••••••">
                    <button type="button" class="btn btn-outline-secondary border-start-0 rounded-end-3"
                        onclick="togglePassword()" tabindex="-1">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Recordarme -->
            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember"
                        style="cursor: pointer;">
                    <label class="form-check-label text-secondary small" for="remember_me" style="cursor: pointer;">
                        Recordar mi sesión
                    </label>
                </div>
            </div>

            <!-- Botón -->
            <button type="submit" class="btn btn-login w-100 py-2 rounded-3 fw-bold fs-6">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </form>
    </div>

    <p class="text-center text-secondary mt-3" style="font-size: 0.75rem;">
        <i class="bi bi-lock-fill me-1"></i>Acceso restringido — solo personal autorizado
    </p>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</x-guest-layout>
