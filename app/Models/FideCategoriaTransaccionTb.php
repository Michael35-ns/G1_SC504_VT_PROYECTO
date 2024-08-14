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
    public static function SP_ALL_BY_ID($idUsuario)
    {
        $pdo = DB::getPdo();

        // Preparamos la sentencia
        $stmt = $pdo->prepare("
        DECLARE
            CURSOR_OUT SYS_REFCURSOR;
        BEGIN
            FIDE_CATEGORIA_TRANSACCION_SP(:P_ID_USUARIO, :CURSOR_OUT);
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
