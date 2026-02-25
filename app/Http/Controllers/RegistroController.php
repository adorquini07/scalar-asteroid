<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Persona;
use App\Models\Ubicacion;
use App\Models\PuntoApoyo;
use App\Models\Voto;
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
            'referido' => 'nullable|string',
            'ubicacion_id' => 'nullable|exists:ubicaciones,id',
            'mesa_vota' => 'nullable|integer|min:1',
        ], [
            'tipo.in' => 'El tipo de registro debe ser llegada o salida.',
            'punto_apoyo_id.required' => 'Debe seleccionar un punto de apoyo.',
        ]);

        $registro = Registro::create([
            'persona_id' => $request->persona_id,
            'referido' => $request->referido,
            'user_id' => auth()->id(),
            'punto_apoyo_id' => $request->punto_apoyo_id,
            'ubicacion_id' => $request->ubicacion_id,
            'mesa_vota' => $request->mesa_vota,
            'tipo' => $request->tipo,
        ]);

        // Sincronizar con la tabla de Votos si es una llegada y tiene datos de votación
        if ($request->tipo === 'llegada' && $request->ubicacion_id && $request->mesa_vota) {
            $persona = Persona::find($request->persona_id);
            Voto::create([
                'nombre_votante' => $persona->nombre,
                'nombre_lider' => $request->referido ?? 'General',
                'ubicacion_id' => $request->ubicacion_id,
                'mesa' => $request->mesa_vota,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('registros.create')->with('success', '✅ Registro guardado correctamente');
    }
}
