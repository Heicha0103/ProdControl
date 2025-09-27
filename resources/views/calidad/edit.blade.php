@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Encabezado -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Editar Inspección de Calidad</h1>
            <p class="text-gray-600 mt-1">Modifica los datos de control de calidad para esta orden de producción</p>
        </div>

        <form action="{{ route('calidad.update', $calidad->id_calidad) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf
            @method('PUT')

            <!-- Orden de Producción -->
            <div>
                <label for="id_orden" class="block text-sm font-medium text-gray-700">Orden de Producción</label>
                <select name="id_orden" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
                    @foreach($ordenes as $orden)
                        <option value="{{ $orden->id_orden }}" {{ $orden->id_orden == $calidad->id_orden ? 'selected' : '' }}>
                            {{ $orden->id_orden }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Lote -->
            <div>
                <label for="lote" class="block text-sm font-medium text-gray-700">Lote</label>
                <input type="text" name="lote" value="{{ $calidad->lote }}" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
            </div>

            <!-- Resultado -->
            <div>
                <label for="resultado" class="block text-sm font-medium text-gray-700">Resultado</label>
                <select name="resultado" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
                    <option value="aprobado" {{ $calidad->resultado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rechazado" {{ $calidad->resultado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                </select>
            </div>

            <!-- Observaciones -->
            <div>
                <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones</label>
                <textarea name="observaciones" rows="3"
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">{{ $calidad->observaciones }}</textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('calidad.index') }}" 
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg shadow text-gray-800">Cancelar</a>
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">Actualizar</button>
            </div>

        </form>
    </div>
</div>
@endsection
