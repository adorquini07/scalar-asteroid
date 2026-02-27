<x-guest-layout>
    <div class="card login-card border-0 rounded-4 shadow-lg p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="h5 fw-bold text-white mb-1">Confirmar contrasena</h1>
            <p class="text-secondary small">Area segura. Confirma tu contrasena para continuar.</p>
        </div>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-4">
                <x-input-label for="password" value="Contrasena" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div class="d-flex justify-content-end">
                <x-primary-button>Confirmar</x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>