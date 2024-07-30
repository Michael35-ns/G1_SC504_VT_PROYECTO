<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FideUsuariosTb extends Model
{
    use HasFactory;

    protected $table = 'fide_usuarios_tb';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'username',
        'correo_electronico',
        'contrasenna',
        'foto_perfil_url',
        'creation_date',
        'created_by',
        'last_update_by',
        'las_update_date',
        'accion',
        'id_rol',
        'id_estado',
    ];

    public function rol(): BelongsTo
    {
        return $this->belongsTo(FideRolTb::class, 'id_rol');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(FideEstadoTb::class, 'id_estado');
    }

    public static function agregarUsuario($nombre, $primerApellido, $segundoApellido, $username, $correoElectronico, $contrasenna, $fotoPerfilUrl, $idRol, $idEstado)
    {

        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("
        BEGIN
            FIDE_REGISTRAR_USUARIO_SP(
                :P_NOMBRE, :P_PRIMER_APELLIDO, :P_SEGUNDO_APELLIDO, 
                :P_USERNAME, :P_CORREO_ELECTRONICO, :P_CONTRASENNA, 
                :P_FOTO_PERFIL_URL, :P_ID_ROL, :P_ID_ESTADO
            );
        END;
    ");

        $stmt->bindParam(':P_NOMBRE', $nombre);
        $stmt->bindParam(':P_PRIMER_APELLIDO', $primerApellido);
        $stmt->bindParam(':P_SEGUNDO_APELLIDO', $segundoApellido);
        $stmt->bindParam(':P_USERNAME', $username);
        $stmt->bindParam(':P_CORREO_ELECTRONICO', $correoElectronico);
        $stmt->bindParam(':P_CONTRASENNA', $contrasenna);
        $stmt->bindParam(':P_FOTO_PERFIL_URL', $fotoPerfilUrl);
        $stmt->bindParam(':P_ID_ROL', $idRol);
        $stmt->bindParam(':P_ID_ESTADO', $idEstado);

        $stmt->execute();
    }
}
