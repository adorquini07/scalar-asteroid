<?php

namespace App\Http\Controllers;

use App\Models\Voto;
use App\Models\Ubicacion;
use App\Models\PuntoApoyo;
use Illuminate\Http\Request;

class PublicVoteController extends Controller
{
    public function create()
    {
        $ubicaciones = Ubicacion::orderBy('nombre')->get();
        // Agrupamos por punto de apoyo para facilitar la búsqueda si es necesario
        $puntosApoyo = PuntoApoyo::with('ubicaciones')->orderBy('nombre')->get();

        return view('votos.public_create', compact('ubicaciones', 'puntosApoyo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_votante' => 'required|string|max:255',
            'nombre_lider' => 'required|string|max:255',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'mesa' => 'required|integer|min:1',
            'voto_tipo' => 'required|in:camara,senado,ambas',
        ], [
            'nombre_votante.required' => 'El nombre del votante es obligatorio.',
            'nombre_lider.required' => 'El nombre del líder es obligatorio.',
            'ubicacion_id.required' => 'Debe seleccionar un puesto de votación.',
            'mesa.required' => 'Debe ingresar el número de mesa.',
            'voto_tipo.required' => 'Debe indicar a quién va a votar.',
            'voto_tipo.in' => 'El tipo de voto no es válido.',
        ]);

        Voto::create([
            'nombre_votante' => $request->nombre_votante,
            'nombre_lider' => $request->nombre_lider,
            'ubicacion_id' => $request->ubicacion_id,
            'mesa' => $request->mesa,
            'voto_tipo' => $request->voto_tipo,
            'user_id' => auth()->id(), // null si no está logueado
        ]);

        return redirect()->back()->with('success', '✅ ¡Voto registrado con éxito! Gracias por tu reporte.');
    }
}
