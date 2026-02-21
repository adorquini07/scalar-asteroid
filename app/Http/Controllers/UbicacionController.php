<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicaciones = Ubicacion::orderBy('nombre')->get();
        return view('ubicaciones.index', compact('ubicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ubicaciones',
        ], [
            'nombre.required' => 'El nombre del punto de apoyo es obligatorio.',
            'nombre.unique' => 'Ya existe un punto de apoyo con ese nombre.',
        ]);

        Ubicacion::create($request->all());

        return redirect()->route('ubicaciones.index')->with('success', 'Punto de apoyo creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ubicaciones,nombre,' . $ubicacion->id,
        ], [
            'nombre.required' => 'El nombre del punto de apoyo es obligatorio.',
            'nombre.unique' => 'Ya existe un punto de apoyo con ese nombre.',
        ]);

        $ubicacion->update($request->all());

        return redirect()->route('ubicaciones.index')->with('success', 'Punto de apoyo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ubicacion $ubicacion)
    {
        if ($ubicacion->registros()->exists()) {
            return redirect()->route('ubicaciones.index')
                ->with('error', 'No se puede eliminar porque hay registros asociados a este punto de apoyo.');
        }

        $ubicacion->delete();

        return redirect()->route('ubicaciones.index')->with('success', 'Punto de apoyo eliminado exitosamente.');
    }
}
