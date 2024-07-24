<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'FIDE_INGRESOS_TB';

    protected $fillable = [
        'ID_INGRESO',
        'DESCRIPCION_INGRESO',
        'MONTO_INGRESO',
        'FECHA_INGRESO',
        'FECHA_CREACION',
        'CREADO_POR',
        'MODIFICADO_POR',
        'FECHA_MODIFICACION',
        'ACCION',
        'ID_USUARIO',
        'ID_TRANSACCION',
        'ID_ESTADO'
    ];

    public function agregarIngreso($data)
    {
        $bindings = [
            'p_descripcion_ingreso' => $data['DESCRIPCION_INGRESO'],
            'p_monto_ingreso' => $data['MONTO_INGRESO'],
            'p_fecha_ingreso' => $data['FECHA_INGRESO'],
            'p_id_usuario' => $data['ID_USUARIO'],
            'p_id_transaccion' => $data['ID_TRANSACCION'],
            'p_id_estado' => $data['ID_ESTADO']
        ];

        $sql = 'BEGIN INGRESOS_AGREGAR_INGRESOS_TB_SP(:p_descripcion_ingreso, :p_monto_ingreso, :p_fecha_ingreso, :p_id_usuario, :p_id_transaccion, :p_id_estado); END;';

        DB::statement($sql, $bindings);
    }
}
