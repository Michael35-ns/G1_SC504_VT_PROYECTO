<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FidePresupuestoDesgloseTb extends Model
{
    use HasFactory;

    protected $table = 'fide_presupuesto_desglose_tb';

    protected $primaryKey = 'id_presupuesto_desglose';

    protected $fillable = [
        'monto',
        'nombre',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_presupuesto',
    ];

    public function presupuesto():BelongsTo
    {
        return $this->belongsTo(FidePresupuestoTb::class, 'id_presupuesto');
    }
}
