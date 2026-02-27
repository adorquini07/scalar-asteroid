<x-guest-layout>
    <div class="card login-card border-0 rounded-4 shadow-lg p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="h5 fw-bold text-white mb-1">Nueva contrasena</h1>
        </div>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-3">
                <x-input-label for="email" value="Correo electronico" />
                <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <x-input-label for="password" value="Nueva contrasena" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div class="mb-4">
                <x-input-label for="password_confirmation" value="Confirmar contrasena" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
            <div class="d-flex justify-content-end">
                <x-primary-button>Restablecer contrasena</x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>