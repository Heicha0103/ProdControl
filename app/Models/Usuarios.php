<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'usuario',
        'clave',
        'rol'
    ];

    // Relaciones
    public function ordenesProduccion()
    {
        return $this->hasMany(OrdenProduccion::class, 'id_usuario', 'id_usuario');
    }
}
