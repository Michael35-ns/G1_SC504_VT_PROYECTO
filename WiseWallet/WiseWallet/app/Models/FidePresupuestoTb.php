<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PDO;

class FidePresupuestoTb extends Model
{
    use HasFactory;

    protected $table = 'fide_presupuesto_tb';

    protected $primaryKey = 'id_presupuesto';

    protected $fillable = [
        'monto_total',
        'create_at',
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_usuario',
    ];

    public function usuario():BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public static function GetPresupuesto($idUsuario)
    {
        $pdo = DB::getPdo();

        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_PRESUPUESTO_OBTENER_SP(:P_ID_USUARIO, :CURSOR_OUT);
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

}
