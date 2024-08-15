<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideRolTb extends Model
{
    use HasFactory;

    protected $table = 'fide_rol_tb';

    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'descripcion',
        'nombre_rol',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
    ];

}
