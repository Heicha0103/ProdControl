@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Control de Calidad</h1>
            <p class="text-gray-600 mt-1">Administra las inspecciones de control de calidad de tus órdenes</p>
        </div>

        <!-- Botón de registrar inspección -->
         <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="Buscar por nombre, descripción...">
            </div>

            <a href="{{ route('calidad.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
               Registrar Inspección
            </a>
        </div>

        <!-- Tabla de control de calidad -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden Producción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lote</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resultado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                        @forelse($calidades as $calidad)
                        @php
                            $isFailed = strtolower($calidad->resultado) === 'no aprobado';
                        @endphp
                        <tr class="hover:bg-gray-50 {{ $isFailed ? 'bg-red-50 border-l-4 border-red-500' : 'bg-green-50 border-l-4 border-green-500' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $calidad->id_calidad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $calidad->ordenProduccion->id_orden ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $calidad->lote }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $isFailed ? 'text-red-700' : 'text-green-700' }}">{{ $calidad->resultado }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $calidad->observaciones }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('calidad.show', $calidad->id_calidad) }}" 
                                       class="text-blue-600 hover:text-blue-900 flex items-center">
                                       Ver
                                    </a>
                                    <a href="{{ route('calidad.edit', $calidad->id_calidad) }}" 
                                       class="text-yellow-500 hover:text-yellow-700 flex items-center">
                                       Editar
                                    </a>
                                    <form action="{{ route('calidad.destroy', $calidad->id_calidad) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta inspección?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No hay inspecciones registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    const searchInput = document.getElementById("search");
    searchInput.addEventListener("input", () => {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll("#table-body tr");
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
</script>
@endsection
