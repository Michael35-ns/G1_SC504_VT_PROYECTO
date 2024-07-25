<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideTipoCategoriaTb extends Model
{
    use HasFactory;

    protected $table = 'fide_tipo_categoria_tb';

    protected $primaryKey = 'id_tipo_categoria';

    protected $fillable = [
        'tipo_categoria',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
    ];
}
