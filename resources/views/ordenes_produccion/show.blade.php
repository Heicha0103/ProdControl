@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Orden de Producción</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $ordenProduccion->id_orden }}</p>
            <p><strong>Producto:</strong> {{ $ordenProduccion->producto->nombre }}</p>
            <p><strong>Responsable:</strong> {{ $ordenProduccion->usuario->name }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $ordenProduccion->fecha_creacion }}</p>
            <p><strong>Cantidad Planeada:</strong> {{ $ordenProduccion->cantidad_planeada }}</p>
            <p><strong>Cantidad Real:</strong> {{ $ordenProduccion->cantidad_real }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($ordenProduccion->estado) }}</p>
        </div>
    </div>

    <a href="{{ route('ordenes_produccion.index') }}" class="btn btn-primary">Volver al listado</a>
</div>
@endsection
