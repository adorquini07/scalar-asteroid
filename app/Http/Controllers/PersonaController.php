<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cedula' => 'required|string|unique:personas,cedula',
            'nombre' => 'required|string|max:255',
            'apodo' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:255',
            'placa' => 'nullable|string|max:255',
            'puesto_votacion' => 'nullable|string|max:255',
            'mesa_votacion' => 'nullable|integer|min:1',
            'activo' => 'boolean',
        ]);

        if (!isset($data['activo'])) {
            $data['activo'] = false;
        }

        Persona::create($data);
        return redirect()->route('personas.index')->with('success', 'Persona creada correctamente.');
    }

    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $data = $request->validate([
            'cedula' => 'required|string|unique:personas,cedula,' . $persona->id,
            'nombre' => 'required|string|max:255',
            'apodo' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:255',
            'placa' => 'nullable|string|max:255',
            'puesto_votacion' => 'nullable|string|max:255',
            'mesa_votacion' => 'nullable|integer|min:1',
            'activo' => 'boolean',
        ]);

        $data['activo'] = $request->has('activo');

        $persona->update($data);
        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('personas.index')->with('success', 'Persona eliminada.');
    }
}
