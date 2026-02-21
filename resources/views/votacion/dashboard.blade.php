<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 dark:text-gray-200 leading-tight">
                📊 Dashboard de Control de Votación
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center px-3 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    👥 Ver Estado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Resumen General -->
            <div class="mb-6 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold">Total Registrado para Votar</h3>
                        <p class="text-indigo-100 mt-1">Personas que han informado dónde votan</p>
                    </div>
                    <div class="text-5xl font-bold bg-white text-indigo-600 rounded-full w-24 h-24 flex items-center justify-center shadow-lg">
                        {{ $totalGeneral }}
                    </div>
                </div>
            </div>

            @if(empty($estadisticas))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-center p-12">
                    <div class="text-6xl mb-4">🗳️</div>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                        Aún no hay personas registradas para votar.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">
                        Cuando registres personas con su puesto y mesa de votación, aparecerán aquí.
                    </p>
                </div>
            @else
                <!-- Estadísticas por Puesto de Votación -->
                <div class="space-y-6">
                    @foreach($estadisticas as $stat)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-indigo-500">
                            <div class="p-4 md:p-6">
                                <!-- Encabezado del Puesto -->
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                            📍 {{ $stat['ubicacion']->nombre }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            Total: {{ $stat['ubicacion']->total_mesas }} mesas disponibles
                                        </p>
                                    </div>
                                    <div class="mt-3 sm:mt-0 flex items-center gap-3">
                                        <span class="px-4 py-2 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full font-bold text-lg">
                                            {{ $stat['total'] }} {{ $stat['total'] == 1 ? 'persona' : 'personas' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Grid de Mesas -->
                                @if(!empty($stat['mesas']))
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($stat['mesas'] as $mesa)
                                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-lg p-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-shadow">
                                                <div class="flex justify-between items-start mb-3">
                                                    <div>
                                                        <h4 class="font-bold text-lg text-gray-800 dark:text-gray-100">
                                                            Mesa {{ $mesa['numero'] }}
                                                        </h4>
                                                    </div>
                                                    <span class="px-3 py-1 bg-green-500 text-white rounded-full text-sm font-bold">
                                                        {{ $mesa['total'] }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Lista de personas -->
                                                <div class="space-y-2 mt-3 pt-3 border-t border-gray-300 dark:border-gray-500">
                                                    @foreach($mesa['personas'] as $persona)
                                                        <div class="bg-white dark:bg-gray-800 rounded p-2 text-sm">
                                                            <p class="font-semibold text-gray-900 dark:text-white truncate">
                                                                {{ $persona->nombre }}
                                                            </p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                CC: {{ $persona->cedula }}
                                                                @if($persona->celular)
                                                                    • 📱 {{ $persona->celular }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Mesas sin registro -->
                                    @php
                                        $mesasConRegistro = array_keys($stat['mesas']);
                                        $mesasSinRegistro = [];
                                        for ($i = 1; $i <= $stat['ubicacion']->total_mesas; $i++) {
                                            if (!in_array($i, $mesasConRegistro)) {
                                                $mesasSinRegistro[] = $i;
                                            }
                                        }
                                    @endphp

                                    @if(!empty($mesasSinRegistro))
                                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Mesas sin registro:</span>
                                                @foreach($mesasSinRegistro as $mesaNum)
                                                    <span class="inline-block px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded text-xs mr-1 mb-1">
                                                        Mesa {{ $mesaNum }}
                                                    </span>
                                                @endforeach
                                            </p>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-center text-gray-500 dark:text-gray-400 py-4">
                                        No hay personas registradas en este puesto aún.
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Resumen al final -->
                <div class="mt-8 bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📈 Resumen General</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                {{ count($estadisticas) }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Puestos Activos</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                                {{ $totalGeneral }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Total Personas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                {{ collect($estadisticas)->sum(function($stat) { return count($stat['mesas']); }) }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Mesas con Registro</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">
                                {{ collect($estadisticas)->sum(function($stat) { return $stat['ubicacion']->total_mesas; }) }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Total Mesas</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Auto-refresh cada 30 segundos -->
    <script>
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
</x-app-layout>
