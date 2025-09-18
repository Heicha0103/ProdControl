<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;

    protected $table = 'materias_primas';
    protected $primaryKey = 'id_materia';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'stock_actual',
        'stock_minimo',
        'unidad_medida'
    ];

    // Relaciones
    public function detallesOrden()
    {
        return $this->hasMany(DetalleOrden::class, 'id_materia', 'id_materia');
    }
}
