<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'fecha_creacion',
        'creado_por',
        'modificado_por',
        'fecha_modificacion',
        'accion',
        'id_rol',
    ];

    public function rol():BelongsTo
    {
        return $this->belongsTo(FideRolTb::class, 'id_rol');
    }
}
