<x-guest-layout>
    <div class="card login-card border-0 rounded-4 shadow-lg p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="h5 fw-bold text-white mb-1">Crear cuenta</h1>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <x-input-label for="name" value="Nombre" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="email" value="Correo electronico" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <x-input-label for="password" value="Contrasena" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div class="mb-4">
                <x-input-label for="password_confirmation" value="Confirmar contrasena" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
            <div class="d-flex align-items-center justify-content-end gap-3">
                <a href="{{ route('login') }}" class="text-secondary small">Ya tienes cuenta?</a>
                <x-primary-button>Registrarse</x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>