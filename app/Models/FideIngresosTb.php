<?php

namespace App\Models;

use PDO;
use DateTime;
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
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_usuario',
        'id_transaccion',
        'id_flujo',
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

    public function flujo(): BelongsTo
    {
        return $this->belongsTo(FideFlujoTb::class, 'id_flujo');
    }

    public static function agregarIngreso($descripcionIngreso, $montoIngreso, $fechaIngreso, $idUsuario, $idTransaccion, $idFlujo, $idEstado)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                P_DESCRIPCION_INGRESO VARCHAR2(255);
                P_MONTO_INGRESO NUMBER;
                P_FECHA_INGRESO DATE;
                P_ID_USUARIO NUMBER;
                P_ID_TRANSACCION NUMBER;
                P_ID_FLUJO NUMBER;
                P_ID_ESTADO NUMBER;
            BEGIN
                FIDE_AGREGAR_INGRESOS_TB_SP(
                    :P_DESCRIPCION_INGRESO,
                    :P_MONTO_INGRESO,
                    :P_FECHA_INGRESO,
                    :P_ID_USUARIO,
                    :P_ID_TRANSACCION,
                    :P_ID_FLUJO,
                    :P_ID_ESTADO
                );
            END;
        ");

        $stmt->bindParam(':P_DESCRIPCION_INGRESO', $descripcionIngreso);
        $stmt->bindParam(':P_MONTO_INGRESO', $montoIngreso);
        $stmt->bindParam(':P_FECHA_INGRESO', $fechaIngreso);
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':P_ID_TRANSACCION', $idTransaccion);
        $stmt->bindParam(':p_ID_FLUJO', $idFlujo);
        $stmt->bindParam(':P_ID_ESTADO', $idEstado);

        $stmt->execute();
    }

    public static function valoresFuncionesActivas($idUsuario)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
        DECLARE
            C_OPERACIONES SYS_REFCURSOR;
        BEGIN
            FIDE_OBTENER_VALORES_ACTIVOS_SP(:P_ID_USUARIO, :C_OPERACIONES);
        END;
    ");

        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_OPERACIONES', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        while (($row = oci_fetch_assoc($cursor)) !== false) {
            $row['SUMA_TOTAL'] = (float) $row['SUMA_TOTAL'];
            $result = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }

    public static function mostrarIngresosPorUsuario($idUsuario, $fechaInicial, $fechaFinal, $montoMin, $montoMax)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
        DECLARE
            C_INGRESOS SYS_REFCURSOR;
        BEGIN
            FIDE_MOSTRAR_INGRESOS_TABLA_SP(:P_ID_USUARIO, :P_FECHA_INICIAL, :P_FECHA_FINAL, :P_MONTO_MINIMO, :P_MONTO_MAXIMO, :C_INGRESOS);
        END;
    ");

        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':P_FECHA_INICIAL', $fechaInicial);
        $stmt->bindParam(':P_FECHA_FINAL', $fechaFinal);
        $stmt->bindParam(':P_MONTO_MINIMO', $montoMin);
        $stmt->bindParam(':P_MONTO_MAXIMO', $montoMax);
        $stmt->bindParam(':C_INGRESOS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $row['MONTO_INGRESO'] = (float) $row['MONTO_INGRESO'];
            $result[] = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }

    public static function eliminarIngreso($idIngreso)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                BEGIN
                    FIDE_BORRAR_INGRESO_SP(:P_ID_INGRESO);
                END;
        ");

        $stmt->bindParam(':P_ID_INGRESO', $idIngreso, PDO::PARAM_INT);

        $stmt->execute();
    }

    public static function editarIngreso($idIngreso, $descripcionIngreso, $montoIngreso, $fechaIngreso, $idTransaccion, $idFlujo, $idEstado)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
    DECLARE
        P_ID_INGRESO NUMBER;
        P_DESCRIPCION_INGRESO VARCHAR2(255);
        P_MONTO_INGRESO VARCHAR2(255);
        P_FECHA_INGRESO DATE;
        P_ID_TRANSACCION NUMBER;
        P_ID_FLUJO NUMBER;
        P_ID_ESTADO NUMBER;
    BEGIN
        FIDE_EDITAR_INGRESO_SP(
            P_ID_INGRESO => :P_ID_INGRESO,
            P_DESCRIPCION_INGRESO => :P_DESCRIPCION_INGRESO,
            P_MONTO_INGRESO => :P_MONTO_INGRESO,
            P_FECHA_INGRESO => :P_FECHA_INGRESO,
            P_ID_TRANSACCION => :P_ID_TRANSACCION,
            P_ID_FLUJO => :P_ID_FLUJO,
            P_ID_ESTADO => :P_ID_ESTADO
        );
    END;
    ");

        $stmt->bindParam(':P_ID_INGRESO', $idIngreso, PDO::PARAM_INT);
        $stmt->bindParam(':P_DESCRIPCION_INGRESO', $descripcionIngreso, PDO::PARAM_STR);
        $stmt->bindParam(':P_MONTO_INGRESO', $montoIngreso, PDO::PARAM_STR);
        $stmt->bindParam(':P_FECHA_INGRESO', $fechaIngreso);
        $stmt->bindParam(':P_ID_TRANSACCION', $idTransaccion, PDO::PARAM_INT);
        $stmt->bindParam(':P_ID_FLUJO', $idFlujo, PDO::PARAM_INT);
        $stmt->bindParam(':P_ID_ESTADO', $idEstado, PDO::PARAM_INT);

        $stmt->execute();
    }

    public static function encontrarIngresoPorID($idIngreso)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
        DECLARE
            C_INGRESOS SYS_REFCURSOR;
        BEGIN
            FIDE_ENCONTRAR_INGRESO_SP(:P_ID_INGRESO, :C_INGRESOS);
        END;
    ");

        $stmt->bindParam(':P_ID_INGRESO', $idIngreso);
        $stmt->bindParam(':C_INGRESOS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];

        while (($row = oci_fetch_assoc($cursor)) != false) {

            $row['MONTO_INGRESO'] = (float) $row['MONTO_INGRESO'];
            $fechaObjeto = new DateTime($row['FECHA_INGRESO']);
            $row['FECHA_INGRESO'] = $fechaObjeto->format('Y') . '-' . $fechaObjeto->format('m') . '-' . $fechaObjeto->format('d');
            $result = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }
}
