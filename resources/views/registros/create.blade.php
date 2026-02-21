<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Actividad') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('registros.store') }}" class="space-y-6">
                        @csrf

                        <!-- Persona -->
                        <div>
                            <x-input-label for="persona_id" :value="__('Persona / Motociclista')" />
                            <select id="persona_id" name="persona_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required autofocus>
                                <option value="" disabled selected>Seleccione una persona...</option>
                                @foreach($personas as $persona)
                                    <option value="{{ $persona->id }}">{{ $persona->nombre }}
                                        ({{ $persona->placa ?? 'Sin placa' }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('persona_id')" class="mt-2" />
                        </div>

                        <!-- Tipo de Movimiento -->
                        <div>
                            <x-input-label for="tipo" :value="__('Tipo de Reporte')" />
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                                <label
                                    class="border p-4 rounded-lg cursor-pointer transition-colors hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 has-[:checked]:bg-green-50 has-[:checked]:border-green-500 dark:has-[:checked]:bg-green-900/20 relative block text-center">
                                    <input type="radio" name="tipo" value="llegada"
                                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer" required>
                                    <div class="font-semibold text-green-600 dark:text-green-400">🟢 Llegada
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">Llegó a una base</div>
                                </label>
                                <label
                                    class="border p-4 rounded-lg cursor-pointer transition-colors hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 has-[:checked]:bg-red-50 has-[:checked]:border-red-500 dark:has-[:checked]:bg-red-900/20 relative block text-center">
                                    <input type="radio" name="tipo" value="salida"
                                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer">
                                    <div class="font-semibold text-red-600 dark:text-red-400">🔴 Salida
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">Salió en viaje</div>
                                </label>
                                <label
                                    class="border p-4 rounded-lg cursor-pointer transition-colors hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 has-[:checked]:bg-yellow-50 has-[:checked]:border-yellow-500 dark:has-[:checked]:bg-yellow-900/20 relative block text-center">
                                    <input type="radio" name="tipo" value="busqueda"
                                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer">
                                    <div class="font-semibold text-yellow-600 dark:text-yellow-400">🟡
                                        Búsqueda</div>
                                    <div class="text-xs text-gray-500 mt-1">En búsqueda</div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>

                        <!-- Referido -->
                        <div>
                            <x-input-label for="referido" :value="__('Referido / Acompañante')" />
                            <x-text-input id="referido" class="block mt-1 w-full" type="text" name="referido"
                                :value="old('referido')" placeholder="Ej: Nuvis, Julia..." />
                            <x-input-error :messages="$errors->get('referido')" class="mt-2" />
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <x-input-label for="ubicacion_id" :value="__('Ubicación Actual (Punto de Apoyo)')" />
                            <select id="ubicacion_id" name="ubicacion_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="" disabled selected>Seleccione un punto de apoyo...</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('ubicacion_id')" class="mt-2" />
                        </div>

                        <!-- Notas -->
                        <div>
                            <x-input-label for="notas" :value="__('Notas Adicionales (Opcional)')" />
                            <textarea id="notas" name="notas"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                rows="3">{{ old('notas') }}</textarea>
                            <x-input-error :messages="$errors->get('notas')" class="mt-2" />
                        </div>

                        <div
                            class="flex items-center justify-end mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <x-primary-button class="ms-4 px-8 py-3 text-lg w-full justify-center">
                                {{ __('Guardar Reporte') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>