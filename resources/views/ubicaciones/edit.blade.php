<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Puesto de Votación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('ubicaciones.update', ['ubicacione' => $ubicacion->id]) }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- Punto de Apoyo (padre) -->
                        <div>
                            <x-input-label for="punto_apoyo_id" :value="__('Punto de Apoyo al que pertenece')" />
                            <select id="punto_apoyo_id" name="punto_apoyo_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="" disabled>Seleccione un punto de apoyo...</option>
                                @foreach($puntosApoyo as $punto)
                                    <option value="{{ $punto->id }}"
                                        {{ old('punto_apoyo_id', $ubicacion->punto_apoyo_id) == $punto->id ? 'selected' : '' }}>
                                        {{ $punto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('punto_apoyo_id')" class="mt-2" />
                        </div>

                        <!-- Nombre del Puesto de Votación -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del Puesto de Votación')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre', $ubicacion->nombre)" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Total de Mesas -->
                        <div>
                            <x-input-label for="total_mesas" :value="__('Total de Mesas en este Puesto')" />
                            <x-text-input id="total_mesas" class="block mt-1 w-full" type="number" min="0" name="total_mesas"
                                :value="old('total_mesas', $ubicacion->total_mesas)" required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Número de mesas habilitadas. Las mesas se generan del 1 al N.</p>
                            <x-input-error :messages="$errors->get('total_mesas')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end pt-4 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('ubicaciones.index') }}"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                                {{ __('Cancelar') }}
                            </a>
                            <x-primary-button class="px-6 py-2">
                                {{ __('Actualizar Puesto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>