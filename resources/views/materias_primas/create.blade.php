@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Materia Prima</h1>
    <form action="{{ route('materias_primas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Stock Actual</label>
            <input type="number" name="stock_actual" class="form-control" value="0" step="0.01">
        </div>
        <div class="mb-3">
            <label>Stock Mínimo</label>
            <input type="number" name="stock_minimo" class="form-control" value="0" step="0.01">
        </div>
        <div class="mb-3">
            <label>Unidad de Medida</label>
            <input type="text" name="unidad_medida" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
