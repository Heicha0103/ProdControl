<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('materias_primas', function (Blueprint $table) {
            $table->id('id_materia');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('stock_actual', 10, 2)->default(0);
            $table->decimal('stock_minimo', 10, 2)->default(0);
            $table->string('unidad_medida', 50);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('materias_primas');
    }
};
