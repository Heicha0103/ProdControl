@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="stock_actual" class="form-label">Stock Actual</label>
            <input type="number" step="0.01" name="stock_actual" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
            <input type="text" name="unidad_medida" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
