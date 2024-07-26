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

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(FideUsuariosTb::class, 'id_usuario');
    }

    public function transaccion(): BelongsTo
    {
        return $this->belongsTo(FideCategoriaTransaccionTb::class, 'id_transaccion');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public static function getGastosByUsuario($idUsuario)
    {
        $pdo = DB::getPdo();

        // Preparamos la sentencia
        $stmt = $pdo->prepare("
            DECLARE
                C_GASTOS SYS_REFCURSOR;
            BEGIN
                FIDE_MOSTRAR_GASTOS_TABLA_SP(:P_ID_USUARIO, :C_GASTOS);
            END;
        ");

        // Bind de parámetros
        $stmt->bindParam(':P_ID_USUARIO', $idUsuario);
        $stmt->bindParam(':C_GASTOS', $cursor, PDO::PARAM_STMT);

        // Ejecutamos la sentencia
        $stmt->execute();

        // Recuperamos los datos del cursor
        oci_execute($cursor, OCI_DEFAULT);

        $result = [];
        $key = '12345678901234567890123456789012';
        while (($row = oci_fetch_assoc($cursor)) != false) {
            // Decrypt MONTO_GASTO
            $decryptedData = openssl_decrypt(
                base64_decode($row['MONTO_GASTO']),
                'AES-256-CBC',
                $key,
                0,
                str_repeat("\0", 16)
            );
            $row['MONTO_GASTO'] = (float) $decryptedData;
            $result[] = $row;
        }

        oci_free_statement($cursor);

        return collect($result);
    }
}
