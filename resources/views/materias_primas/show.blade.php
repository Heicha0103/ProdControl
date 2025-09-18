@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de Materia Prima</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $materia->id_materia }}</p>
            <p><strong>Nombre:</strong> {{ $materia->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $materia->descripcion }}</p>
            <p><strong>Stock Actual:</strong> {{ $materia->stock_actual }}</p>
            <p><strong>Stock Mínimo:</strong> {{ $materia->stock_minimo }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $materia->unidad_medida }}</p>
        </div>
    </div>

    <a href="{{ route('materias_primas.index') }}" class="btn btn-primary mt-3">Volver al listado</a>
</div>
@endsection
