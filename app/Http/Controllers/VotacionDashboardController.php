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
        // Obtener todas las ubicaciones con sus mesas
        $ubicaciones = Ubicacion::orderBy('nombre')->get();
        
        // Obtener estadísticas por ubicación y mesa
        $estadisticas = [];
        
        foreach ($ubicaciones as $ubicacion) {
            $mesasData = [];
            
            // Obtener el conteo de personas por mesa en este puesto
            for ($mesa = 1; $mesa <= $ubicacion->total_mesas; $mesa++) {
                $count = Persona::where('puesto_votacion', $ubicacion->nombre)
                    ->where('mesa_votacion', $mesa)
                    ->count();
                
                if ($count > 0) {
                    $mesasData[$mesa] = [
                        'numero' => $mesa,
                        'total' => $count,
                        'personas' => Persona::where('puesto_votacion', $ubicacion->nombre)
                            ->where('mesa_votacion', $mesa)
                            ->select('nombre', 'cedula', 'celular')
                            ->get()
                    ];
                }
            }
            
            $totalUbicacion = Persona::where('puesto_votacion', $ubicacion->nombre)->count();
            
            if ($totalUbicacion > 0 || !empty($mesasData)) {
                $estadisticas[] = [
                    'ubicacion' => $ubicacion,
                    'mesas' => $mesasData,
                    'total' => $totalUbicacion
                ];
            }
        }
        
        // Total general
        $totalGeneral = Persona::whereNotNull('puesto_votacion')->count();
        
        return view('votacion.dashboard', compact('estadisticas', 'totalGeneral'));
    }
}

