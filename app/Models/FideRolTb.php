<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FideRolTb extends Model
{
    use HasFactory;

    protected $table = 'fide_rol_tb';

    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'descripcion',
        'nombre_rol',
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_estado',
    ];

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }
}

