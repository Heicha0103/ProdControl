@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Materia Prima</h1>
    <form action="{{ route('materias_primas.update', $materia) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $materia->nombre }}" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $materia->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label>Stock Actual</label>
            <input type="number" name="stock_actual" class="form-control" value="{{ $materia->stock_actual }}" step="0.01">
        </div>
        <div class="mb-3">
            <label>Stock Mínimo</label>
            <input type="number" name="stock_minimo" class="form-control" value="{{ $materia->stock_minimo }}" step="0.01">
        </div>
        <div class="mb-3">
            <label>Unidad de Medida</label>
            <input type="text" name="unidad_medida" class="form-control" value="{{ $materia->unidad_medida }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
