<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UltimosIngresosTb extends Model
{
    use HasFactory;

    protected $table = 'FIDE_INGRESOS_TB_ULTIMOS_INGRESOS_V';
    public $timestamps = false;

    protected $fillable = [
        'ID_INGRESO',
        'ID_USUARIO',
        'DESCRIPCION_INGRESO',
        'MONTO_INGRESO',
        'FECHA_INGRESO',
        'CREATED_BY',
        'TIPO_TRANSACCION',
    ];

    public static function obtenerUltimosIngresosPorUsuario($idUsuario, $limite = 10)
    {
        return self::where('ID_USUARIO', $idUsuario)
            ->orderBy('FECHA_INGRESO', 'desc')
            ->take($limite)
            ->get();
    }
}
