<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdenesProduccionSeeder extends Seeder
{
    public function run()
    {
        DB::table('ordenes_produccion')->insert([
            [
                'id_producto' => 1, // Pan Blanco
                'id_usuario' => 1, // Usuario de prueba
                'cantidad_planeada' => 100,
                'cantidad_real' => 95,
                'estado' => 'en_proceso',
                'fecha_creacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_producto' => 2, // Galleta de Azúcar
                'id_usuario' => 1,
                'cantidad_planeada' => 200,
                'cantidad_real' => 200,
                'estado' => 'pendiente',
                'fecha_creacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_producto' => 3, // Aceite Soya 1L
                'id_usuario' => 1,
                'cantidad_planeada' => 50,
                'cantidad_real' => 0,
                'estado' => 'pendiente',
                'fecha_creacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
