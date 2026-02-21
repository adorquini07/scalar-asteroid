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
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'tipo' => 'required|in:llegada,salida,busqueda',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'referido' => 'nullable|string|max:255',
            'notas' => 'nullable|string',
        ]);

        Registro::create([
            'persona_id' => $request->persona_id,
            'user_id' => auth()->id(),
            'ubicacion_id' => $request->ubicacion_id,
            'tipo' => $request->tipo,
            'referido' => $request->referido,
            'notas' => $request->notas,
        ]);

        return redirect()->route('dashboard')->with('success', 'Registro guardado correctamente.');
    }
}
