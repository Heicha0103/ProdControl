<?php

namespace App\Http\Controllers;

use App\Models\OrdenProduccion;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class OrdenProduccionController extends Controller
{
    public function index()
    {
        $ordenes = OrdenProduccion::with('producto', 'usuario')->get();
        return view('ordenes_produccion.index', compact('ordenes'));
    }

    public function create()
    {
        $productos = Producto::all();
        $usuarios = User::all();
        return view('ordenes_produccion.create', compact('productos', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'user_id' => 'required|exists:users,id',
            'cantidad_planeada' => 'required|numeric|min:1',
            'estado' => 'required|in:pendiente,en_proceso,finalizada',
        ]);

        OrdenProduccion::create([
            'fecha_creacion' => now(),
            'id_producto' => $request->id_producto,
            'id_usuario' => $request->user_id,
            'cantidad_planeada' => $request->cantidad_planeada,
            'cantidad_real' => $request->cantidad_real,
            'estado' => $request->estado,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('ordenes_produccion.index')
            ->with('success', 'Orden de producción registrada correctamente.');
    }

    public function edit(OrdenProduccion $ordenProduccion)
    {
        $productos = Producto::all();
        $usuarios = User::all();
        return view('ordenes_produccion.edit', compact('ordenProduccion', 'productos', 'usuarios'));
    }

    public function update(Request $request, OrdenProduccion $ordenProduccion)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'user_id' => 'required|exists:users,id',
            'cantidad_planeada' => 'required|numeric|min:1',
            'estado' => 'required|in:pendiente,en_proceso,finalizada',
        ]);

        $ordenProduccion->update([
            'id_producto' => $request->id_producto,
            'id_usuario' => $request->user_id,
            'cantidad_planeada' => $request->cantidad_planeada,
            'cantidad_real' => $request->cantidad_real,
            'estado' => $request->estado,
        ]);

        return redirect()->route('ordenes_produccion.index')
            ->with('success', 'Orden de producción actualizada correctamente.');
    }

    public function destroy(OrdenProduccion $ordenProduccion)
    {
        $ordenProduccion->delete();
        return redirect()->route('ordenes_produccion.index')
            ->with('success', 'Orden de producción eliminada correctamente.');
    }

    public function show(OrdenProduccion $ordenProduccion)
    {
        return view('ordenes_produccion.show', compact('ordenProduccion'));
    }
}
