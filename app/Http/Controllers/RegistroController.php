<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Persona;
use App\Models\Ubicacion;
use App\Models\PuntoApoyo;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = Registro::with(['persona', 'user', 'ubicacion'])->latest()->paginate(15);
        return view('registros.index', compact('registros'));
    }

    public function create()
    {
        $personas = Persona::where('activo', true)->orderBy('nombre')->get();
        $puntosApoyo = PuntoApoyo::orderBy('nombre')->get();
        // Ubicaciones se cargan dinamicamente por AJAX cuando se elige el Punto de Apoyo
        return view('registros.create', compact('personas', 'puntosApoyo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'tipo' => 'required|in:llegada,salida',
            'punto_apoyo_id' => 'required|exists:puntos_apoyo,id',
            'ubicacion_id' => 'nullable|exists:ubicaciones,id',
            'notas' => 'nullable|string',
        ], [
            'tipo.in' => 'El tipo de registro debe ser llegada o salida.',
            'punto_apoyo_id.required' => 'Debe seleccionar un punto de apoyo.',
        ]);

        Registro::create([
            'persona_id' => $request->persona_id,
            'user_id' => auth()->id(),
            'punto_apoyo_id' => $request->punto_apoyo_id,
            'ubicacion_id' => $request->ubicacion_id,
            'tipo' => $request->tipo,
            'notas' => $request->notas,
        ]);

        return redirect()->route('registros.create')->with('success', '✅ Registro guardado correctamente');
    }
}
