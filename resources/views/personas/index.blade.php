<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestión de Personas / Motociclistas') }}
            </h2>
            <a href="{{ route('personas.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-md">
                + Nueva Persona
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 rounded-r shadow-sm flex items-center"
                    role="alert">
                    <svg class="h-5 w-5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Vista de tabla para desktop -->
                <div class="hidden md:block p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Cédula</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nombre</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Apodo</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Celular</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Placa</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Estado</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($personas as $persona)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $persona->cedula }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $persona->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $persona->apodo ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $persona->celular ?? '-' }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600 dark:text-gray-200">
                                            {{ $persona->placa ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($persona->activo)
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-md bg-green-100 text-green-800 border-green-200 border">Activo</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-md bg-red-100 text-red-800 border-red-200 border">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('personas.edit', $persona->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Editar</a>
                                            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar a esta persona? Esto también afectará el historial de registros.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                            No hay personas registradas en el sistema. <br>
                                            <a href="{{ route('personas.create') }}"
                                                class="text-indigo-600 hover:underline mt-2 inline-block">Agrega tu primera
                                                persona</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Vista de tarjetas para móvil -->
                <div class="md:hidden p-4 text-gray-900 dark:text-gray-100">
                    @forelse($personas as $persona)
                        <div class="mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg {{ $persona->activo ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-900' }}">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-base truncate">{{ $persona->nombre }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">CC: {{ $persona->cedula }}</p>
                                </div>
                                <div class="ml-2 flex-shrink-0">
                                    @if($persona->activo)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-md bg-green-100 text-green-800">Activo</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-md bg-red-100 text-red-800">Inactivo</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="space-y-1 text-sm mb-3">
                                <p><span class="font-medium">Apodo:</span> {{ $persona->apodo ?? '-' }}</p>
                                <p><span class="font-medium">Celular:</span> {{ $persona->celular ?? '-' }}</p>
                                <p><span class="font-medium">Placa:</span> <span class="font-mono">{{ $persona->placa ?? '-' }}</span></p>
                                @if($persona->puesto_votacion)
                                <p class="text-xs text-purple-600 dark:text-purple-400">
                                    <span class="font-medium">Vota en:</span> {{ $persona->puesto_votacion }}
                                    @if($persona->mesa_votacion) - Mesa #{{ $persona->mesa_votacion }}@endif
                                </p>
                                @endif
                            </div>
                            
                            <div class="flex gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('personas.edit', $persona->id) }}"
                                    class="flex-1 text-center px-3 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700">
                                    Editar
                                </a>
                                <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar a esta persona?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-3 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            No hay personas registradas en el sistema. <br>
                            <a href="{{ route('personas.create') }}"
                                class="text-indigo-600 hover:underline mt-2 inline-block">Agrega tu primera persona</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>