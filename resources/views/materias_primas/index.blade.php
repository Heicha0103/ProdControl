@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Materias Primas</h1>
            <p class="text-gray-600 mt-1">Administra el inventario de materias primas de tu producción</p>
        </div>

        <!-- Barra de búsqueda y botón -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="Buscar por nombre, descripción...">
            </div>

            <!-- Filtros -->
            <div class="flex space-x-4">
                <select id="filter-stock" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="all">Todo el stock</option>
                    <option value="low">Stock bajo</option>
                    <option value="ok">Stock suficiente</option>
                </select>

                <select id="sort-by" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="name">Ordenar por nombre</option>
                    <option value="stock">Ordenar por stock</option>
                    <option value="id">Ordenar por ID</option>
                </select>
            </div>

            <!-- Botón para abrir el modal -->
            <button
                type="button"
                onclick="toggleModal('modalCrearMateriaPrima')"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                Nueva Materia Prima
            </button>

            <!-- Aquí se incluye el modal -->
            @include('materias_primas.create')

        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabla de materias primas -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Actual</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Mínimo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                        @forelse($materias_primas as $materia)
                        <tr class="hover:bg-gray-50 {{ $materia->stock_actual <= $materia->stock_minimo ? 'stock-bajo' : 'stock-ok' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $materia->id_materia }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $materia->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $materia->descripcion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($materia->stock_actual, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($materia->stock_minimo, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $materia->unidad_medida }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <button type="button"
                                        onclick="toggleModal('modalEditarMateriaPrima-{{ $materia->id_materia }}')"
                                        class="text-green-600 hover:text-green-900 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0
              112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Editar
                                    </button>

                                    <!-- Aquí se inyecta el modal dinámico -->
                                    @include('materias_primas.edit', ['materia' => $materia])

                                    <form action="{{ route('materias_primas.destroy', $materia) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta materia prima?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay materias primas registradas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .stock-bajo {
        background-color: #fef2f2;
        border-left: 4px solid #ef4444;
    }

    .stock-ok {
        background-color: #f0fdf4;
        border-left: 4px solid #22c55e;
    }

    .search-highlight {
        background-color: #fef08a;
    }

    .table-row:hover {
        background-color: #f8fafc;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search");
        const filterStock = document.getElementById("filter-stock");
        const sortBy = document.getElementById("sort-by");
        const tableBody = document.getElementById("table-body");
        const tableRows = Array.from(tableBody.getElementsByTagName("tr"));

        // Verificar si hay una fila de "no hay resultados"
        const noResultsRow = tableRows.find(row => row.cells.length === 1);

        function filterAndSort() {
            const filterText = searchInput.value.toLowerCase();
            const stockFilter = filterStock.value;
            const sortValue = sortBy.value;

            let filteredRows = tableRows.filter(row => {
                // Saltar la fila de "no hay resultados"
                if (row.cells.length === 1) return false;

                const rowText = row.textContent.toLowerCase();
                const stockActual = parseFloat(row.cells[3].textContent.replace(',', ''));
                const stockMinimo = parseFloat(row.cells[4].textContent.replace(',', ''));
                const isStockBajo = row.classList.contains('stock-bajo');

                // Aplicar filtro de texto
                if (filterText && !rowText.includes(filterText)) return false;

                // Aplicar filtro de stock
                if (stockFilter === 'low' && !isStockBajo) return false;
                if (stockFilter === 'ok' && isStockBajo) return false;

                return true;
            });

            // Ordenar filas
            filteredRows.sort((a, b) => {
                if (sortValue === 'name') {
                    const nameA = a.cells[1].textContent.toLowerCase();
                    const nameB = b.cells[1].textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                } else if (sortValue === 'stock') {
                    const stockA = parseFloat(a.cells[3].textContent.replace(',', ''));
                    const stockB = parseFloat(b.cells[3].textContent.replace(',', ''));
                    return stockA - stockB;
                } else if (sortValue === 'id') {
                    const idA = parseInt(a.cells[0].textContent);
                    const idB = parseInt(b.cells[0].textContent);
                    return idA - idB;
                }
                return 0;
            });

            // Mostrar/ocultar filas
            tableRows.forEach(row => {
                if (row.cells.length === 1) {
                    // Fila de "no hay resultados"
                    row.style.display = filteredRows.length === 0 ? '' : 'none';
                } else {
                    row.style.display = filteredRows.includes(row) ? '' : 'none';
                }
            });

            // Reordenar filas en la tabla
            filteredRows.forEach(row => {
                tableBody.appendChild(row);
            });

            // Actualizar mensaje de "no hay resultados" si es necesario
            if (noResultsRow && filteredRows.length === 0) {
                if (filterText || stockFilter !== 'all') {
                    noResultsRow.cells[0].textContent = 'No se encontraron resultados con los filtros aplicados';
                } else {
                    noResultsRow.cells[0].textContent = 'No hay materias primas registradas';
                }
            }
        }

        searchInput.addEventListener("input", filterAndSort);
        filterStock.addEventListener("change", filterAndSort);
        sortBy.addEventListener("change", filterAndSort);
    });
</script>
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection