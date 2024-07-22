<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resenna extends Model
{
    use HasFactory;

    protected $fillable = [
        'detalle',
        'descripcion',
        'fecha',
        'usuario_reg',
        'calificacion',
    ];
}
