<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Nueva Persona/Moto') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('personas.store') }}" class="space-y-6">
                        @csrf

                        <!-- Cédula -->
                        <div>
                            <x-input-label for="cedula" :value="__('Cédula o Documento de Identidad')" />
                            <x-text-input id="cedula" class="block mt-1 w-full" type="text" name="cedula"
                                :value="old('cedula')" required autofocus placeholder="Ej: 1045612345" />
                            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                        </div>

                        <!-- Nombre -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre Completo')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre')" required placeholder="Ej: Adrián Fernández" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Apodo (Opcional) -->
                        <div>
                            <x-input-label for="apodo" :value="__('Apodo / Alias (Opcional)')" />
                            <x-text-input id="apodo" class="block mt-1 w-full" type="text" name="apodo"
                                :value="old('apodo')" placeholder="Ej: El Rápido" />
                            <x-input-error :messages="$errors->get('apodo')" class="mt-2" />
                        </div>

                        <!-- Celular (Opcional) -->
                        <div>
                            <x-input-label for="celular" :value="__('Celular / WhatsApp (Opcional)')" />
                            <x-text-input id="celular" class="block mt-1 w-full" type="text" name="celular"
                                :value="old('celular')" placeholder="Ej: 3001234567" />
                            <x-input-error :messages="$errors->get('celular')" class="mt-2" />
                        </div>

                        <!-- Placa (Opcional) -->
                        <div>
                            <x-input-label for="placa" :value="__('Placa de la Moto (Opcional)')" />
                            <x-text-input id="placa" class="block mt-1 w-full uppercase" type="text" name="placa"
                                :value="old('placa')" placeholder="Ej: ABC-12D" />
                            <x-input-error :messages="$errors->get('placa')" class="mt-2" />
                        </div>


                        <!-- Activo -->
                        <div
                            class="block mt-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                            <label for="activo" class="inline-flex items-center cursor-pointer">
                                <input id="activo" type="checkbox"
                                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 h-5 w-5"
                                    name="activo" value="1" checked>
                                <span
                                    class="ms-3 text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('¿Persona Activa / Disponible?') }}</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-2 ml-8">Si está desmarcado, no aparecerá en el formulario
                                de registros.</p>
                        </div>

                        <div
                            class="flex items-center justify-end mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('personas.index') }}"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Volver al listado') }}
                            </a>
                            <x-primary-button class="px-6 py-2">
                                {{ __('Guardar y Crear Persona') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>