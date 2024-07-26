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
        'create_at',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_usuario',
    ];

    public function usuario():BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }
}
