<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detalle_orden', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_materia');
            $table->decimal('cantidad_usada', 10, 2);
            $table->timestamps();

            // Relaciones
            $table->foreign('id_orden')->references('id_orden')->on('ordenes_produccion')->onDelete('cascade');
            $table->foreign('id_materia')->references('id_materia')->on('materias_primas')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('detalle_orden');
    }
};
