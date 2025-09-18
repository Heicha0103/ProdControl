<?php

namespace App\Http\Controllers;

use App\Models\Calidad;
use App\Models\OrdenProduccion;
use Illuminate\Http\Request;

class CalidadController extends Controller
{
    public function index()
    {
        $calidades = Calidad::with('ordenProduccion')->get();
        return view('calidad.index', compact('calidades'));
    }

    public function create()
    {
        $ordenes = OrdenProduccion::all();
        return view('calidad.create', compact('ordenes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_orden' => 'required|exists:ordenes_produccion,id_orden',
            'lote' => 'required|string|max:255',
            'resultado' => 'required|in:aprobado,rechazado',
            'observaciones' => 'nullable|string',
        ]);

        Calidad::create($request->all());

        return redirect()->route('calidad.index')->with('success', 'Inspección de calidad registrada correctamente.');
    }

    public function show(Calidad $calidad)
    {
        return view('calidad.show', compact('calidad'));
    }

    public function edit(Calidad $calidad)
    {
        $ordenes = OrdenProduccion::all();
        return view('calidad.edit', compact('calidad', 'ordenes'));
    }

    public function update(Request $request, Calidad $calidad)
    {
        $request->validate([
            'id_orden' => 'required|exists:ordenes_produccion,id_orden',
            'lote' => 'required|string|max:255',
            'resultado' => 'required|in:aprobado,rechazado',
            'observaciones' => 'nullable|string',
        ]);

        $calidad->update($request->all());

        return redirect()->route('calidad.index')->with('success', 'Inspección de calidad actualizada correctamente.');
    }

    public function destroy(Calidad $calidad)
    {
        $calidad->delete();
        return redirect()->route('calidad.index')->with('success', 'Inspección de calidad eliminada correctamente.');
    }
}
