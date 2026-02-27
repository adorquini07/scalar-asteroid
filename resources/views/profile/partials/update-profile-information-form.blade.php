<section>
    <h2 class="fw-semibold fs-5 text-white mb-1">Informacion del Perfil</h2>
    <p class="text-secondary small mb-4">Actualiza tu nombre y correo electronico.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label for="name" value="Nombre" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" value="Correo electronico" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-warning small mt-1">
                    Tu correo no esta verificado.
                    <button form="send-verification" class="btn btn-link btn-sm p-0 text-warning">Reenviar verificacion</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="text-success small">Enlace de verificacion enviado.</p>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <x-primary-button>Guardar</x-primary-button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small">Guardado.</span>
            @endif
        </div>
    </form>
</section>