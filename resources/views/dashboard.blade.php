<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Estado en Tiempo Real') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach($personas as $persona)
                    @php
                        $ultimo = $persona->ultimoRegistro;
                        
                        $bgColor = 'bg-gray-100 dark:bg-gray-800';
                        $statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Sin Datos</span>';
                        
                        if ($ultimo) {
                            if ($ultimo->tipo === 'llegada') {
                                $bgColor = 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800';
                                $statusBadge = '<span class="px-3 py-1 inline-flex text-sm md:text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Llegó 🟢</span>';
                            } elseif ($ultimo->tipo === 'salida') {
                                $bgColor = 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800';
                                $statusBadge = '<span class="px-3 py-1 inline-flex text-sm md:text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Salió 🔴</span>';
                            } elseif ($ultimo->tipo === 'busqueda') {
                                $bgColor = 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800';
                                $statusBadge = '<span class="px-3 py-1 inline-flex text-sm md:text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En Búsqueda 🟡</span>';
                            }
                        }
                    @endphp

                    <div class="overflow-hidden shadow-sm sm:rounded-lg border {{ $bgColor }} transition-all hover:shadow-md animate-fade-in">
                        <div class="p-4 md:p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-start mb-3 md:mb-4">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg md:text-xl font-bold font-sans truncate">{{ $persona->nombre }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                        {{ $persona->apodo ?? 'Sin apodo' }} • {{ $persona->placa ?? 'Sin placa' }}
                                    </p>
                                </div>
                                <div class="ml-2 flex-shrink-0">{!! $statusBadge !!}</div>
                            </div>
                            
                            <hr class="my-3 md:my-4 border-gray-200 dark:border-gray-700">
                            
                            @if($ultimo)
                                <div class="text-sm space-y-3">
                                    @if($ultimo->tipo === 'llegada')
                                        <div class="flex items-center text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-900/40 p-2 rounded-lg">
                                            <i class="bi bi-geo-alt-fill text-green-500 me-2"></i>
                                            <span class="font-medium">En {{$ultimo->ubicacion ? $ultimo->ubicacion->nombre : 'Sin ubicación'}}</span>
                                        </div>
                                    @else
                                        <div class="space-y-2">
                                            <div class="flex items-center text-indigo-400 font-bold bg-indigo-500/10 p-3 rounded-lg border border-indigo-500/20">
                                                <i class="bi bi-telephone-fill me-2"></i>
                                                <a href="tel:{{ $persona->celular }}" class="hover:underline">{{ $persona->celular ?? 'Sin celular' }}</a>
                                            </div>
                                            <div class="text-xs text-gray-400 italic">
                                                <i class="bi bi-info-circle me-1"></i> En movimiento desde {{ $ultimo->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">
                                            Último movimiento: {{ $ultimo->created_at->format('H:i') }}
                                        </span>
                                        <span class="text-[10px] text-gray-400">
                                            {{ $ultimo->user->name }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 text-center italic mt-6">Sin registros de actividad todavía.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($personas->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-center p-8 md:p-12">
                    <p class="text-gray-500 dark:text-gray-400">No hay personas monitoreadas actualmente.</p>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('personas.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150">
                            Agregar Primera Persona
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Botón flotante para móvil - Nuevo Registro -->
    @if(auth()->user()->isAdmin() || auth()->user()->isRegistradora())
        <a href="{{ route('registros.create') }}" 
           class="fixed bottom-6 right-6 md:bottom-8 md:right-8 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 md:p-5 shadow-lg hover:shadow-xl transition-all duration-200 z-50 flex items-center justify-center group">
            <svg class="h-6 w-6 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="absolute right-full mr-3 bg-gray-900 text-white text-xs font-medium px-3 py-2 rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                Nuevo Registro
            </span>
        </a>
    @endif

    <!-- Script para auto-refresh del dashboard -->
    <script>
        // Auto-refresh cada 60 segundos
        setTimeout(function() {
            location.reload();
        }, 60000);
    </script>
</x-app-layout>
