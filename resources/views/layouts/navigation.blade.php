<nav class="navbar navbar-expand-sm border-bottom" style="background-color: #0d0d0d; border-color: #1a1a1a !important;">
    <div class="container-xl">
        <a class="navbar-brand me-4" href="{{ route('dashboard') }}">
            <x-application-logo class="d-block" style="height: 2.5rem; width: auto; fill: white;" />
        </a>
        <button class="navbar-toggler border-secondary" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('votacion.dashboard')" :active="request()->routeIs('votacion.dashboard')">
                        <i class="bi bi-bar-chart-fill me-1"></i> Votacion
                    </x-nav-link>
                </li>
                @if(auth()->user()->isAdmin() || auth()->user()->isRegistradora())
                    <li class="nav-item">
                        <x-nav-link :href="route('registros.create')" :active="request()->routeIs('registros.create')">
                            <i class="bi bi-plus-circle me-1"></i> Registro
                        </x-nav-link>
                    </li>
                @endif
                @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <x-nav-link :href="route('registros.index')" :active="request()->routeIs('registros.index')">
                            <i class="bi bi-clock-history me-1"></i> Historial
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('personas.index')" :active="request()->routeIs('personas.*')">
                            <i class="bi bi-people me-1"></i> Personas
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            <i class="bi bi-shield-lock me-1"></i> Usuarios
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ubicaciones.index')" :active="request()->routeIs('ubicaciones.*')">
                            <i class="bi bi-geo-alt me-1"></i> Ubicaciones
                        </x-nav-link>
                    </li>
                @endif
            </ul>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm rounded-pill d-flex align-items-center gap-2"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5" style="color: #818cf8;"></i>
                    <span class="text-light">{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down small opacity-50"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border border-secondary shadow-lg p-0"
                    style="background-color: #0d0d0d; min-width: 14rem;">
                    <li class="px-3 py-2 border-bottom border-secondary" style="background-color: rgba(255,255,255,0.03);">
                        <p class="text-secondary small fw-bold text-uppercase mb-0" style="font-size: 0.65rem; letter-spacing: 0.08em;">Usuario Autenticado</p>
                        <p class="text-white fw-bold mb-0 small">{{ Auth::user()->name }}</p>
                        <p class="text-secondary mb-0" style="font-size: 0.75rem;">{{ Auth::user()->email }}</p>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item text-secondary py-2 px-3 d-flex align-items-center gap-2">
                            <i class="bi bi-person-badge"></i> Mi Perfil
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger py-2 px-3 d-flex align-items-center gap-2 w-100 border-0" style="background: none;">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>