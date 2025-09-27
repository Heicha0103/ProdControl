<div id="modalEditarMateriaPrima-{{ $materia->id_materia }}"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Editar Materia Prima</h2>

        <form action="{{ route('materias_primas.update', $materia->id_materia) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ $materia->nombre }}" required
                       class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm
                              focus:border-green-600 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" rows="3"
                          class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm
                                 focus:border-green-600 focus:ring focus:ring-green-200">{{ $materia->descripcion }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Actual</label>
                    <input type="number" name="stock_actual" value="{{ $materia->stock_actual }}" step="0.01"
                           class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm
                                  focus:border-green-600 focus:ring focus:ring-green-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Mínimo</label>
                    <input type="number" name="stock_minimo" value="{{ $materia->stock_minimo }}" step="0.01"
                           class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm
                                  focus:border-green-600 focus:ring focus:ring-green-200">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Unidad de Medida</label>
                <input type="text" name="unidad_medida" value="{{ $materia->unidad_medida }}" required
                       class="w-full px-3 py-2 border border-gray-400 rounded-md shadow-sm
                              focus:border-green-600 focus:ring focus:ring-green-200">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button"
                        onclick="toggleModal('modalEditarMateriaPrima-{{ $materia->id_materia }}')"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md shadow">
                    Cancelar
                </button>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
