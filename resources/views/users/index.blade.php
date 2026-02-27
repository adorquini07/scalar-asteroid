<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <h2 class="h4 font-weight-bold mb-0 text-white">
                <i class="bi bi-person-badge-fill me-2 text-primary"></i>{{ __('Gestión de Usuarios') }}
            </h2>
            <a href="{{ route('users.create') }}"
                class="btn btn-primary btn-lg px-4 rounded-3 fw-bold shadow-lg transition-transform hover-scale">
                <i class="bi bi-person-plus-fill me-2"></i>Nuevo Usuario
            </a>
        </div>
    </x-slot>

    <div class="container py-4 animate-fade-in">
        <!-- Filtros -->
        <div class="card border-0 mb-4 rounded-4 shadow-lg"
            style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">
            <div class="card-body p-4">
                <form action="{{ route('users.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-12 col-md-6">
                        <label class="form-label text-secondary fw-semibold text-uppercase small">
                            <i class="bi bi-search me-1"></i>Búsqueda Rápida
                        </label>
                        <input type="text" name="search" class="form-control rounded-3"
                            placeholder="Nombre o Email..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label text-secondary fw-semibold text-uppercase small">
                            <i class="bi bi-shield-check me-1"></i>Rol
                        </label>
                        <select name="rol" class="form-select rounded-3">
                            <option value="">Todos los roles</option>
                            <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="registradora" {{ request('rol') == 'registradora' ? 'selected' : '' }}>Registradora</option>
                            <option value="visor" {{ request('rol') == 'visor' ? 'selected' : '' }}>Visor</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold">
                            <i class="bi bi-filter me-1"></i> Filtrar
                        </button>
                        @if(request()->anyFilled(['search', 'rol']))
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-3 px-3" title="Limpiar filtros">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Responsive Card/Table Wrapper -->
        <div class="card border-0 rounded-4 shadow-lg overflow-hidden"
            style="background-color: #0d0d0d; border: 1px solid #1a1a1a !important;">

            {{-- Desktop View --}}
            <div class="d-none d-lg-block">
                <div class="table-responsive">
                    <table class="table table-dark mb-0 align-middle custom-users-table">
                        <thead>
                            <tr class="bg-dark-soft border-bottom border-secondary border-opacity-10">
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Nombre de Usuario</th>
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Email / Contacto</th>
                                <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">Rol / Permisos</th>
                                <th class="px-4 py-3 text-end text-secondary small fw-bold text-uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary border-opacity-10">
                            @forelse($users as $user)
                                <tr class="border-bottom border-secondary border-opacity-5">
                                    <td class="px-4 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-indigo-soft text-indigo-400 me-3">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="fw-bold text-white">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-white-50">
                                        <div class="small"><i
                                                class="bi bi-envelope me-2 text-indigo-400"></i>{{ $user->email }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($user->rol === 'admin')
                                            <span class="role-badge role-admin">Administrador</span>
                                        @elseif($user->rol === 'registradora')
                                            <span class="role-badge role-registradora">Registradora</span>
                                        @else
                                            <span class="role-badge role-visor">Visor</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-dark-soft border-glass-thin text-indigo-400">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-nombre="{{ $user->name }}"
                                                        class="btn btn-sm btn-dark-soft border-glass-thin text-danger btn-confirm-delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-5 text-center text-secondary italic">
                                        <i class="bi bi-person-exclamation fs-2 mb-2 d-block opacity-25"></i>
                                        No se encontraron usuarios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile View --}}
            <div class="d-lg-none p-3">
                <div class="row g-3">
                    @forelse($users as $user)
                        <div class="col-12 col-md-6">
                            <div class="user-mobile-card p-4 rounded-4 border-glass-thin h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm-circle bg-indigo-soft text-indigo-400 me-3">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white fs-5">{{ $user->name }}</div>
                                            <div class="text-xs text-secondary italic">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                    @if($user->rol === 'admin')
                                        <span class="role-badge role-admin">Admin</span>
                                    @elseif($user->rol === 'registradora')
                                        <span class="role-badge role-registradora">Reg</span>
                                    @else
                                        <span class="role-badge role-visor">Visor</span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2 mt-3 pt-3 border-top border-secondary border-opacity-10">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-outline-indigo flex-grow-1 py-2 rounded-3 fw-bold">
                                        <i class="bi bi-pencil me-1"></i> Editar
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-nombre="{{ $user->name }}"
                                                class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold btn-confirm-delete">
                                                <i class="bi bi-trash me-1"></i> Borrar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center text-secondary italic">
                            No se encontraron usuarios registrados.
                        </div>
                    @endforelse
                </div>
            </div>

            @if($users->hasPages())
                <div class="card-footer bg-transparent border-top border-secondary border-opacity-10 p-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .custom-users-table {
            background: transparent !important;
        }

        .bg-dark-soft {
            background-color: rgba(255, 255, 255, 0.03) !important;
        }

        .bg-indigo-soft {
            background-color: rgba(79, 70, 229, 0.1) !important;
        }

        .border-glass {
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .border-glass-thin {
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(79, 70, 229, 0.2);
            font-size: 1.2rem;
        }

        .avatar-sm-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .role-badge {
            padding: 4px 12px;
            border-radius: 2rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
        }

        .role-admin {
            background: rgba(168, 85, 247, 0.12);
            color: #c084fc;
            border: 1px solid rgba(168, 85, 247, 0.25);
        }

        .role-registradora {
            background: rgba(59, 130, 246, 0.12);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }

        .role-visor {
            background: rgba(156, 163, 175, 0.12);
            color: #d1d5db;
            border: 1px solid rgba(156, 163, 175, 0.25);
        }

        .user-mobile-card {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .text-xs {
            font-size: 0.7rem;
        }

        .btn-indigo {
            background-color: #4f46e5;
            color: white;
        }

        .btn-indigo:hover {
            background-color: #4338ca;
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-indigo {
            color: #818cf8;
            border-color: rgba(129, 140, 248, 0.3);
        }

        .btn-outline-indigo:hover {
            background-color: rgba(79, 70, 229, 0.1);
            color: #818cf8;
            border-color: #818cf8;
        }

        .btn-dark-soft {
            background-color: rgba(26, 26, 26, 0.8);
            color: #9ca3af;
        }

        .btn-dark-soft:hover {
            background-color: #262626;
            color: white;
        }

        .hover-scale {
            transition: transform 0.2s;
        }

        .hover-scale:hover {
            transform: scale(1.03);
        }

        .hover-scale:active {
            transform: scale(0.98);
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

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 1rem;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 1rem;
        }
    </style>
</x-app-layout>