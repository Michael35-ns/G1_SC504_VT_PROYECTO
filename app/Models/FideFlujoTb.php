<?php

namespace App\Models;

use PDO;
use App\Models\FideEstadoTb;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FideFlujoTb extends Model
{
    use HasFactory;

    protected $table = 'fide_flujo_tb';

    protected $primaryKey = 'id_flujo';

    protected $fillable = [
        'tipo_estado',
        'nombre_estado',
        'created_by',
        'creation_date',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_estado',
    ];

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado', 'id_estado');
    }

    //Procesos de Oracle(SP)
    public static function getAllFlujos()
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
