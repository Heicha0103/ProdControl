<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    use HasFactory;

    protected $table = 'calidad';
    protected $primaryKey = 'id_calidad';
    public $timestamps = false;

    protected $fillable = [
        'id_orden',
        'lote',
        'resultado',
        'observaciones'
    ];

    // Relaciones
    public function ordenProduccion()
    {
        return $this->belongsTo(OrdenProduccion::class, 'id_orden', 'id_orden');
    }
}
