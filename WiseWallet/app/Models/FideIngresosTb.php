<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FideIngresosTb extends Model
{
    use HasFactory;

    protected $table = 'fide_ingresos_tb';

    protected $primaryKey = 'id_ingreso';

    protected $fillable = [
        'descripcion_ingreso',
        'monto_ingreso',
        'fecha_ingreso',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_usuario',
        'id_transaccion',
        'id_estado',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function transaccion(): BelongsTo
    {
        return $this->belongsTo(FideCategoriaTransaccionTb::class, 'id_transaccion');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public static function agregarIngreso($descripcionIngreso, $montoIngreso, $fechaIngreso, $idUsuario, $idTransaccion, $idEstado)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                P_DESCRIPCION_INGRESO VARCHAR2(255);
                P_MONTO_INGRESO NUMBER;
                P_FECHA_INGRESO DATE;
                P_ID_USUARIO NUMBER;
                P_ID_TRANSACCION NUMBER;
                P_ID_ESTADO NUMBER;
            BEGIN
                FIDE_AGREGAR_INGRESOS_TB_SP(
                    :P_DESCRIPCION_INGRESO,
                    :P_MONTO_INGRESO,
                    :P_FECHA_INGRESO,
                    :P_ID_USUARIO,
                    :P_ID_TRANSACCION,
                    :P_ID_ESTADO
                );
            END;
        ");

        $stmt->bindParam(':P_DESCRIPCION_INGRESO', $descripcionIngreso);
        $stmt->bindParam(':P_MONTO_INGRESO', $montoIngreso);
        $stmt->bindParam(':P_FECHA_INGRESO', $fechaIngreso);
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':P_ID_TRANSACCION', $idTransaccion);
        $stmt->bindParam(':P_ID_ESTADO', $idEstado);

        $stmt->execute();
    }

    public static function mostrarIngresosPorUsuario($idUsuario)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                C_INGRESOS SYS_REFCURSOR;
            BEGIN
                FIDE_MOSTRAR_INGRESOS_TABLA_SP(:P_ID_USUARIO, :C_INGRESOS);
            END;
        ");

        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_INGRESOS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        $key = '12345678901234567890123456789012';
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $decryptedData = openssl_decrypt(
                base64_decode($row['MONTO_INGRESO']),
                'AES-256-CBC',
                $key,
                0,
                str_repeat("\0", 16)
            );
            $row['MONTO_INGRESO'] = (float) $decryptedData;
            $result[] = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }

    public static function editarIngreso($idIngreso, $descripcionIngreso, $montoIngreso, $fechaIngreso, $idUsuario, $idTransaccion, $idEstado)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
        DECLARE
            P_ID_INGRESO NUMBER;
            P_DESCRIPCION_INGRESO VARCHAR2(255);
            P_MONTO_INGRESO NUMBER;
            P_FECHA_INGRESO DATE;
            P_ID_USUARIO NUMBER;
            P_ID_TRANSACCION NUMBER;
            P_ID_ESTADO NUMBER;
        BEGIN
            FIDE_EDITAR_INGRESO_SP(
                :P_ID_INGRESO,
                :P_DESCRIPCION_INGRESO,
                :P_MONTO_INGRESO,
                :P_FECHA_INGRESO,
                :P_ID_USUARIO,
                :P_ID_TRANSACCION,
                :P_ID_ESTADO
            );
        END;
    ");

        $stmt->bindParam(':P_ID_INGRESO', $idIngreso);
        $stmt->bindParam(':P_DESCRIPCION_INGRESO', $descripcionIngreso);
        $stmt->bindParam(':P_MONTO_INGRESO', $montoIngreso);
        $stmt->bindParam(':P_FECHA_INGRESO', $fechaIngreso);
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':P_ID_TRANSACCION', $idTransaccion);
        $stmt->bindParam(':P_ID_ESTADO', $idEstado);

        $stmt->execute();
    }
}
