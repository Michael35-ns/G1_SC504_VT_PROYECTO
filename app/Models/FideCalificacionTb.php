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
        'creation_date',
        'created_by',
        'last_update_by',
        'last_update_date',
        'accion',
        'id_estado',
    ];

    public function estado()
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado', 'id_estado');
    }
}

