<?php

namespace App\Models;

use PDO;
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
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_usuario',
        'id_transaccion',
        'id_estado',
    ];

    public function usuario():BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function transaccion():BelongsTo
    {
        return $this->belongsTo(FideCategoriaTransaccionTb::class, 'id_transaccion');
    }

    public function estado():BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public static function SP_ALL_BY_ID($idUsuario)
    {
        $pdo = DB::getPdo();

        // Preparamos la sentencia
        $stmt = $pdo->prepare("
            DECLARE
                CURSOR_OUT SYS_REFCURSOR;
            BEGIN
                FIDE_MOSTRAR_GASTOS_TABLA_SP(:P_ID_USUARIO, :CURSOR_OUT);
            END;
        ");

        // Bind de parámetros
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
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