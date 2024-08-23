<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeorResenaTb extends Model
{
    use HasFactory;

    protected $table = 'FIDE_RESENNAS_TB_PEOR_CALIFICACION_V';
    public $timestamps = false;

    protected $fillable = [
        'ID_RESENNA',
        'ID_USUARIO',
        'DETALLE',
        'DESCRIPCION',
        'RATING',
        'CREATED_BY',
        'CREATION_DATE',
    ];

    public static function obtenerPeorCalificacion($limite = 1)
    {
        return self::orderBy('CREATION_DATE', 'desc')
            ->take($limite)
            ->get();
    }
}
