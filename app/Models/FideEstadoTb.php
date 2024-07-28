<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FideEstadoTb extends Model
{
    use HasFactory;

    protected $table = 'fide_estado_tb';

    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'tipo_estado',
        'nombre_estado',
        'created_by',
        'creation_date',
        'last_update_by',
        'las_update_date',
        'accion',
    ];
}
