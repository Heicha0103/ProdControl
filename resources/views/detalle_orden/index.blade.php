@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de Órdenes de Producción</h1>

    <a href="{{ route('detalle_orden.create') }}" class="btn btn-primary mb-3">Agregar Detalle</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Orden</th>
                <th>Materia Prima</th>
                <th>Cantidad Usada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>
                    <td>{{ $detalle->orden->id_orden }} - {{ $detalle->orden->producto->nombre }}</td>
                    <td>{{ $detalle->materiaPrima->nombre }}</td>
                    <td>{{ $detalle->cantidad_usada }}</td>
                    <td>
                        <a href="{{ route('detalle_orden.show', $detalle->id_detalle) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('detalle_orden.edit', $detalle->id_detalle) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('detalle_orden.destroy', $detalle->id_detalle) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este detalle?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No hay detalles registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
