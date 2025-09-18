<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('calidad', function (Blueprint $table) {
            $table->id('id_calidad');
            $table->unsignedBigInteger('id_orden');
            $table->string('lote');
            $table->enum('resultado', ['aprobado', 'rechazado', 'pendiente']);
            $table->text('observaciones')->nullable();
            $table->timestamps();

            // Relaciones
            $table->foreign('id_orden')->references('id_orden')->on('ordenes_produccion')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('calidad');
    }
};
