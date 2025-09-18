@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de Inspección de Calidad</h1>
    <div class="card">
        <div class="card-body">
            <h5><strong>ID:</strong> {{ $calidad->id_calidad }}</h5>
            <p><strong>Orden de Producción:</strong> {{ $calidad->ordenProduccion->id_orden }}</p>
            <p><strong>Lote:</strong> {{ $calidad->lote }}</p>
            <p><strong>Resultado:</strong> {{ $calidad->resultado }}</p>
            <p><strong>Observaciones:</strong> {{ $calidad->observaciones }}</p>
        </div>
    </div>
    <a href="{{ route('calidad.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
