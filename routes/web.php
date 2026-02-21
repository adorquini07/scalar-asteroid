<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UbicacionController;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/votacion-dashboard', [\App\Http\Controllers\VotacionDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('votacion.dashboard');

// API route: obtener ubicaciones por punto_apoyo_id (para cascading dropdown)
Route::get('/api/ubicaciones-por-punto/{puntoApoyoId}', function ($puntoApoyoId) {
    $ubicaciones = Ubicacion::where('punto_apoyo_id', $puntoApoyoId)->orderBy('nombre')->get();
    return response()->json($ubicaciones);
})->middleware('auth')->name('api.ubicaciones.por.punto');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin & Registradora
    Route::middleware('role:admin,registradora')->group(function () {
        Route::get('/registros/create', [RegistroController::class, 'create'])->name('registros.create');
        Route::post('/registros', [RegistroController::class, 'store'])->name('registros.store');
    });

    // Solo Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/registros', [RegistroController::class, 'index'])->name('registros.index');
        Route::resource('personas', PersonaController::class);
        Route::resource('users', UserController::class);
        Route::resource('ubicaciones', UbicacionController::class)->parameters([
            'ubicaciones' => 'ubicacion'
        ]);
    });
});

require __DIR__ . '/auth.php';
