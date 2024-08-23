<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumenRatingTb extends Model
{
    use HasFactory;

    protected $table = 'FIDE_RESENNA_TB_RESUMEN_RAITINGS_V';

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = null;
}
