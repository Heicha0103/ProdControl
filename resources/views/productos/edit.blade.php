<div id="modalEditarProducto-{{ $producto->id_producto }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">Editar Producto</h3>
            <button onclick="toggleModal('modalEditarProducto-{{ $producto->id_producto }}')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full border rounded px-2 py-1" required>
            </div>
            <div class="mb-2">
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-2 py-1">{{ $producto->descripcion }}</textarea>
            </div>
            <div class="mb-2 flex gap-2">
                <div class="flex-1">
                    <label class="block text-sm font-medium">Stock Actual</label>
                    <input type="number" name="stock_actual" value="{{ $producto->stock_actual }}" class="w-full border rounded px-2 py-1" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Unidad de Medida</label>
                <select name="unidad_medida" class="w-full border rounded px-2 py-1" required>
                    <option value="kg" {{ $producto->unidad_medida=='kg' ? 'selected' : '' }}>Kg</option>
                    <option value="g" {{ $producto->unidad_medida=='g' ? 'selected' : '' }}>g</option>
                    <option value="l" {{ $producto->unidad_medida=='l' ? 'selected' : '' }}>L</option>
                    <option value="ml" {{ $producto->unidad_medida=='ml' ? 'selected' : '' }}>ml</option>
                    <option value="unidad" {{ $producto->unidad_medida=='unidad' ? 'selected' : '' }}>Unidad</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('modalEditarProducto-{{ $producto->id_producto }}')" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Actualizar</button>
            </div>
        </form>
    </div>
</div>
