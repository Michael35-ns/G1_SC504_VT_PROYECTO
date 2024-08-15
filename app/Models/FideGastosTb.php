<?php

namespace App\Models;

use PDO;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FideGastosTb extends Model
{
    use HasFactory;

    protected $table = 'fide_gastos_tb';

    protected $primaryKey = 'id_gasto';

    protected $fillable = [
        'monto_gasto',
        'descripcion_gasto',
        'fecha_gasto',
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

    public function flujo(): BelongsTo
    {
        return $this->belongsTo(FideFlujoTb::class, 'id_flujo');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public static function getGastosByUsuario($idUsuario, $fechaInicial, $fechaFinal, $montoMin, $montoMax)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                C_GASTOS SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_MOSTRAR_GASTOS_TABLA_SP(:P_ID_USUARIO, :P_FECHA_INICIAL, :P_FECHA_FINAL, :P_MONTO_MINIMO, :P_MONTO_MAXIMO, :C_GASTOS);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':P_FECHA_INICIAL', $fechaInicial);
        $stmt->bindParam(':P_FECHA_FINAL', $fechaFinal);
        $stmt->bindParam(':P_MONTO_MINIMO', $montoMin);
        $stmt->bindParam(':P_MONTO_MAXIMO', $montoMax);
        $stmt->bindParam(':C_GASTOS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }

    public static function agregarGasto($montoGasto, $descripcionGasto, $fechaGasto, $idUsuario, $idFlujo, $idTransaccion, $idEstado)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                P_MONTO_GASTO NUMBER;
                P_DESCRIPCION_GASTO VARCHAR2(200);
                P_FECHA_GASTO DATE;
                P_ID_USUARIO NUMBER;
                P_ID_FLUJO NUMBER;
                P_ID_TRANSACCION NUMBER;
                P_ID_ESTADO NUMBER;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_AGREGAR_GASTO_TB_SP(
                    :P_MONTO_GASTO,
                    :P_DESCRIPCION_GASTO,
                    :P_FECHA_GASTO,
                    :P_ID_USUARIO,
                    :P_ID_FLUJO,
                    :P_ID_TRANSACCION,
                    :P_ID_ESTADO
                );
            END;
        ");
        $stmt->bindParam(':P_MONTO_GASTO', $montoGasto);
        $stmt->bindParam(':P_DESCRIPCION_GASTO', $descripcionGasto);
        $stmt->bindParam(':P_FECHA_GASTO', $fechaGasto);
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':p_ID_FLUJO', $idFlujo);
        $stmt->bindParam(':P_ID_TRANSACCION', $idTransaccion);
        $stmt->bindParam(':P_ID_ESTADO', $idEstado);
        $stmt->execute();
    }


    //Para recuperar el id y tambien imprimir lo de mas info
    public static function encontrarGastoPorID($ID_GASTO)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
        DECLARE
            C_GASTOS SYS_REFCURSOR;
        BEGIN
            FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_ENCONTRAR_GASTO_SP(:P_ID_GASTO, :C_GASTOS);
        END;
    ");

        $stmt->bindParam(':P_ID_GASTO', $ID_GASTO);
        $stmt->bindParam(':C_GASTOS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];

        while (($row = oci_fetch_assoc($cursor)) != false) {

            $row['MONTO_GASTO'] = (float) $row['MONTO_GASTO'];
            $fechaObjeto = new DateTime($row['FECHA_GASTO']);
            $row['FECHA_GASTO'] = $fechaObjeto->format('Y') . '-' . $fechaObjeto->format('m') . '-' . $fechaObjeto->format('d');
            $result = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }

    public static function editarGasto($id_gasto, $descripcion_gasto, $monto_gasto, $fecha_gasto, $id_flujo, $id_transaccion, $id_estado)
    {
        $pdo = DB::getPdo();

        $formattedDate = DateTime::createFromFormat('Y-m-d', $fecha_gasto)->format('Y-MM-DD');

        $stmt = $pdo->prepare("
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_EDITAR_GASTO_SP(
                    P_ID_GASTO => :P_ID_GASTO,
                    P_DESCRIPCION_GASTO => :P_DESCRIPCION_GASTO,
                    P_MONTO_GASTO => :P_MONTO_GASTO,
                    P_FECHA_GASTO => :P_FECHA_GASTO,
                    P_ID_FLUJO => :P_ID_FLUJO,
                    P_ID_TRANSACCION => :P_ID_TRANSACCION,
                    P_ID_ESTADO => :P_ID_ESTADO
                );
            END;
        ");

        $stmt->bindParam(':P_ID_GASTO', $id_gasto, PDO::PARAM_INT);
        $stmt->bindParam(':P_DESCRIPCION_GASTO', $descripcion_gasto, PDO::PARAM_STR);
        $stmt->bindParam(':P_MONTO_GASTO', $monto_gasto, PDO::PARAM_STR);
        $stmt->bindParam(':P_FECHA_GASTO', $formattedDate);
        $stmt->bindParam(':P_ID_FLUJO', $id_flujo, PDO::PARAM_INT);
        $stmt->bindParam(':P_ID_TRANSACCION', $id_transaccion, PDO::PARAM_INT);
        $stmt->bindParam(':P_ID_ESTADO', $id_estado, PDO::PARAM_INT);

        $stmt->execute();
    }
    

    public static function eliminarGasto($id_gasto)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                BEGIN
                    FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_ELIMINAR_GASTO_SP(:P_ID_GASTO);
                END;
        ");
        $stmt->bindParam(':P_ID_GASTO', $id_gasto, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function suamaGastosTotales($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                C_OPERACIONES SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_TOTAL_GASTOS_SP(:P_ID_USUARIO, :C_OPERACIONES);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_OPERACIONES', $cursor, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        while (($row = oci_fetch_assoc($cursor)) !== false) {
            $row['SUMA_TOTAL_GASTOS'] = (float) $row['SUMA_TOTAL_GASTOS'];
            $result = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }


    public static function obtenerDineroRestante($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                C_OPERACIONES SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_Y_FIDE_INGRESOS_TB_OBTENER_DINERO_RESTANTE_SP(:P_ID_USUARIO, :C_OPERACIONES);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_OPERACIONES', $cursor, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        while (($row = oci_fetch_assoc($cursor)) !== false) {
            $row['DINERO_RESTANTE'] = (float) $row['DINERO_RESTANTE'];
            $result = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }


    public static function porcentajeGastado($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                C_OPERACIONES SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_GASTOS_TB_Y_FIDE_INGRESOS_TB_PORCENTAJE_DINERO_GASTADO_SP(:P_ID_USUARIO, :C_OPERACIONES);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_OPERACIONES', $cursor, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        while (($row = oci_fetch_assoc($cursor)) !== false) {
            $row['PORCENTAJE_GASTADO'] = number_format((float) $row['PORCENTAJE_GASTADO'], 2);
            $result = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }


    
}