@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Inspección de Calidad</h1>
    <form action="{{ route('calidad.update', $calidad->id_calidad) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_orden" class="form-label">Orden de Producción</label>
            <select name="id_orden" class="form-control" required>
                @foreach($ordenes as $orden)
                    <option value="{{ $orden->id_orden }}" {{ $orden->id_orden == $calidad->id_orden ? 'selected' : '' }}>
                        {{ $orden->id_orden }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="lote" class="form-label">Lote</label>
            <input type="text" name="lote" class="form-control" value="{{ $calidad->lote }}" required>
        </div>
        <div class="mb-3">
            <label for="resultado" class="form-label">Resultado</label>
            <select name="resultado" class="form-control" required>
                <option value="aprobado" {{ $calidad->resultado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                <option value="rechazado" {{ $calidad->resultado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ $calidad->observaciones }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('calidad.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
