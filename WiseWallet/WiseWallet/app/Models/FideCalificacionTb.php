<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideCalificacionTb extends Model
{
    use HasFactory;

    protected $table = 'fide_calificacion_tb';

    protected $primaryKey = 'id_calificacion';

    protected $fillable = [
        'estrellas',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
    ];
}
