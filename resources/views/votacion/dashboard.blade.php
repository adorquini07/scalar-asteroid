<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
            <h2 class="h4 font-weight-bold mb-0 text-white">
                📊 Dashboard de Control de Votación
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline-light btn-sm fw-bold uppercase px-3 shadow-sm">
                   <i class="bi bi-people me-1"></i> Ver Estado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        
        <!-- Resumen General -->
        <div class="card border-0 shadow-lg mb-4 overflow-hidden rounded-4" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
            <div class="card-body p-4 p-md-5 text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="display-6 fw-black mb-1">Total Registrado</h3>
                        <p class="opacity-75 mb-0">Personas que han informado dónde votan</p>
                    </div>
                    <div class="bg-white text-indigo-600 rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <span class="h1 fw-black mb-0">{{ $totalGeneral }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if(empty($estadisticas))
            <div class="card border-0 shadow-lg rounded-4 text-center p-5 mt-5" style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
                <div class="display-1 mb-4">🗳️</div>
                <h4 class="text-white fw-bold">Aún no hay personas registradas</h4>
                <p class="text-secondary">Cuando registres personas con su puesto y mesa, aparecerán aquí.</p>
            </div>
        @else
            <!-- Estadísticas por Puesto de Votación -->
            <div class="row g-4">
                @foreach($estadisticas as $stat)
                    <div class="col-12">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: #0d0d0d; border-left: 5px solid #4f46e5 !important; border-top: 1px solid #1a1a1a !important; border-right: 1px solid #1a1a1a !important; border-bottom: 1px solid #1a1a1a !important;">
                            <div class="card-header border-0 py-4 px-4 bg-transparent d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                                <div>
                                    <h3 class="h4 fw-black text-white mb-1">
                                        <i class="bi bi-geo-alt-fill text-indigo-400 me-2"></i> {{ $stat['ubicacion']->nombre }}
                                    </h3>
                                    <p class="small text-secondary fw-bold mb-0">
                                        {{ $stat['ubicacion']->total_mesas }} MESAS DISPONIBLES
                                    </p>
                                </div>
                                <div class="mt-3 mt-sm-0">
                                    <span class="badge bg-indigo-600 rounded-pill px-4 py-2 fs-6 shadow-sm">
                                        {{ $stat['total'] }} {{ $stat['total'] == 1 ? 'persona' : 'personas' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body p-4 pt-0">
                                <hr class="my-4" style="border-color: #1a1a1a; opacity: 1;">
                                
                                <!-- Grid de Mesas -->
                                @if(!empty($stat['mesas']))
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                        @foreach($stat['mesas'] as $mesa)
                                            <div class="col">
                                                <div class="card h-100 rounded-4 border-0 shadow-sm" style="background-color: #151515; border: 1px solid #222 !important;">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                                            <h5 class="fw-black text-white mb-0">Mesa {{ $mesa['numero'] }}</h5>
                                                            <span class="badge bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                                                {{ $mesa['total'] }}
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="list-group list-group-flush bg-transparent">
                                                            @foreach($mesa['personas'] as $persona)
                                                                <div class="list-group-item bg-transparent border-0 px-0 py-2 mb-2">
                                                                    <div class="p-3 rounded-3" style="background-color: #1a1a1a; border: 1px solid #222;">
                                                                        <h6 class="fw-bold text-white mb-1 text-truncate">{{ $persona->nombre }}</h6>
                                                                        <div class="small d-flex flex-wrap gap-2 text-secondary fw-medium">
                                                                            <span><i class="bi bi-card-text me-1"></i> {{ $persona->cedula }}</span>
                                                                            @if($persona->celular)
                                                                                <span><i class="bi bi-phone me-1"></i> {{ $persona->celular }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Mesas Vacías -->
                                    @php
                                        $mesasConRegistro = array_keys($stat['mesas']);
                                        $mesasVacias = [];
                                        for ($i = 1; $i <= $stat['ubicacion']->total_mesas; $i++) {
                                            if (!in_array($i, $mesasConRegistro)) $mesasVacias[] = $i;
                                        }
                                    @endphp

                                    @if(!empty($mesasVacias))
                                        <div class="mt-5 p-4 rounded-4" style="background-color: rgba(255,255,255,0.02); border: 1px dashed #333 text-center;">
                                            <p class="small text-secondary fw-bold text-uppercase tracking-wider mb-2 text-center">Mesas sin registro actualmente</p>
                                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                                @foreach($mesasVacias as $m)
                                                    <span class="badge bg-dark border border-secondary text-secondary rounded-pill px-3 py-2 small opacity-50">
                                                        M-{{ $m }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-5 opacity-50">
                                        <p class="text-secondary mb-0">No hay personas registradas en este puesto aún.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Resumen Estadístico Final -->
            <div class="card border-0 shadow-lg rounded-4 mt-5 overflow-hidden" style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-black text-white mb-5 flex items-center gap-2">
                        <i class="bi bi-bar-chart-fill text-indigo-400"></i> RESUMEN ESTADÍSTICO
                    </h5>
                    <div class="row text-center g-4">
                        <div class="col-6 col-md-3">
                            <div class="h2 fw-black text-indigo-400 mb-0">{{ count($estadisticas) }}</div>
                            <div class="small fw-bold text-secondary uppercase tracking-tighter">Puestos</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="h2 fw-black text-green-400 mb-0">{{ $totalGeneral }}</div>
                            <div class="small fw-bold text-secondary uppercase tracking-tighter">Total Personas</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="h2 fw-black text-purple-400 mb-0">{{ collect($estadisticas)->sum(function($s) { return count($s['mesas']); }) }}</div>
                            <div class="small fw-bold text-secondary uppercase tracking-tighter">Mesas Activas</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="h2 fw-black text-orange-400 mb-0">{{ collect($estadisticas)->sum(function($s) { return $s['ubicacion']->total_mesas; }) }}</div>
                            <div class="small fw-bold text-secondary uppercase tracking-tighter">Mesas Totales</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Auto-refresh cada 30 segundos -->
    <script>
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>

    <style>
        .rounded-4 { border-radius: 1.5rem !important; }
        .fw-black { font-weight: 900 !important; }
        .tracking-tighter { letter-spacing: -0.05em; }
        .text-indigo-400 { color: #818cf8 !important; }
        .text-indigo-600 { color: #4f46e5 !important; }
        .bg-indigo-600 { background-color: #4f46e5 !important; }
        .opacity-75 { opacity: 0.75; }
    </style>
</x-app-layout>
