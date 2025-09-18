@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Órdenes de Producción</h1>

    <a href="{{ route('ordenes_produccion.create') }}" class="btn btn-primary mb-3">Nueva Orden</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Responsable</th>
                <th>Fecha</th>
                <th>Cantidad Planeada</th>
                <th>Cantidad Real</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ordenes as $orden)
                <tr>
                    <td>{{ $orden->id_orden }}</td>
                    <td>{{ $orden->producto->nombre }}</td>
                    <td>{{ $orden->usuario->name }}</td>
                    <td>{{ $orden->fecha_creacion }}</td>
                    <td>{{ $orden->cantidad_planeada }}</td>
                    <td>{{ $orden->cantidad_real ?? '-' }}</td>
                    <td>{{ $orden->estado }}</td>
                    <td>
                        <a href="{{ route('ordenes_produccion.show', $orden->id_orden) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('ordenes_produccion.edit', $orden->id_orden) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ordenes_produccion.destroy', $orden->id_orden) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta orden?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No hay órdenes registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
