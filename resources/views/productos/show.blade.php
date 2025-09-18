@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Producto</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $producto->id_producto }}</p>
            <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
            <p><strong>Stock Actual:</strong> {{ $producto->stock_actual }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $producto->unidad_medida }}</p>
        </div>
    </div>

    <a href="{{ route('productos.index') }}" class="btn btn-primary mt-3">Volver al listado</a>
</div>
@endsection
