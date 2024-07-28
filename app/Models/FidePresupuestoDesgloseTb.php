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
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_presupuesto',
        'id_estado',
    ];

    public function presupuesto(): BelongsTo
    {
        return $this->belongsTo(FidePresupuestoTb::class, 'id_presupuesto');
    }
    
    public function estado():BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }
}
