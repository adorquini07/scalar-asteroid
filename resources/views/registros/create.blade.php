<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Actividad') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-5 md:p-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('registros.store') }}" class="space-y-6">
                        @csrf

                        {{-- ===== PERSONA ===== --}}
                        <div>
                            <x-input-label for="persona_id" :value="__('Persona / Motociclista')" />
                            <select id="persona_id" name="persona_id"
                                class="select2 mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required autofocus>
                                <option value="" disabled selected>Seleccione una persona...</option>
                                @foreach($personas as $persona)
                                    <option value="{{ $persona->id }}">
                                        {{ $persona->nombre }} ({{ $persona->placa ?? 'Sin placa' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('persona_id')" class="mt-2" />
                        </div>

                        {{-- ===== TIPO LLEGÓ / SALIÓ ===== --}}
                        <div>
                            <x-input-label for="tipo" :value="__('Estado de la Persona')" />
                            <div class="flex flex-row gap-3 mt-2">
                                <label class="flex-1 flex flex-col items-center justify-center text-center p-4 md:p-5 min-h-[110px] rounded-xl border-2 cursor-pointer transition-all
                                    bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600
                                    hover:bg-green-50 dark:hover:bg-green-900/30
                                    has-[:checked]:bg-green-50 dark:has-[:checked]:bg-green-900/40
                                    has-[:checked]:border-green-500 has-[:checked]:shadow-md">
                                    <input type="radio" name="tipo" value="llegada" class="opacity-0 absolute w-0 h-0" required>
                                    <div class="text-3xl mb-1">🟢</div>
                                    <div class="font-bold text-base md:text-lg text-green-600 dark:text-green-400">Llegó</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Al punto</div>
                                </label>
                                <label class="flex-1 flex flex-col items-center justify-center text-center p-4 md:p-5 min-h-[110px] rounded-xl border-2 cursor-pointer transition-all
                                    bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600
                                    hover:bg-red-50 dark:hover:bg-red-900/30
                                    has-[:checked]:bg-red-50 dark:has-[:checked]:bg-red-900/40
                                    has-[:checked]:border-red-500 has-[:checked]:shadow-md">
                                    <input type="radio" name="tipo" value="salida" class="opacity-0 absolute w-0 h-0">
                                    <div class="text-3xl mb-1">🔴</div>
                                    <div class="font-bold text-base md:text-lg text-red-600 dark:text-red-400">Salió</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">En viaje</div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>

                        {{-- ===== PUNTO DE APOYO ===== --}}
                        <div>
                            <x-input-label for="punto_apoyo_id" :value="__('Punto de Apoyo')" />
                            <select id="punto_apoyo_id" name="punto_apoyo_id"
                                class="select2 mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="" disabled selected>Seleccione un punto de apoyo...</option>
                                @foreach($puntosApoyo as $punto)
                                    <option value="{{ $punto->id }}">{{ $punto->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('punto_apoyo_id')" class="mt-2" />
                        </div>

                        {{-- ===== DATOS DE VOTACIÓN (aparece al seleccionar Llegó) ===== --}}
                        <div id="votacion-container" style="display: none;"
                            class="bg-gray-50 dark:bg-gray-700/50 p-5 rounded-xl border border-gray-200 dark:border-gray-600 space-y-5">

                            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-600 pb-2">
                                📋 Datos de Votación
                            </h3>

                            {{-- Puesto de Votación (filtrado por Punto de Apoyo) --}}
                            <div>
                                <x-input-label for="ubicacion_id" :value="__('¿Dónde Vota? (Puesto de Votación)')" />
                                <select id="ubicacion_id" name="ubicacion_id"
                                    class="select2 mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                    <option value="">— Primero seleccione un Punto de Apoyo —</option>
                                </select>
                                <x-input-error :messages="$errors->get('ubicacion_id')" class="mt-2" />
                            </div>

                            {{-- Mesa de Votación (aparece al seleccionar puesto) --}}
                            <div id="mesa-container" style="display: none;">
                                <x-input-label for="mesa_vota" :value="__('¿En qué Mesa Vota?')" />
                                <div id="mesa-lista" class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-2 mt-2">
                                    {{-- Se llena dinámicamente --}}
                                </div>
                                <input type="hidden" id="mesa_vota" name="mesa_vota">
                                <x-input-error :messages="$errors->get('mesa_vota')" class="mt-2" />
                            </div>
                        </div>

                        {{-- ===== REFERIDO Y NOTAS (en grid) ===== --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <x-input-label for="referido" :value="__('Referido / Acompañante')" />
                                <x-text-input id="referido" class="block mt-1 w-full" type="text" name="referido"
                                    :value="old('referido')" placeholder="Ej: Nuvis, Julia..." />
                                <x-input-error :messages="$errors->get('referido')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="notas" :value="__('Notas Adicionales (Opcional)')" />
                                <textarea id="notas" name="notas" rows="2"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notas') }}</textarea>
                                <x-input-error :messages="$errors->get('notas')" class="mt-2" />
                            </div>
                        </div>

                        {{-- ===== BOTÓN GUARDAR ===== --}}
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                            <x-primary-button class="w-full justify-center py-3 text-base md:text-lg font-bold">
                                {{ __('💾 Guardar Registro') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {

            const s2 = {
                theme: 'bootstrap-5',
                width: '100%',
                language: {
                    noResults: () => "Sin resultados",
                    searching: () => "Buscando..."
                }
            };

            $('#persona_id').select2({ ...s2, placeholder: 'Buscar persona...' });
            $('#punto_apoyo_id').select2({ ...s2, placeholder: 'Seleccione un punto de apoyo...' });
            $('#ubicacion_id').select2({ ...s2, placeholder: '— Primero seleccione un Punto de Apoyo —' });

            // ─── Mostrar/ocultar sección de votación según tipo ───
            function toggleVotacion() {
                const tipo = $('input[name="tipo"]:checked').val();
                if (tipo === 'llegada') {
                    $('#votacion-container').slideDown(250);
                    // ubicacion_id es requerido solo si llegó
                    $('#ubicacion_id').prop('required', true);
                } else {
                    $('#votacion-container').slideUp(250);
                    $('#ubicacion_id').prop('required', false);
                }
            }
            $('input[name="tipo"]').on('change', toggleVotacion);
            toggleVotacion();

            // ─── Cargar puestos de votación al elegir Punto de Apoyo ───
            $('#punto_apoyo_id').on('change', function () {
                const puntoId = $(this).val();
                const $ubicacionSelect = $('#ubicacion_id');

                $ubicacionSelect.empty().append('<option value="">Cargando...</option>').trigger('change');
                $('#mesa-container').hide();
                $('#mesa-lista').empty();
                $('#mesa_vota').val('');

                if (!puntoId) return;

                $.ajax({
                    url: '/api/ubicaciones-por-punto/' + puntoId,
                    type: 'GET',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (data) {
                        $ubicacionSelect.empty().append('<option value="">Seleccione un puesto de votación...</option>');
                        if (data.length === 0) {
                            $ubicacionSelect.append('<option value="" disabled>No hay puestos para este punto</option>');
                        } else {
                            $.each(data, function (i, u) {
                                $ubicacionSelect.append(
                                    `<option value="${u.id}" data-mesas="${u.total_mesas}">${u.nombre}</option>`
                                );
                            });
                        }
                        $ubicacionSelect.trigger('change');
                    },
                    error: function () {
                        $ubicacionSelect.empty().append('<option value="">Error al cargar puestos</option>').trigger('change');
                    }
                });
            });

            // ─── Mostrar mesas al elegir puesto de votación ───
            $('#ubicacion_id').on('change', function () {
                const selectedOption = $(this).find('option:selected');
                const totalMesas = parseInt(selectedOption.attr('data-mesas')) || 0;
                const $lista = $('#mesa-lista');
                const $container = $('#mesa-container');

                $lista.empty();
                $('#mesa_vota').val('');

                if (totalMesas > 0) {
                    for (let i = 1; i <= totalMesas; i++) {
                        $lista.append(`
                            <button type="button" data-mesa="${i}"
                                class="mesa-btn py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600
                                       text-sm font-bold text-gray-700 dark:text-gray-300
                                       hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/30
                                       transition-all text-center w-full">
                                Mesa ${i}
                            </button>`);
                    }
                    $container.slideDown(250);
                } else {
                    $container.slideUp(250);
                }
            });

            // ─── Seleccionar mesa ───
            $(document).on('click', '.mesa-btn', function () {
                $('.mesa-btn').removeClass('border-indigo-500 bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300');
                $(this).addClass('border-indigo-500 bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300');
                $('#mesa_vota').val($(this).data('mesa'));
            });

        });
    </script>
</x-app-layout>