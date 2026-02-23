<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <div class="pulsate-dot me-3"></div>
            <h2 class="h4 font-weight-bold mb-0 text-white">
                {{ __('Estado en Tiempo Real') }}
            </h2>
        </div>
    </x-slot>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 animate-fade-in" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">
            @foreach($personas as $persona)
                @php
                    $ultimo = $persona->ultimoRegistro;
                    $statusClass = 'status-none';
                    $statusLabel = 'Sin Datos';
                    $statusIcon = 'bi-dash-circle';

                    if ($ultimo) {
                        if ($ultimo->tipo === 'llegada') {
                            $statusClass = 'status-llegada';
                            $statusLabel = 'Llegó';
                            $statusIcon = 'bi-check-circle-fill';
                        } elseif ($ultimo->tipo === 'salida') {
                            $statusClass = 'status-salida';
                            $statusLabel = 'Salió';
                            $statusIcon = 'bi-arrow-right-circle-fill';
                        }
                    }
                @endphp

                <div class="col-12 col-md-6 col-lg-4 animate-fade-in">
                    <div class="card card-premium overflow-hidden {{ $statusClass }}">
                        <div class="card-body p-4">
                            <!-- Header: Name & Badge -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="h5 fw-bold mb-1 text-white tracking-tight">{{ $persona->nombre }}</h3>
                                    <div class="small text-secondary opacity-75">
                                        <span class="badge bg-dark-soft text-indigo-300 px-2 py-1 rounded-pill me-1">
                                            <i class="bi bi-tag-fill me-1"></i>{{ $persona->apodo ?? 'N/A' }}
                                        </span>
                                        <span class="badge bg-dark-soft text-secondary px-2 py-1 rounded-pill">
                                            <i class="bi bi-car-front-fill me-1"></i>{{ $persona->placa ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                <span class="badge-status {{ $statusClass }}">
                                    <i class="bi {{ $statusIcon }} me-1"></i> {{ $statusLabel }}
                                </span>
                            </div>

                            <hr class="my-3 border-secondary opacity-25">

                            <!-- Content logic -->
                            @if($ultimo)
                                @if($ultimo->tipo === 'llegada')
                                    <div class="space-y-3">
                                        <!-- Location -->
                                        <div class="info-well d-flex align-items-center p-3 rounded-4 mb-3">
                                            <div class="icon-box bg-success-soft text-success me-3">
                                                <i class="bi bi-geo-alt-fill"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="text-xs text-secondary text-uppercase fw-bold mb-1">Ubicación Actual
                                                </div>
                                                <div class="text-white fw-medium truncate small">
                                                    {{ $ultimo->ubicacion ? $ultimo->ubicacion->nombre : 'Sin ubicación' }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Referido & Mesa -->
                                        <div class="row g-2">
                                            @if($ultimo->referido)
                                                <div class="col-8">
                                                    <div class="info-well-sm p-2 px-3 rounded-pill bg-dark-soft border-glass-thin">
                                                        <span class="text-xs text-secondary me-1">Ref:</span>
                                                        <span class="small text-indigo-300 fw-bold">{{ $ultimo->referido }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($ultimo->mesa_vota)
                                                <div class="col-4">
                                                    <div
                                                        class="info-well-sm p-2 px-3 rounded-pill bg-indigo-soft border-indigo-thin text-center">
                                                        <span class="text-xs text-indigo-300 me-1">Mesa</span>
                                                        <span class="small text-white fw-bold">{{ $ultimo->mesa_vota }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="space-y-3">
                                        <!-- Call Prompt -->
                                        <div class="call-bridge d-flex align-items-center p-3 rounded-4 mb-3">
                                            <div class="icon-box bg-indigo-soft text-indigo-400 me-3 pulse-animation">
                                                <i class="bi bi-telephone-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="text-xs text-indigo-400 text-uppercase fw-bold mb-0 opacity-75">Llamada
                                                    Rápida</div>
                                                <a href="tel:{{ $persona->celular }}"
                                                    class="text-white fw-bold fs-5 text-decoration-none hover-indigo">
                                                    {{ $persona->celular ?? 'Sin Celular' }}
                                                </a>
                                            </div>
                                            <i class="bi bi-chevron-right text-secondary small"></i>
                                        </div>

                                        <div class="d-flex align-items-center bg-dark-soft p-2 px-3 rounded-4 border-glass-thin">
                                            <i class="bi bi-clock-history text-secondary me-2"></i>
                                            <span class="text-xs text-secondary">Fuera hace
                                                {{ $ultimo->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Footer Metadata -->
                                <div
                                    class="mt-4 d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-10">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="avatar-sm bg-dark-soft text-secondary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person text-xs"></i>
                                        </div>
                                        <span
                                            class="text-[10px] text-secondary text-uppercase fw-bold tracking-wider">{{ $ultimo->user->name }}</span>
                                    </div>
                                    <span
                                        class="text-[10px] text-secondary opacity-50">{{ $ultimo->created_at->format('H:i') }}</span>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="text-secondary opacity-25 mb-2">
                                        <i class="bi bi-clock fs-1"></i>
                                    </div>
                                    <p class="text-xs text-secondary italic mb-0">Sin actividad registrada</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($personas->isEmpty())
            <div class="text-center py-5">
                <div class="display-1 text-secondary opacity-10 mb-4">
                    <i class="bi bi-people"></i>
                </div>
                <h4 class="text-secondary">No hay personas monitoreadas</h4>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('personas.create') }}" class="btn btn-primary rounded-pill px-4 mt-3">
                        Agregar Primera Persona
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Floating Action Button -->
    @if(auth()->user()->isAdmin() || auth()->user()->isRegistradora())
        <a href="{{ route('registros.create') }}" class="fab-btn">
            <i class="bi bi-plus-lg fs-4"></i>
        </a>
    @endif

    <style>
        :root {
            --deep-black: #080808;
            --card-bg: #111111;
            --glass-border: rgba(255, 255, 255, 0.08);
            --indigo-accent: #6366f1;
        }

        body {
            background-color: var(--deep-black) !important;
        }

        .card-premium {
            background: var(--card-bg);
            border: 1px solid var(--glass-border) !important;
            border-radius: 1.5rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .card-premium:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.3) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .status-llegada {
            border-left: 4px solid #10b981 !important;
        }

        .status-salida {
            border-left: 4px solid #ef4444 !important;
        }

        .status-none {
            border-left: 4px solid #374151 !important;
        }

        .badge-status {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: 0.4rem 0.8rem;
            border-radius: 2rem;
            letter-spacing: 0.05em;
        }

        .badge-status.status-llegada {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .badge-status.status-salida {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .badge-status.status-none {
            background: rgba(55, 65, 81, 0.1);
            color: #9ca3af;
        }

        .info-well {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .bg-dark-soft {
            background: rgba(255, 255, 255, 0.05);
        }

        .bg-success-soft {
            background: rgba(16, 185, 129, 0.1);
        }

        .bg-indigo-soft {
            background: rgba(99, 102, 241, 0.1);
        }

        .icon-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .border-glass-thin {
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .border-indigo-thin {
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .call-bridge {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);
            transition: all 0.2s ease;
        }

        .call-bridge:hover {
            border-color: var(--indigo-accent);
            background: rgba(99, 102, 241, 0.15);
        }

        .hover-indigo:hover {
            color: var(--indigo-accent) !important;
        }

        .pulsate-dot {
            width: 10px;
            height: 10px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .fab-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 64px;
            height: 64px;
            background: var(--indigo-accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .fab-btn:hover {
            transform: scale(1.1) rotate(90deg);
            background: #4f46e5;
            color: white;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-[10px] {
            font-size: 10px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        setTimeout(function () {
            location.reload();
        }, 60000);
    </script>
</x-app-layout>