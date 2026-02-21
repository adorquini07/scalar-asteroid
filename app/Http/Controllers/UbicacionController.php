<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\PuntoApoyo;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::with('puntoApoyo')->orderBy('nombre')->get();
        return view('ubicaciones.index', compact('ubicaciones'));
    }

    public function create()
    {
        $puntosApoyo = PuntoApoyo::orderBy('nombre')->get();
        return view('ubicaciones.create', compact('puntosApoyo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ubicaciones',
            'total_mesas' => 'required|integer|min:0',
            'punto_apoyo_id' => 'required|exists:puntos_apoyo,id',
        ], [
            'nombre.required' => 'El nombre del puesto es obligatorio.',
            'nombre.unique' => 'Ya existe un puesto con ese nombre.',
            'total_mesas.required' => 'El total de mesas es obligatorio.',
            'punto_apoyo_id.required' => 'Debe seleccionar un punto de apoyo.',
        ]);

        Ubicacion::create($request->only(['nombre', 'total_mesas', 'punto_apoyo_id']));

        return redirect()->route('ubicaciones.index')->with('success', 'Puesto de votación creado exitosamente.');
    }

    public function edit(Ubicacion $ubicacion)
    {
        $puntosApoyo = PuntoApoyo::orderBy('nombre')->get();
        return view('ubicaciones.edit', compact('ubicacion', 'puntosApoyo'));
    }

    public function update(Request $request, Ubicacion $ubicacion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ubicaciones,nombre,' . $ubicacion->id,
            'total_mesas' => 'required|integer|min:0',
            'punto_apoyo_id' => 'required|exists:puntos_apoyo,id',
        ], [
            'nombre.required' => 'El nombre del puesto es obligatorio.',
            'nombre.unique' => 'Ya existe un puesto con ese nombre.',
            'total_mesas.required' => 'El total de mesas es obligatorio.',
            'punto_apoyo_id.required' => 'Debe seleccionar un punto de apoyo.',
        ]);

        $ubicacion->update($request->only(['nombre', 'total_mesas', 'punto_apoyo_id']));

        return redirect()->route('ubicaciones.index')->with('success', 'Puesto de votación actualizado exitosamente.');
    }

    public function destroy(Ubicacion $ubicacion)
    {
        if ($ubicacion->registros()->exists()) {
            return redirect()->route('ubicaciones.index')
                ->with('error', 'No se puede eliminar porque hay registros asociados a este puesto.');
        }

        $ubicacion->delete();

        return redirect()->route('ubicaciones.index')->with('success', 'Puesto de votación eliminado exitosamente.');
    }
}
