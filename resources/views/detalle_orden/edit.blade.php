@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Encabezado -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Editar Detalle de Orden</h1>
            <p class="text-gray-600 mt-1">Modifica los materiales usados en la orden de producción</p>
        </div>

        <form action="{{ route('detalle_orden.update', $detalleOrden->id_detalle) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf
            @method('PUT')

            <!-- Orden de Producción -->
            <div>
                <label for="id_orden" class="block text-sm font-medium text-gray-700">Orden de Producción</label>
                <select name="id_orden" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
                    @foreach($ordenes as $orden)
                        <option value="{{ $orden->id_orden }}" 
                            {{ $detalleOrden->id_orden == $orden->id_orden ? 'selected' : '' }}>
                            {{ $orden->id_orden }} - {{ $orden->producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Materia Prima -->
            <div>
                <label for="id_materia" class="block text-sm font-medium text-gray-700">Materia Prima</label>
                <select name="id_materia" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id_materia }}" 
                            {{ $detalleOrden->id_materia == $materia->id_materia ? 'selected' : '' }}>
                            {{ $materia->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Cantidad Usada -->
            <div>
                <label for="cantidad_usada" class="block text-sm font-medium text-gray-700">Cantidad Usada</label>
                <input type="number" step="0.01" name="cantidad_usada" value="{{ $detalleOrden->cantidad_usada }}" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-200 focus:border-green-500 sm:text-sm px-3 py-2">
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('detalle_orden.index') }}" 
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg shadow text-gray-800">Cancelar</a>
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">Actualizar</button>
            </div>

        </form>
    </div>
</div>
@endsection
