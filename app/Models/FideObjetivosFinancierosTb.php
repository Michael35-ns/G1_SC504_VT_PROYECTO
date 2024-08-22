<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FideObjetivosFinancierosTb extends Model
{
    use HasFactory;

    protected $table = 'fide_objetivos_financieros_tb';

    protected $primaryKey = 'id_objetivo';

    protected $fillable = [
        'id_objetivo',
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
        'id_flujo',
        'id_estado',
        'id_transaccion',
        'id_ingreso',
        'id_presupuesto',
    ];

    public function gastos(): BelongsTo
    {
        return $this->belongsTo(FideGastosTb::class, 'id_gastos');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public function transaccion(): BelongsTo
    {
        return $this->belongsTo(FideCategoriaTransaccionTb::class, 'id_transaccion');
    }

    public function ingreso(): BelongsTo
    {
        return $this->belongsTo(FideIngresosTb::class, 'id_ingreso');
    }


    public static function mostrarObjetivosPorUsuario($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                C_OBJETIVOS SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_MOSTRAR_OBJETIVOS_TABLA_SP(:P_ID_USUARIO, :C_OBJETIVOS);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_OBJETIVOS', $cursor, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        $key = '12345678901234567890123456789012';
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }

    public static function mostrarObjetivosId($idUsuario,$idObjetivo)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                C_OBJETIVOS SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_MOSTRAR_OBJETIVOS_X_ID_OBJETIVO_TABLA_SP(:P_ID_USUARIO, :C_OBJETIVOS, :P_ID_OBJETIVO);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_OBJETIVOS', $cursor, PDO::PARAM_STMT);
        $stmt->bindParam(':P_ID_OBJETIVO', $idObjetivo);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        $key = '12345678901234567890123456789012';
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }


    public static function buscarObjetivos($nombreObjetivo, $idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            BEGIN
                FIDE_BUSCAR_OBJETIVO_SP(:P_NOMBRE, :p_id_usuario, :CURSOR_OBJETIVOS);
            END;
        ");

        $stmt->bindParam(':P_NOMBRE', $nombreObjetivo);
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':CURSOR_OBJETIVOS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);

        // Recuperar los resultados
        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }

        oci_free_statement($cursor);
        return collect($result);

    }
    
    

    
    
    public static function editarObjetivo(
        $nombreObjetivo,
        $descripcionObjetivo,
        $montoObjetivo,
        $fechaTope,
        $idGasto,
        $idUsuario,
        $idFlujo,
        $idEstado,
        $idTransaccion,
        $idIngreso,
        $idObjetivo
    ) {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
        DECLARE
            P_NOMBRE_OBJETIVO VARCHAR2(255);
            P_DESCRIPCION_OBJETIVO VARCHAR2(255);
            p_MONTO_OBJETIVO NUMBER;
            P_FECHA_TOPE DATE;
            p_id_gastos NUMBER;
            p_id_usuario NUMBER;
            P_ID_FLUJO NUMBER;
            p_id_estado NUMBER;
            p_id_transaccion NUMBER;
            p_id_ingreso NUMBER;
            p_id_objetivo NUMBER;
        BEGIN
            FIDE_PROYECTO_FINAL_PKG.FIDE_OBJETIVOS_FINANCIEROS_EDITAR_SP(
                :P_NOMBRE_OBJETIVO,
                :P_DESCRIPCION_OBJETIVO,
                :p_MONTO_OBJETIVO,
                :P_FECHA_TOPE,
                :p_id_gastos,
                :p_id_usuario,
                :P_ID_FLUJO,
                :p_id_estado,
                :p_id_transaccion,
                :p_id_ingreso,
                :p_id_objetivo
            );
        END;
    ");
    
        $stmt->bindParam(':P_NOMBRE_OBJETIVO', $nombreObjetivo);
        $stmt->bindParam(':P_DESCRIPCION_OBJETIVO', $descripcionObjetivo);
        $stmt->bindParam(':p_MONTO_OBJETIVO', $montoObjetivo);
        $stmt->bindParam(':P_FECHA_TOPE', $fechaTope);
        $stmt->bindParam(':p_id_gastos', $idGasto);
        $stmt->bindParam(':p_id_usuario', $idUsuario);
        $stmt->bindParam(':P_ID_FLUJO', $idFlujo);
        $stmt->bindParam(':p_id_estado', $idEstado);
        $stmt->bindParam(':p_id_transaccion', $idTransaccion);
        $stmt->bindParam(':p_id_ingreso', $idIngreso);
        $stmt->bindParam(':p_id_objetivo', $idObjetivo);
    
        $stmt->execute();
    }
    

    public static function contarObjetivos($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                v_total NUMBER;
            BEGIN
                v_total := FIDE_PROYECTO_FINAL_PKG.FIDE_OBJETIVOS_TB_CONTAR_OBJETIVOS_FUNC(:idUsuario);
                :result := v_total;
            END;
        ");
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':result', $result, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        return $result;
    }
    
    public static function contarObjetivosActivos($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                v_total NUMBER;
            BEGIN
                v_total := FIDE_PROYECTO_FINAL_PKG.FIDE_OBJETIVOS_TB_CONTAR_OBJETIVOS_ACTIVOS_FUNC(:idUsuario);
                :result := v_total;
            END;
        ");
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':result', $result, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        return $result;
    }
    
    public static function contarObjetivosInactivos($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                v_total NUMBER;
            BEGIN
                v_total := FIDE_PROYECTO_FINAL_PKG.FIDE_OBJETIVOS_TB_CONTAR_OBJETIVOS_INACTIVOS_FUNC(:idUsuario);
                :result := v_total;
            END;
        ");
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':result', $result, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        return $result;
    }
    

public static function calcPorcentaje($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            BEGIN
                :result := FIDE_PROYECTO_FINAL_PKG.FIDE_OBJETIVOS_FINANCIEROS_CALC_PORCENTAJE_FUNC(:idUsuario);
            END;
        ");
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':result', $result, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        return $result;
    } 
    
}    