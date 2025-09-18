@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Orden de Producción</h1>

    <form action="{{ route('ordenes_produccion.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select name="id_producto" id="id_producto" class="form-select" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Responsable</label>
            <select name="user_id" id="user_id" class="form-select" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_planeada" class="form-label">Cantidad Planeada</label>
            <input type="number" name="cantidad_planeada" id="cantidad_planeada" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cantidad_real" class="form-label">Cantidad Real</label>
            <input type="number" name="cantidad_real" id="cantidad_real" class="form-control">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="pendiente">Pendiente</option>
                <option value="en_proceso">En Proceso</option>
                <option value="finalizada">Finalizada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Orden</button>
        <a href="{{ route('ordenes_produccion.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
