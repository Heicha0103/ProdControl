<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Pan Blanco',
                'descripcion' => 'Pan elaborado con harina de trigo',
                'stock_actual' => 200,
                'unidad_medida' => 'unidad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Galleta de Azúcar',
                'descripcion' => 'Galleta dulce crujiente',
                'stock_actual' => 500,
                'unidad_medida' => 'unidad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aceite Soya 1L',
                'descripcion' => 'Botella de aceite de soya 1 litro',
                'stock_actual' => 100,
                'unidad_medida' => 'litro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
