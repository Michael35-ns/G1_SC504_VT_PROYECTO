<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideFlujoTb extends Model
{
    use HasFactory;

    protected $table = 'FIDE_FLUJO_TB';

    protected $primaryKey = 'ID_FLUJO';

    protected $fillable = [
        'TIPO_ESTADO',
        'NOMBRE_ESTADO',
        'CREATED_BY',
        'CREATION_DATE',
        'LAST_UPDATE_BY',
        'LAS_UPDATE_DATE',
        'ACCION',
        'ID_ESTADO'
    ];


    //Procesos de Oracle(SP)
    public static function getAllFlows()
    {
        $pdo = DB::getPdo();

        // Preparamos la sentencia
        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_FLUJO_TB_OBTENER_SP(:CURSOR_OUT);
            END;
        ");

        // Bind de parámetros
        $stmt->bindParam(':CURSOR_OUT', $cursor, PDO::PARAM_STMT);

        // Ejecutamos la sentencia
        $stmt->execute();

        // Recuperamos los datos del cursor
        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $result[] = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }

}