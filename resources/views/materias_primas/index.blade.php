@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Materias Primas</h1>
    <a href="{{ route('materias_primas.create') }}" class="btn btn-primary mb-3">Nueva Materia Prima</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Stock Actual</th>
                <th>Stock Mínimo</th>
                <th>Unidad de Medida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materias_primas as $materia)
            <tr>
                <td>{{ $materia->id_materia }}</td>
                <td>{{ $materia->nombre }}</td>
                <td>{{ $materia->descripcion }}</td>
                <td>{{ $materia->stock_actual }}</td>
                <td>{{ $materia->stock_minimo }}</td>
                <td>{{ $materia->unidad_medida }}</td>
                <td>
                    <a href="{{ route('materias_primas.edit', $materia) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('materias_primas.destroy', $materia) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
