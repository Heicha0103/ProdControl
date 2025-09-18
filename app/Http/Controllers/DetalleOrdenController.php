<?php

namespace App\Http\Controllers;

use App\Models\DetalleOrden;
use App\Models\OrdenProduccion;
use App\Models\MateriaPrima;
use Illuminate\Http\Request;

class DetalleOrdenController extends Controller
{
    public function index()
    {
        $detalles = DetalleOrden::with('ordenProduccion', 'materiaPrima')->get();
        return view('detalle_orden.index', compact('detalles'));
    }

    public function create()
    {
        $ordenes = OrdenProduccion::all();
        $materias = MateriaPrima::all();
        return view('detalle_orden.create', compact('ordenes', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_orden' => 'required|exists:ordenes_produccion,id_orden',
            'id_materia' => 'required|exists:materias_primas,id_materia',
            'cantidad_usada' => 'required|numeric|min:0',
        ]);

        DetalleOrden::create($request->all());

        return redirect()->route('detalle_orden.index')->with('success', 'Detalle de orden registrado correctamente.');
    }

    public function show(DetalleOrden $detalleOrden)
    {
        return view('detalle_orden.show', compact('detalleOrden'));
    }

    public function edit(DetalleOrden $detalleOrden)
    {
        $ordenes = OrdenProduccion::all();
        $materias = MateriaPrima::all();
        return view('detalle_orden.edit', compact('detalleOrden', 'ordenes', 'materias'));
    }

    public function update(Request $request, DetalleOrden $detalleOrden)
    {
        $request->validate([
            'id_orden' => 'required|exists:ordenes_produccion,id_orden',
            'id_materia' => 'required|exists:materias_primas,id_materia',
            'cantidad_usada' => 'required|numeric|min:0',
        ]);

        $detalleOrden->update($request->all());

        return redirect()->route('detalle_orden.index')->with('success', 'Detalle de orden actualizado correctamente.');
    }

    public function destroy(DetalleOrden $detalleOrden)
    {
        $detalleOrden->delete();
        return redirect()->route('detalle_orden.index')->with('success', 'Detalle de orden eliminado correctamente.');
    }
}
