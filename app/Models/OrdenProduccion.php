<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OrdenProduccion extends Model
{
    use HasFactory;

    protected $table = 'ordenes_produccion';
    protected $primaryKey = 'id_orden';
    public $timestamps = true;

    protected $fillable = [
        'fecha_creacion',
        'id_producto',
        'id_usuario',
        'cantidad_planeada',
        'cantidad_real',
        'estado',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleOrden::class, 'id_orden', 'id_orden');
    }

    public function inspeccionesCalidad()
    {
        return $this->hasMany(Calidad::class, 'id_orden', 'id_orden');
    }
}
