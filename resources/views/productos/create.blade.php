<div id="modalCrearProducto" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">Nuevo Producto</h3>
            <button onclick="toggleModal('modalCrearProducto')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="nombre" class="w-full border rounded px-2 py-1" required>
            </div>
            <div class="mb-2">
                <label class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-2 py-1"></textarea>
            </div>
            <div class="mb-2 flex gap-2">
                <div class="flex-1">
                    <label class="block text-sm font-medium">Stock Actual</label>
                    <input type="number" name="stock_actual" class="w-full border rounded px-2 py-1" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Unidad de Medida</label>
                <select name="unidad_medida" class="w-full border rounded px-2 py-1" required>
                    <option value="">Selecciona unidad</option>
                    <option value="kg">Kg</option>
                    <option value="g">g</option>
                    <option value="l">L</option>
                    <option value="ml">ml</option>
                    <option value="unidad">Unidad</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('modalCrearProducto')" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
            </div>
        </form>
    </div>
</div>
