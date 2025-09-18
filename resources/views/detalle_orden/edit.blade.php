@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Detalle de Orden</h1>

    <form action="{{ route('detalle_orden.update', $detalle->id_detalle) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_orden" class="form-label">Orden de Producción</label>
            <select name="id_orden" class="form-control" required>
                @foreach($ordenes as $orden)
                    <option value="{{ $orden->id_orden }}" 
                        {{ $detalle->id_orden == $orden->id_orden ? 'selected' : '' }}>
                        {{ $orden->id_orden }} - {{ $orden->producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_materia" class="form-label">Materia Prima</label>
            <select name="id_materia" class="form-control" required>
                @foreach($materias as $materia)
                    <option value="{{ $materia->id_materia }}" 
                        {{ $detalle->id_materia == $materia->id_materia ? 'selected' : '' }}>
                        {{ $materia->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_usada" class="form-label">Cantidad Usada</label>
            <input type="number" step="0.01" name="cantidad_usada" value="{{ $detalle->cantidad_usada }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('detalle_orden.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
