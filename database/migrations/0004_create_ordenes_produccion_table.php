<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ordenes_produccion', function (Blueprint $table) {
            $table->id('id_orden');
            $table->date('fecha_creacion');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('cantidad_planeada', 10, 2);
            $table->decimal('cantidad_real', 10, 2)->nullable();
            $table->enum('estado', ['pendiente', 'en_proceso', 'finalizada', 'cancelada'])->default('pendiente');
            $table->timestamps();

            // Relaciones
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('ordenes_produccion');
    }
};
