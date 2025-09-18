<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;

    protected $table = 'detalle_orden';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_orden',
        'id_materia',
        'cantidad_usada'
    ];

    // Relaciones
    public function ordenProduccion()
    {
        return $this->belongsTo(OrdenProduccion::class, 'id_orden', 'id_orden');
    }

    public function materiaPrima()
    {
        return $this->belongsTo(MateriaPrima::class, 'id_materia', 'id_materia');
    }
}
