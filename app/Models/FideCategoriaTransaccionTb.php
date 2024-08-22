<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PDO;

class FideCategoriaTransaccionTb extends Model
{
    use HasFactory;

    protected $table = 'fide_categoria_transaccion_tb';

    protected $primaryKey = 'id_transaccion';

    protected $fillable = [
        'tipo_transaccion',
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_usuario',
        'id_tipo_categoria',
        'id_estado',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function tipoCategoria(): BelongsTo
    {
        return $this->belongsTo(FideTipoCategoriaTb::class, 'id_tipo_categoria');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado', 'id_estado');
    }

    //Procesos de Oracle(SP)
    public static function Mostrar_Categorias_GASTOS_BY_ID_USUARIO($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_CATEGORIA_TRANSACCION_TB_GASTOS_SP(:P_ID_USUARIO, :CURSOR_OUT);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':CURSOR_OUT', $cursor, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }


    public static function Mostrar_Categorias_INGRESOS_BY_ID_USUARIO($idUsuario)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_CATEGORIA_TRANSACCION_TB_INGRESOS_SP(:P_ID_USUARIO, :CURSOR_OUT);
            END;
        ");
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':CURSOR_OUT', $cursor, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }
        oci_free_statement($cursor);
        return collect($result);
    }


    public static function agregarCategoria($TIPO_TRANSACCION, $ID_TIPO_CATEGORIA, $ID_USUARIO, $ID_ESTADO)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_CATEGORIA_TRANSACCION_TB_CREAR_CATEGORIA_SP(
                    :P_TIPO_TRANSACCION,
                    :P_ID_TIPO_CATEGORIA,
                    :P_ID_USUARIO,
                    :P_ID_ESTADO
                );
            END;
        ");
        $stmt->bindParam(':P_TIPO_TRANSACCION', $TIPO_TRANSACCION);
        $stmt->bindParam(':P_ID_TIPO_CATEGORIA', $ID_TIPO_CATEGORIA);
        $stmt->bindParam(':P_ID_USUARIO', $ID_USUARIO);
        $stmt->bindParam(':P_ID_ESTADO', $ID_ESTADO);
        $stmt->execute();
    }


    public static function eliminarCategoria($ID_TRANSACCION)
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
            DECLARE
                BEGIN
                    FIDE_PROYECTO_FINAL_PKG.FIDE_CATEGORIA_TRANSACCION_TB_ELIMINAR_CATEGORIA_SP(:P_ID_TRANSACCION);
                END;
        ");
        $stmt->bindParam(':P_ID_TRANSACCION', $ID_TRANSACCION, PDO::PARAM_INT);
        $stmt->execute();
    }
}
