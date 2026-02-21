<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Estado en Tiempo Real') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($personas as $persona)
                    @php
                        $ultimo = $persona->ultimoRegistro;
                        
                        $bgColor = 'bg-gray-100 dark:bg-gray-800';
                        $statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Sin Datos</span>';
                        
                        if ($ultimo) {
                            if ($ultimo->tipo === 'llegada') {
                                $bgColor = 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800';
                                $statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Llegó 🟢</span>';
                            } elseif ($ultimo->tipo === 'salida') {
                                $bgColor = 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800';
                                $statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Salió 🔴</span>';
                            } elseif ($ultimo->tipo === 'busqueda') {
                                $bgColor = 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800';
                                $statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En Búsqueda 🟡</span>';
                            }
                        }
                    @endphp

                    <div class="overflow-hidden shadow-sm sm:rounded-lg border {{ $bgColor }} transition-all hover:shadow-md animate-fade-in">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold font-sans">{{ $persona->nombre }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $persona->apodo ?? 'Sin apodo' }} • {{ $persona->placa ?? 'Sin placa' }}</p>
                                </div>
                                <div>{!! $statusBadge !!}</div>
                            </div>
                            
                            <hr class="my-4 border-gray-200 dark:border-gray-700">
                            
                            @if($ultimo)
                                <div class="text-sm space-y-2">
                                    <p class="flex items-center text-gray-600 dark:text-gray-300">
                                        <svg class="h-4 w-4 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $ultimo->ubicacion ? $ultimo->ubicacion->nombre : 'Sin ubicación' }}
                                    </p>
                                    @if($ultimo->referido)
                                    <p class="flex items-center text-gray-600 dark:text-gray-300">
                                        <svg class="h-4 w-4 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $ultimo->referido }}
                                    </p>
                                    @endif
                                    <p class="mt-4 text-xs text-gray-400 text-right">
                                        Actualizado: {{ $ultimo->created_at->diffForHumans() }} por {{ $ultimo->user->name }}
                                    </p>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 text-center italic mt-6">Sin registros de actividad todavía.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($personas->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-center p-12">
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
</x-app-layout>
