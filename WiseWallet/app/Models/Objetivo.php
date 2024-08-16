<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'FIDE_OBJETIVOS_FINANCIEROS_TB'; 
    protected $primaryKey = 'ID_OBJETIVO'; // Establece la clave primaria correcta
    public $incrementing = false;
}