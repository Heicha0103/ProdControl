<!-- Modal -->
<div id="modalCrearMateriaPrima" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Nueva Materia Prima</h2>

        <form action="{{ route('materias_primas.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" required
                       class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm focus:border-green-600 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" rows="3"
                          class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm focus:border-green-600 focus:ring focus:ring-green-200"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Actual</label>
                    <input type="number" name="stock_actual" value="0" step="0.01"
                           class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm focus:border-green-600 focus:ring focus:ring-green-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Mínimo</label>
                    <input type="number" name="stock_minimo" value="0" step="0.01"
                           class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm focus:border-green-600 focus:ring focus:ring-green-200">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Unidad de Medida</label>
                <input type="text" name="unidad_medida" required
                       class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm focus:border-green-600 focus:ring focus:ring-green-200">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="toggleModal('modalCrearMateriaPrima')"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md shadow">
                    Cancelar
                </button>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
