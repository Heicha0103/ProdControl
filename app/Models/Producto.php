<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'stock_actual',
        'unidad_medida'
    ];

    // Relaciones
    public function ordenesProduccion()
    {
        return $this->hasMany(OrdenProduccion::class, 'id_producto', 'id_producto');
    }
}
