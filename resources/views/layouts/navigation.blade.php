<nav x-data="{ open: false }" class="border-b" style="background-color: #0d0d0d; border-color: #1a1a1a !important;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <!-- Increased height for a more premium look -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105 duration-300">
                        <x-application-logo class="block h-10 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('votacion.dashboard')" :active="request()->routeIs('votacion.dashboard')">
                        <i class="bi bi-bar-chart-fill me-2"></i> Votación
                    </x-nav-link>

                    @if(auth()->user()->isAdmin() || auth()->user()->isRegistradora())
                        <x-nav-link :href="route('registros.create')" :active="request()->routeIs('registros.create')">
                            <i class="bi bi-plus-circle me-2"></i> Registro
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('registros.index')" :active="request()->routeIs('registros.index')">
                            <i class="bi bi-clock-history me-2"></i> Historial
                        </x-nav-link>
                        <x-nav-link :href="route('personas.index')" :active="request()->routeIs('personas.*')">
                            <i class="bi bi-people me-2"></i> Personas
                        </x-nav-link>
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            <i class="bi bi-shield-lock me-2"></i> Usuarios
                        </x-nav-link>
                        <x-nav-link :href="route('ubicaciones.index')" :active="request()->routeIs('ubicaciones.*')">
                            <i class="bi bi-geo-alt me-2"></i> Ubicaciones
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48"
                    contentClasses="py-1 bg-black border border-gray-800 shadow-2xl rounded-4 overflow-hidden">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-gray-800 text-sm leading-4 font-bold rounded-pill text-gray-300 bg-transparent hover:text-white hover:bg-gray-900 focus:outline-none transition ease-in-out duration-200 shadow-sm">
                            <div class="me-2 text-indigo-400">
                                <i class="bi bi-person-circle fs-5"></i>
                            </div>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-2 opacity-50">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 bg-gray-900/50 border-b border-gray-800 mb-1">
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-0">Usuario Autenticado
                            </p>
                            <p class="text-sm text-white fw-bold mb-0">{{ Auth::user()->name }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')"
                            class="text-gray-300 hover:bg-indigo-600 hover:text-white transition-colors py-2 px-4 flex items-center">
                            <i class="bi bi-person-badge me-2"></i> {{ __('Mi Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                class="text-danger hover:bg-danger hover:text-white transition-colors py-2 px-4 flex items-center"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-800 shadow-2xl">
        <div class="pt-2 pb-3 space-y-1 bg-black">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('votacion.dashboard')"
                :active="request()->routeIs('votacion.dashboard')">
                <i class="bi bi-bar-chart-fill me-2"></i> Votación
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin() || auth()->user()->isRegistradora())
                <x-responsive-nav-link :href="route('registros.create')" :active="request()->routeIs('registros.create')">
                    <i class="bi bi-plus-circle me-2"></i> Nuevo Registro
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('registros.index')" :active="request()->routeIs('registros.index')">
                    <i class="bi bi-clock-history me-2"></i> Historial
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('personas.index')" :active="request()->routeIs('personas.*')">
                    <i class="bi bi-people me-2"></i> Personas
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    <i class="bi bi-shield-lock me-2"></i> Usuarios
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('ubicaciones.index')" :active="request()->routeIs('ubicaciones.*')">
                    <i class="bi bi-geo-alt me-2"></i> Ubicaciones
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-800 bg-gray-950">
            <div class="px-4 flex items-center">
                <div class="bg-indigo-600 p-2 rounded-circle me-3">
                    <i class="bi bi-person-fill text-white"></i>
                </div>
                <div>
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-400 hover:text-white">
                    <i class="bi bi-person-badge me-2"></i> {{ __('Mi Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        class="text-danger hover:text-white hover:bg-danger/20"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>