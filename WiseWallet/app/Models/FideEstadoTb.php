<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideEstadoTb extends Model
{
    use HasFactory;

    protected $table = 'fide_estado_tb';

    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'tipo_estado',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
    ];


    //Procesos de Oracle(SP)
    public static function getAllEstados()
    {
        $pdo = DB::getPdo();

        // Preparamos la sentencia
        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_ESTADO_SP(:CURSOR_OUT);
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
