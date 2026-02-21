<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Persona;
use App\Models\Ubicacion; // Add this import
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
        $ubicaciones = Ubicacion::orderBy('nombre')->get(); // Fetch ubicaciones
        return view('registros.create', compact('personas', 'ubicaciones'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'tipo' => 'required|in:llegada,salida',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'referido' => 'nullable|string|max:255',
            'mesa_vota' => 'nullable|integer|min:1',
            'notas' => 'nullable|string',
        ], [
            'tipo.in' => 'El tipo de registro debe ser llegada o salida.',
            'ubicacion_id.required' => 'Debe seleccionar un punto de apoyo.',
            'mesa_vota.integer' => 'La mesa debe ser un número.',
            'mesa_vota.min' => 'La mesa debe ser mayor a 0.',
        ]);

        $persona = Persona::find($request->persona_id);
        
        if ($request->filled('mesa_vota')) {
            $persona->mesa_votacion = $request->mesa_vota;
            
            $ubicacion = Ubicacion::find($request->ubicacion_id);
            if ($ubicacion) {
                $persona->puesto_votacion = $ubicacion->nombre;
            }
        }
        
        $persona->save();

        Registro::create([
            'persona_id' => $request->persona_id,
            'user_id' => auth()->id(),
            'ubicacion_id' => $request->ubicacion_id,
            'tipo' => $request->tipo,
            'referido' => $request->referido,
            'notas' => $request->notas,
        ]);

        return redirect()->route('dashboard')->with('success', '✅ Registro guardado correctamente');
    }
}
