@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Orden de Producción</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordenes_produccion.update', $ordenProduccion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select name="id_producto" id="id_producto" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}" {{ $ordenProduccion->id_producto == $producto->id_producto ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Responsable</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $ordenProduccion->user_id == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_planeada" class="form-label">Cantidad Planeada</label>
            <input type="number" name="cantidad_planeada" id="cantidad_planeada" class="form-control" value="{{ $ordenProduccion->cantidad_planeada }}" required min="1">
        </div>

        <div class="mb-3">
            <label for="cantidad_real" class="form-label">Cantidad Real</label>
            <input type="number" name="cantidad_real" id="cantidad_real" class="form-control" value="{{ $ordenProduccion->cantidad_real }}" min="0">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" {{ $ordenProduccion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_proceso" {{ $ordenProduccion->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="finalizada" {{ $ordenProduccion->estado == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Orden</button>
        <a href="{{ route('ordenes_produccion.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
