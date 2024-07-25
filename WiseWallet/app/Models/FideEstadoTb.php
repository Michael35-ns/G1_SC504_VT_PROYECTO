<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideEstadoTb extends Model
{
    use HasFactory;

    protected $table = 'fide_estado_tb';

    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'tipo_estado',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
    ];

    

}
