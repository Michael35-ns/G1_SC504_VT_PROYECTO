<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FidePresupuestoTb extends Model
{
    use HasFactory;

    protected $table = 'fide_presupuesto_tb';

    protected $primaryKey = 'id_presupuesto';

    protected $fillable = [
        'monto_total',
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_usuario',
        'id_estado'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function estado():BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }
}

