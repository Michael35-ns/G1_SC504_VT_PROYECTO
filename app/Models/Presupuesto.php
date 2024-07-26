<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = "FIDE_PRESUPUESTO_TB";
    protected $primaryKey = 'ID_PRESUPUESTO';
    public $timestamps = false;

    public static function readAllByUser(): Presupuesto
    {
        $results = DB::select("SELECT READ_ALL_PRESUPUESTOS_FN() AS mfrc FROM dual");
        $presModels = App\Models\Presupuesto::hydrate($results);
        
        // It's used for store procedures
        // $stmt = DB::getPdo()->prepare("DECLARE EMPS_DATA_C SYS_REFCURSOR; BEGIN G6_SC504_VT_PROYECTO.READ_BY_ID_PRESUPUESTO_SP(:id, :pidc); END;");
        // $stmt->bindParam(':pidc', $cursor, PDO::PARAM_STMT);
        // $stmt->bindParam(':id', $value1, PDO::PARAM_INT);
        // $stmt-> execute();
    
        // $stmt = $cursor->stmt;
        // $stmt->execute();
        // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return \App\Models\Presupuesto::factory(10)->create();
    }
}
