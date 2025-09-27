<div id="modalEditarOrden-{{ $orden->id_orden }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-lg font-medium text-gray-900">Editar Orden de Producción #{{ $orden->id_orden }}</h3>
                <button onclick="toggleModal('modalEditarOrden-{{ $orden->id_orden }}')" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Formulario de edición -->
            <form action="{{ route('ordenes_produccion.update', $orden->id_orden) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-id_producto-{{ $orden->id_orden }}" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select id="edit-id_producto-{{ $orden->id_orden }}" name="id_producto" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}" {{ $orden->id_producto == $producto->id_producto ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="edit-user_id-{{ $orden->id_orden }}" class="block text-sm font-medium text-gray-700">Responsable</label>
                        <select id="edit-user_id-{{ $orden->id_orden }}" name="user_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $orden->id_usuario == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-cantidad_planeada-{{ $orden->id_orden }}" class="block text-sm font-medium text-gray-700">Cantidad Planeada</label>
                        <input type="number" id="edit-cantidad_planeada-{{ $orden->id_orden }}" name="cantidad_planeada" value="{{ $orden->cantidad_planeada }}" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                    </div>
                    
                    <div>
                        <label for="edit-cantidad_real-{{ $orden->id_orden }}" class="block text-sm font-medium text-gray-700">Cantidad Real</label>
                        <input type="number" id="edit-cantidad_real-{{ $orden->id_orden }}" name="cantidad_real" value="{{ $orden->cantidad_real ?? '' }}" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                </div>
                
                <div>
                    <label for="edit-estado-{{ $orden->id_orden }}" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select id="edit-estado-{{ $orden->id_orden }}" name="estado" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                        <option value="pendiente" {{ $orden->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_proceso" {{ $orden->estado == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="finalizada" {{ $orden->estado == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="toggleModal('modalEditarOrden-{{ $orden->id_orden }}')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>