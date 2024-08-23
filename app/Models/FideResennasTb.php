<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FideResennasTb extends Model
{
    use HasFactory;

    protected $table = 'fide_resennas_tb';

    protected $primaryKey = 'id_resenna';

    protected $fillable = [
        'detalle',
        'descripcion',
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_usuario',
        'raiting',
        'id_estado',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public static function obtenerTodasResennas()
    {
        $pdo = DB::getPdo();


        $stmt = $pdo->prepare("BEGIN FIDE_PROYECTO_FINAL_PKG.FIDE_RESENNAS_TB_GET_ALL_RESENAS_SP(:C_RESENNAS); END;");

        $stmt->bindParam(':C_RESENNAS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }

    public static function agregarResenna($detalle, $descripcion, $idUsuario, $rating)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                P_DETALLE VARCHAR2(200);
                P_DESCRIPCION VARCHAR2(800);
                P_ID_USUARIO NUMBER;
                P_RATING FLOAT;
            BEGIN
                FIDE_PROYECTO_FINAL_PKG.FIDE_RESENNAS_TB_INSERT_RESENNA_SP(
                    :P_DETALLE,
                    :P_DESCRIPCION,
                    :P_ID_USUARIO,
                    :P_RATING
                );
            END;
        ");

        $stmt->bindParam(':P_DETALLE', $detalle);
        $stmt->bindParam(':P_DESCRIPCION', $descripcion);
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':P_RATING', $rating);

        $stmt->execute();
    }

    public static function encontrarResennaPorID($idResenna)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
    DECLARE
        C_RESENNAS SYS_REFCURSOR;
    BEGIN
        FIDE_PROYECTO_FINAL_PKG.FIDE_RESENNAS_TB_ENCONTRAR_RESENNA_SP(:P_ID_RESENNA, :C_RESENNAS);
    END;
    ");

        $stmt->bindParam(':P_ID_RESENNA', $idResenna);
        $stmt->bindParam(':C_RESENNAS', $cursor, PDO::PARAM_STMT);

        $stmt->execute();

        oci_execute($cursor, OCI_DEFAULT);

        $result = [];

        while (($row = oci_fetch_assoc($cursor)) != false) {
            // Procesar datos de la reseña
            $result = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }


    public static function eliminarResenna($idResenna)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                BEGIN
                    FIDE_PROYECTO_FINAL_PKG.FIDE_RESENNAS_TB_DELETE_RESENNA_SP(:P_ID_RESENNA);
                END;
        ");

        $stmt->bindParam(':P_ID_RESENNA', $idResenna, PDO::PARAM_INT);

        $stmt->execute();
    }

}
