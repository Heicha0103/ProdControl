@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Registro</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $detalleOrden->id_detalle }}</p>

            <p><strong>Orden:</strong>
                @if($detalleOrden->ordenProduccion)
                    {{ $detalleOrden->ordenProduccion->id_orden }}
                    @if($detalleOrden->ordenProduccion->producto)
                        - {{ $detalleOrden->ordenProduccion->producto->nombre }}
                    @endif
                @else
                    N/A
                @endif
            </p>

            <p><strong>Materia Prima:</strong>
                @if($detalleOrden->materiaPrima)
                    {{ $detalleOrden->materiaPrima->nombre }}
                @else
                    N/A
                @endif
            </p>

            <p><strong>Cantidad Usada:</strong> {{ $detalleOrden->cantidad_usada }}</p>
        </div>
    </div>

    <a href="{{ route('detalle_orden.index') }}" class="btn btn-primary mt-3">Volver al listado</a>
</div>
@endsection
