<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotacionDashboardController extends Controller
{
    public function index()
    {
        // Obtener todas las ubicaciones con sus registros de llegada
        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        $estadisticas = [];
        $totalGeneral = 0;

        foreach ($ubicaciones as $ubicacion) {
            $mesasData = [];

            // Obtener registros de llegada para este puesto
            $registrosPuesto = \App\Models\Registro::where('ubicacion_id', $ubicacion->id)
                ->where('tipo', 'llegada')
                ->get();

            $totalUbicacion = $registrosPuesto->count();
            $totalGeneral += $totalUbicacion;

            if ($totalUbicacion > 0) {
                // Agrupar por mesa
                $registrosPorMesa = $registrosPuesto->groupBy('mesa_vota');

                foreach ($registrosPorMesa as $numMesa => $registros) {
                    $mesasData[$numMesa] = [
                        'numero' => $numMesa,
                        'total' => $registros->count(),
                        'personas' => $registros // Aquí pasamos los registros, que tienen 'referido'
                    ];
                }

                $estadisticas[] = [
                    'ubicacion' => $ubicacion,
                    'mesas' => $mesasData,
                    'total' => $totalUbicacion
                ];
            }
        }

        return view('votacion.dashboard', compact('estadisticas', 'totalGeneral'));
    }
}

