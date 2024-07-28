<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FideResennasTb extends Model
{
    use HasFactory;

    protected $table = 'fide_resennas_tb';

    protected $primaryKey = 'id_resenna';

    protected $fillable = [
        'detalle',
        'descripcion',
        'creation_date',
        'created_by', 
        'last_update_by',
        'las_update_date',
        'accion',
        'id_usuario',
        'id_calificacion',
        'id_estado',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function calificacion(): BelongsTo
    {
        return $this->belongsTo(FideCalificacionTb::class, 'id_calificacion');
    }

    public function estado():BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }
}

