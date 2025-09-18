<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{
    public function index()
    {
        $materias_primas = MateriaPrima::all();
        return view('materias_primas.index', compact('materias_primas'));
    }

    public function create()
    {
        return view('materias_primas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock_actual' => 'required|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
            'unidad_medida' => 'required|string|max:50',
        ]);

        MateriaPrima::create($request->all());

        return redirect()->route('materias_primas.index')->with('success', 'Materia prima registrada correctamente.');
    }

    public function show(MateriaPrima $materiaPrima)
    {
        return view('materias_primas.show', compact('materiaPrima'));
    }

     public function edit(MateriaPrima $materias_prima)
    {
        return view('materias_primas.edit', ['materia' => $materias_prima]);
    }

    public function update(Request $request, MateriaPrima $materias_prima)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock_actual' => 'required|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
            'unidad_medida' => 'required|string|max:50',
        ]);

        $materias_prima->update($request->all());

        return redirect()->route('materias_primas.index')->with('success', 'Materia prima actualizada correctamente.');
    }

    public function destroy(MateriaPrima $materiaPrima)
    {
        $materiaPrima->delete();
        return redirect()->route('materias_primas.index')->with('success', 'Materia prima eliminada correctamente.');
    }
}
