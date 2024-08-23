<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UltimosGastosTb extends Model
{
    use HasFactory;

    protected $table = 'FIDE_GASTOS_TB_ULTIMOS_GASTOS_V';
    public $timestamps = false;

    protected $fillable = [
        'ID_GASTO',
        'ID_USUARIO',
        'DESCRIPCION_GASTO',
        'MONTO_GASTO',
        'FECHA_GASTO',
        'CREATED_BY',
        'TIPO_TRANSACCION',
    ];

    public static function obtenerUltimosGastosPorUsuario($idUsuario, $limite = 10)
    {
        return self::where('ID_USUARIO', $idUsuario)
            ->orderBy('FECHA_GASTO', 'desc')
            ->take($limite)
            ->get();
    }
}
