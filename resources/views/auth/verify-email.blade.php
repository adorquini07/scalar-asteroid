<x-guest-layout>
    <div class="card login-card border-0 rounded-4 shadow-lg p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="h5 fw-bold text-white mb-1">Verificar correo</h1>
            <p class="text-secondary small">Haz clic en el enlace que enviamos a tu correo. Si no lo recibiste, solicita uno nuevo.</p>
        </div>
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success small">Nuevo enlace de verificacion enviado.</div>
        @endif
        <div class="d-flex align-items-center justify-content-between gap-3 mt-2">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>Reenviar correo</x-primary-button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-secondary small p-0">Cerrar sesion</button>
            </form>
        </div>
    </div>
</x-guest-layout>