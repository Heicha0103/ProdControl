@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="stock_actual" class="form-label">Stock Actual</label>
            <input type="number" step="0.01" name="stock_actual" value="{{ $producto->stock_actual }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
            <input type="text" name="unidad_medida" value="{{ $producto->unidad_medida }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
