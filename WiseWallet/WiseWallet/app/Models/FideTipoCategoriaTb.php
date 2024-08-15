<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FideTipoCategoriaTb extends Model
{
    use HasFactory;

    protected $table = 'fide_tipo_categoria_tb';

    protected $primaryKey = 'id_tipo_categoria';

    protected $fillable = [
        'tipo_categoria',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_estado',
    ];

    public static function getAllCategories()
    {
        $pdo = DB::getPdo();

        // Preparamos la sentencia
        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_TIPO_CATEGORIA_SP(:CURSOR_OUT);
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
