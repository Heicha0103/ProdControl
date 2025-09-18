<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasPrimasSeeder extends Seeder
{
    public function run()
    {
        DB::table('materias_primas')->insert([
            [
                'nombre' => 'Harina de Trigo',
                'descripcion' => 'Harina para panificación',
                'stock_actual' => 100,
                'stock_minimo' => 20,
                'unidad_medida' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Azúcar Refinada',
                'descripcion' => 'Azúcar blanca granulada',
                'stock_actual' => 50,
                'stock_minimo' => 10,
                'unidad_medida' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aceite Vegetal',
                'descripcion' => 'Aceite de soya para freír',
                'stock_actual' => 30,
                'stock_minimo' => 5,
                'unidad_medida' => 'litros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
