<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Actividad') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12 animate-fade-in">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 md:p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('registros.store') }}" class="space-y-4 md:space-y-6">
                        @csrf

                        <!-- Persona -->
                        <div>
                            <x-input-label for="persona_id" :value="__('Persona / Motociclista')" />
                            <select id="persona_id" name="persona_id"
                                class="select2 mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-base md:text-sm"
                                required autofocus>
                                <option value="" disabled selected>Seleccione una persona...</option>
                                @foreach($personas as $persona)
                                    <option value="{{ $persona->id }}" data-placa="{{ $persona->placa ?? 'Sin placa' }}" data-celular="{{ $persona->celular ?? '' }}">
                                        {{ $persona->nombre }} ({{ $persona->placa ?? 'Sin placa' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('persona_id')" class="mt-2" />
                        </div>

                        <!-- Tipo de Movimiento - SOLO 2 OPCIONES -->
                        <div>
                            <x-input-label for="tipo" :value="__('Estado de la Persona')" />
                            <div class="grid grid-cols-2 gap-3 md:gap-4 mt-2">
                                <label
                                    class="bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 p-4 md:p-5 rounded-lg cursor-pointer transition-all hover:bg-green-50 dark:hover:bg-green-900/30 has-[:checked]:bg-green-50 has-[:checked]:border-green-500 has-[:checked]:shadow-lg dark:has-[:checked]:bg-green-900/40 dark:has-[:checked]:border-green-500 relative block text-center">
                                    <input type="radio" name="tipo" value="llegada"
                                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer" required>
                                    <div class="text-3xl md:text-4xl mb-2">🟢</div>
                                    <div class="font-bold text-base md:text-lg text-green-600 dark:text-green-400">Llegó</div>
                                    <div class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1">Llegó al punto</div>
                                </label>
                                <label
                                    class="bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 p-4 md:p-5 rounded-lg cursor-pointer transition-all hover:bg-red-50 dark:hover:bg-red-900/30 has-[:checked]:bg-red-50 has-[:checked]:border-red-500 has-[:checked]:shadow-lg dark:has-[:checked]:bg-red-900/40 dark:has-[:checked]:border-red-500 relative block text-center">
                                    <input type="radio" name="tipo" value="salida"
                                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer">
                                    <div class="text-3xl md:text-4xl mb-2">🔴</div>
                                    <div class="font-bold text-base md:text-lg text-red-600 dark:text-red-400">Salió</div>
                                    <div class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1">Salió en viaje</div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>

                        <!-- Ubicación con Select2 - PUESTO DE VOTACIÓN -->
                        <div>
                            <x-input-label for="ubicacion_id" :value="__('¿Dónde Vota? (Puesto de Votación)')" />
                            <select id="ubicacion_id" name="ubicacion_id"
                                class="select2 mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-base md:text-sm"
                                required>
                                <option value="" disabled selected>Seleccione un puesto de votación...</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}" data-mesas="{{ $ubicacion->total_mesas }}">
                                        {{ $ubicacion->nombre }} @if($ubicacion->total_mesas > 0)({{ $ubicacion->total_mesas }} mesas)@endif
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('ubicacion_id')" class="mt-2" />
                        </div>

                        <!-- Mesa de Votación - Se llena dinámicamente -->
                        <div id="mesa-container" style="display: none;">
                            <x-input-label for="mesa_vota" :value="__('¿En qué Mesa Vota?')" />
                            <select id="mesa_vota" name="mesa_vota"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-base md:text-sm">
                                <option value="">Seleccione una mesa...</option>
                            </select>
                            <x-input-error :messages="$errors->get('mesa_vota')" class="mt-2" />
                        </div>

                        <!-- Referido -->
                        <div>
                            <x-input-label for="referido" :value="__('Referido / Acompañante')" />
                            <x-text-input id="referido" class="block mt-1 w-full text-base md:text-sm" type="text" name="referido"
                                :value="old('referido')" placeholder="Ej: Nuvis, Julia..." />
                            <x-input-error :messages="$errors->get('referido')" class="mt-2" />
                        </div>

                        <!-- Notas -->
                        <div>
                            <x-input-label for="notas" :value="__('Notas Adicionales (Opcional)')" />
                            <textarea id="notas" name="notas"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-base md:text-sm"
                                rows="3">{{ old('notas') }}</textarea>
                            <x-input-error :messages="$errors->get('notas')" class="mt-2" />
                        </div>

                        <div
                            class="flex items-center justify-end mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <x-primary-button class="w-full justify-center px-6 py-3 md:py-3 text-base md:text-lg font-bold">
                                {{ __('💾 Guardar Registro') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- jQuery (requerido por Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Estilos personalizados para Select2 en móvil */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            height: 42px;
            padding: 8px 12px;
            border-radius: 0.375rem;
            border-color: #d1d5db;
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .select2-container--default .select2-selection--single {
                height: 38px;
                padding: 6px 12px;
                font-size: 0.875rem;
            }
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px;
            padding-left: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .select2-dropdown {
            border-radius: 0.375rem;
            border-color: #d1d5db;
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .select2-dropdown {
                font-size: 0.875rem;
            }
        }

        .select2-results__option {
            padding: 10px 12px;
        }

        @media (min-width: 768px) {
            .select2-results__option {
                padding: 8px 12px;
            }
        }

        /* Dark mode support */
        .dark .select2-container--default .select2-selection--single {
            background-color: rgb(17 24 39);
            border-color: rgb(55 65 81);
            color: rgb(209 213 219);
        }

        .dark .select2-dropdown {
            background-color: rgb(31 41 55);
            border-color: rgb(55 65 81);
            color: rgb(209 213 219);
        }

        .dark .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: rgb(79 70 229);
        }

        .dark .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: rgb(17 24 39);
            border-color: rgb(55 65 81);
            color: rgb(209 213 219);
        }
    </style>

    <script>
        $(document).ready(function() {
            // Inicializar Select2 para persona
            $('#persona_id').select2({
                placeholder: "Buscar persona...",
                allowClear: false,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                },
                width: '100%'
            });

            // Inicializar Select2 para ubicación
            $('#ubicacion_id').select2({
                placeholder: "Buscar puesto de votación...",
                allowClear: false,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                },
                width: '100%'
            });

            // Función para actualizar las mesas
            function actualizarMesas() {
                const ubicacionSelect = $('#ubicacion_id');
                const selectedOption = ubicacionSelect.find('option:selected');
                const totalMesas = parseInt(selectedOption.attr('data-mesas')) || 0;
                const mesaSelect = $('#mesa_vota');
                const mesaContainer = $('#mesa-container');
                
                console.log('Total de mesas:', totalMesas);
                
                // Limpiar opciones anteriores
                mesaSelect.empty();
                mesaSelect.append('<option value="">Seleccione una mesa...</option>');
                
                if (totalMesas > 0) {
                    // Llenar con las mesas disponibles
                    for (let i = 1; i <= totalMesas; i++) {
                        mesaSelect.append(`<option value="${i}">Mesa ${i}</option>`);
                    }
                    mesaContainer.slideDown(300);
                } else {
                    mesaContainer.slideUp(300);
                }
            }

            // Escuchar cambios en ubicación (funciona con Select2)
            $('#ubicacion_id').on('change', actualizarMesas);
            $('#ubicacion_id').on('select2:select', actualizarMesas);

            // Mejorar experiencia en móvil
            if (window.innerWidth < 768) {
                $('#persona_id, #ubicacion_id').select2('destroy');
                $('#persona_id, #ubicacion_id').select2({
                    placeholder: "Seleccionar...",
                    allowClear: false,
                    language: {
                        noResults: function() {
                            return "No se encontraron resultados";
                        },
                        searching: function() {
                            return "Buscando...";
                        }
                    },
                    width: '100%',
                    dropdownAutoWidth: true,
                    minimumResultsForSearch: 5
                });
                
                // Re-aplicar el listener después de reinicializar
                $('#ubicacion_id').on('change', actualizarMesas);
                $('#ubicacion_id').on('select2:select', actualizarMesas);
            }
        });
    </script>
</x-app-layout>