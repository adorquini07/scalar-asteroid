<x-guest-layout>
    <div class="card login-card border-0 rounded-4 shadow-lg p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="h5 fw-bold text-white mb-1">Recuperar contrasena</h1>
            <p class="text-secondary small">Ingresa tu correo y te enviaremos un enlace.</p>
        </div>
        <x-auth-session-status class="mb-3" :status="session('status')" />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <x-input-label for="email" value="Correo electronico" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div class="d-flex justify-content-end">
                <x-primary-button>Enviar enlace</x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>