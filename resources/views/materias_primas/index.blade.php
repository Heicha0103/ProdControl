@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Materias Primas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('materias_primas.create') }}" class="btn btn-primary mb-3">Nueva Materia Prima</a>

    <!-- Buscador -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Buscar materias primas...">
    

    <!-- Tabla -->
    <table class="table table-bordered" id="materias-table">
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
            @forelse($materias_primas as $materia)
            <tr>
                <td>{{ $materia->id_materia }}</td>
                <td>{{ $materia->nombre }}</td>
                <td>{{ $materia->descripcion }}</td>
                <td>{{ $materia->stock_actual }}</td>
                <td>{{ $materia->stock_minimo }}</td>
                <td>{{ $materia->unidad_medida }}</td>
                <td>
                    <a href="{{ route('materias_primas.edit', $materia) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('materias_primas.destroy', $materia) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta materia prima?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay materias primas registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const table = document.getElementById("materias-table").getElementsByTagName("tbody")[0];

    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].textContent.toLowerCase();
            if (rowText.includes(filter)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
});
</script>
@endsection