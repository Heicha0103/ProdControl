<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\OrdenProduccionController;
use App\Http\Controllers\DetalleOrdenController;
use App\Http\Controllers\CalidadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil (ya generado por Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos del sistema de gestión de producción
    Route::resource('materias_primas', MateriaPrimaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ordenes_produccion', OrdenProduccionController::class)->parameters(['ordenes_produccion' => 'ordenProduccion']);;
    Route::resource('detalle_orden', DetalleOrdenController::class);
    Route::resource('calidad', CalidadController::class);
});

require __DIR__.'/auth.php';
