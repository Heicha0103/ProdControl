@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Órdenes de Producción</h1>
            <p class="text-gray-600 mt-1">Administra y realiza seguimiento a las órdenes de producción</p>
        </div>

        <!-- Barra de búsqueda y botón -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="Buscar por producto, responsable...">
            </div>

            <!-- Filtros -->
            <div class="flex space-x-4">
                <select id="filter-estado" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="all">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en_proceso">En proceso</option>
                    <option value="finalizada">Finalizada</option>
                </select>

                <select id="sort-by" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="fecha">Ordenar por fecha</option>
                    <option value="producto">Ordenar por producto</option>
                    <option value="estado">Ordenar por estado</option>
                </select>
            </div>

            <!-- Botón para abrir el modal -->
            <button
                type="button"
                onclick="toggleModal('modalCrearOrden')"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                Nueva Orden
            </button>
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

        <!-- Tabla de órdenes -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad Planeada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad Real</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                        @forelse($ordenes as $orden)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $orden->id_orden }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orden->producto->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orden->usuario->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $orden->fecha_creacion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orden->cantidad_planeada }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $orden->cantidad_real ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $estadoClases = [
                                        'pendiente' => 'estado-pendiente',
                                        'en_proceso' => 'estado-proceso',
                                        'finalizada' => 'estado-completada'
                                    ];
                                    $estadoTexto = [
                                        'pendiente' => 'Pendiente',
                                        'en_proceso' => 'En proceso',
                                        'finalizada' => 'Finalizada'
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClases[$orden->estado] ?? 'estado-pendiente' }}">
                                    {{ $estadoTexto[$orden->estado] ?? $orden->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <button type="button" 
                                        onclick="toggleModal('modalVerOrden-{{ $orden->id_orden }}')"
                                        class="text-blue-600 hover:text-blue-900 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Ver
                                    </button>
                                    <button type="button"
                                        onclick="toggleModal('modalEditarOrden-{{ $orden->id_orden }}')"
                                        class="text-green-600 hover:text-green-900 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0
                                                112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Editar
                                    </button>
                                    <form action="{{ route('ordenes_produccion.destroy', $orden->id_orden) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta orden de producción?');" class="inline">
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

                        <!-- Incluir modales para cada orden -->
                        @include('ordenes_produccion.show', ['orden' => $orden])
                        @include('ordenes_produccion.edit', ['orden' => $orden])

                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay órdenes de producción registradas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear nueva orden -->
<div id="modalCrearOrden" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-lg font-medium text-gray-900">Nueva Orden de Producción</h3>
                <button onclick="toggleModal('modalCrearOrden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Formulario de creación -->
            <form action="{{ route('ordenes_produccion.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_producto" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select id="id_producto" name="id_producto" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                            <option value="">Selecciona un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Responsable</label>
                        <select id="user_id" name="user_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                            <option value="">Selecciona un responsable</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="cantidad_planeada" class="block text-sm font-medium text-gray-700">Cantidad Planeada</label>
                        <input type="number" id="cantidad_planeada" name="cantidad_planeada" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                    </div>
                    
                    <div>
                        <label for="cantidad_real" class="block text-sm font-medium text-gray-700">Cantidad Real (opcional)</label>
                        <input type="number" id="cantidad_real" name="cantidad_real" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                </div>
                
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select id="estado" name="estado" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="en_proceso">En proceso</option>
                        <option value="finalizada">Finalizada</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="toggleModal('modalCrearOrden')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .estado-pendiente {
        background-color: #fef3c7;
        color: #d97706;
    }
    
    .estado-proceso {
        background-color: #dbeafe;
        color: #1d4ed8;
    }
    
    .estado-completada {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .search-highlight {
        background-color: #fef08a;
    }
    
    .table-row:hover {
        background-color: #f8fafc;
    }
</style>

<script>
    // Función para mostrar/ocultar modales
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    // Funcionalidad de búsqueda y filtrado
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search");
        const filterEstado = document.getElementById("filter-estado");
        const sortBy = document.getElementById("sort-by");
        const tableBody = document.getElementById("table-body");
        const tableRows = Array.from(tableBody.getElementsByTagName("tr"));

        // Verificar si hay una fila de "no hay resultados"
        const noResultsRow = tableRows.find(row => row.cells.length === 1);

        function filterAndSort() {
            const filterText = searchInput.value.toLowerCase();
            const estadoFilter = filterEstado.value;
            const sortValue = sortBy.value;

            let filteredRows = tableRows.filter(row => {
                // Saltar la fila de "no hay resultados"
                if (row.cells.length === 1) return false;

                const rowText = row.textContent.toLowerCase();
                const estadoCell = row.cells[6];
                const estado = estadoCell.textContent.trim().toLowerCase();

                // Aplicar filtro de texto
                if (filterText && !rowText.includes(filterText)) return false;

                // Aplicar filtro de estado
                if (estadoFilter !== 'all') {
                    if (estadoFilter === 'pendiente' && estado !== 'pendiente') return false;
                    if (estadoFilter === 'en_proceso' && estado !== 'en proceso') return false;
                    if (estadoFilter === 'finalizada' && estado !== 'finalizada') return false;
                }

                return true;
            });

            // Ordenar filas
            filteredRows.sort((a, b) => {
                if (sortValue === 'fecha') {
                    const fechaA = a.cells[3].textContent;
                    const fechaB = b.cells[3].textContent;
                    return new Date(fechaA) - new Date(fechaB);
                } else if (sortValue === 'producto') {
                    const productoA = a.cells[1].textContent.toLowerCase();
                    const productoB = b.cells[1].textContent.toLowerCase();
                    return productoA.localeCompare(productoB);
                } else if (sortValue === 'estado') {
                    const estadoA = a.cells[6].textContent.trim().toLowerCase();
                    const estadoB = b.cells[6].textContent.trim().toLowerCase();
                    return estadoA.localeCompare(estadoB);
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
                if (filterText || estadoFilter !== 'all') {
                    noResultsRow.cells[0].textContent = 'No se encontraron resultados con los filtros aplicados';
                } else {
                    noResultsRow.cells[0].textContent = 'No hay órdenes de producción registradas';
                }
            }
        }

        searchInput.addEventListener("input", filterAndSort);
        filterEstado.addEventListener("change", filterAndSort);
        sortBy.addEventListener("change", filterAndSort);
    });
</script>
@endsection