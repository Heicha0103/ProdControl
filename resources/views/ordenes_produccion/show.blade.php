<div id="modalVerOrden-{{ $orden->id_orden }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-lg font-medium text-gray-900">Detalles de la Orden #{{ $orden->id_orden }}</h3>
                <button onclick="toggleModal('modalVerOrden-{{ $orden->id_orden }}')" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Producto:</p>
                        <p class="text-sm text-gray-900">{{ $orden->producto->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Responsable:</p>
                        <p class="text-sm text-gray-900">{{ $orden->usuario->name }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Fecha de Creación:</p>
                        <p class="text-sm text-gray-900">{{ $orden->fecha_creacion }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Estado:</p>
                        @php
                            $estadoClases = [
                                'pendiente' => 'estado-pendiente',
                                'en_proceso' => 'estado-proceso',
                                'completada' => 'estado-completada',
                                'cancelada' => 'estado-cancelada'
                            ];
                            $estadoTexto = [
                                'pendiente' => 'Pendiente',
                                'en_proceso' => 'En proceso',
                                'completada' => 'Completada',
                                'cancelada' => 'Cancelada'
                            ];
                        @endphp
                        <p class="text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClases[$orden->estado] ?? 'estado-pendiente' }}">
                                {{ $estadoTexto[$orden->estado] ?? $orden->estado }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Cantidad Planeada:</p>
                        <p class="text-sm text-gray-900">{{ $orden->cantidad_planeada }} unidades</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Cantidad Real:</p>
                        <p class="text-sm text-gray-900">{{ $orden->cantidad_real ?? '-' }} unidades</p>
                    </div>
                </div>
                
                <div>
                    <p class="text-sm font-medium text-gray-700">Observaciones:</p>
                    <p class="text-sm text-gray-900">{{ $orden->observaciones ?? 'Sin observaciones' }}</p>
                </div>
                
                <div class="flex justify-end pt-4">
                    <button type="button" onclick="toggleModal('modalVerOrden-{{ $orden->id_orden }}')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>