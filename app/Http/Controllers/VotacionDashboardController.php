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
        // Obtener todas las ubicaciones
        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        $estadisticas = [];
        $totalGeneral = 0;

        foreach ($ubicaciones as $ubicacion) {
            $mesasData = [];

            // Obtener registros de votos para este puesto
            $votosPuesto = \App\Models\Voto::where('ubicacion_id', $ubicacion->id)
                ->get();

            $totalUbicacion = $votosPuesto->count();
            $totalGeneral += $totalUbicacion;

            if ($totalUbicacion > 0) {
                // Agrupar por mesa
                $votosPorMesa = $votosPuesto->groupBy('mesa');

                foreach ($votosPorMesa as $numMesa => $votos) {
                    $mesasData[$numMesa] = [
                        'numero' => $numMesa,
                        'total' => $votos->count(),
                        'votos' => $votos
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

