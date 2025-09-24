@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalles de Órdenes</h2>
        <a href="{{ route('detalle_orden.create') }}" class="btn btn-primary">Agregar Detalle</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Orden - Producto</th>
                <th>Materia Prima</th>
                <th>Cantidad Usada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>

                    <td>
                        {{ $detalle->ordenProduccion ? $detalle->ordenProduccion->id_orden : 'N/A' }}
                        @if($detalle->ordenProduccion && $detalle->ordenProduccion->producto)
                            - {{ $detalle->ordenProduccion->producto->nombre }}
                        @endif
                    </td>

                    <td>{{ $detalle->materiaPrima ? $detalle->materiaPrima->nombre : 'N/A' }}</td>

                    <td>{{ $detalle->cantidad_usada }}</td>

                    <td>
                        <a href="{{ route('detalle_orden.show', $detalle->id_detalle) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('detalle_orden.edit', $detalle->id_detalle) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('detalle_orden.destroy', $detalle->id_detalle) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar este detalle?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay detalles registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
