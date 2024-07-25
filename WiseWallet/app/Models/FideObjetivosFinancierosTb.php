<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FideObjetivosFinancierosTb extends Model
{
    use HasFactory;

    protected $table = 'fide_objetivos_financieros_tb';

    protected $primaryKey = 'id_objetivo';

    protected $fillable = [
        'nombre_objetivo',
        'descripcion_objetivo',
        'monto_objetivo',
        'fecha_tope',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_gastos',
        'id_usuario',
        'id_estado',
        'id_transaccion',
        'id_ingreso',
        'id_presupuesto',
    ];

    public function gastos():BelongsTo
    {
        return $this->belongsTo(FideGastosTb::class, 'id_gastos');
    }

    public function usuario():BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function estado():BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public function transaccion():BelongsTo
    {
        return $this->belongsTo(FideCategoriaTransaccionTb::class, 'id_transaccion');
    }

    public function ingreso():BelongsTo
    {
        return $this->belongsTo(FideIngresosTb::class, 'id_ingreso');
    }

    public function presupuesto():BelongsTo
    {
        return $this->belongsTo(FidePresupuestoTb::class, 'id_presupuesto');
    }
}
