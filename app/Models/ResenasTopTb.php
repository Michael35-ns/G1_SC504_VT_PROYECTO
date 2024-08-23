<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResenasTopTb extends Model
{
    use HasFactory;

    protected $table = 'FIDE_RESENNA_TB_TOP_5_USUARIOS_V';
    public $timestamps = false;
    protected $fillable = ['USUARIO', 'NUMERO_RESEÑAS', 'PROMEDIO_PUNTUACION', 'RESEÑA_MAX_RATING'];
}
