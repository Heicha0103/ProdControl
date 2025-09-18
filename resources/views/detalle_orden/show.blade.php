@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Registro</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $detalle->id_detalle }}</p>
            <p><strong>Orden:</strong> {{ $detalle->orden->id_orden }} - {{ $detalle->orden->producto->nombre }}</p>
            <p><strong>Materia Prima:</strong> {{ $detalle->materiaPrima->nombre }}</p>
            <p><strong>Cantidad Usada:</strong> {{ $detalle->cantidad_usada }}</p>
        </div>
    </div>

    <a href="{{ route('detalle_orden.index') }}" class="btn btn-primary mt-3">Volver al listado</a>
</div>
@endsection
