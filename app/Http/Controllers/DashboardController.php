<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class DashboardController extends Controller
{
    public function index()
    {
        $personas = Persona::where('activo', true)
            ->with([
                'registros' => function ($query) {
                    $query->latest()->with('ubicacion');
                }
            ])
            ->get()
            ->map(function ($persona) {
                $persona->ultimoRegistro = $persona->registros->first();
                return $persona;
            });

        return view('dashboard', compact('personas'));
    }
}
