@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Control de Calidad</h1>
    <a href="{{ route('calidad.create') }}" class="btn btn-primary mb-3">Registrar Inspección</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Orden Producción</th>
                <th>Lote</th>
                <th>Resultado</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calidades as $calidad)
            <tr>
                <td>{{ $calidad->id_calidad }}</td>
                <td>{{ $calidad->ordenProduccion->id_orden }}</td>
                <td>{{ $calidad->lote }}</td>
                <td>{{ $calidad->resultado }}</td>
                <td>{{ $calidad->observaciones }}</td>
                <td>
                    <a href="{{ route('calidad.show', $calidad->id_calidad) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('calidad.edit', $calidad->id_calidad) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('calidad.destroy', $calidad->id_calidad) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta inspección?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
