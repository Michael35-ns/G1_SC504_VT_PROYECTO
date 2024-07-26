<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = "FIDE_PRESUPUESTO_TB";
    protected $primaryKey = 'ID_PRESUPUESTO';
    public $timestamps = false;

    public function readById(): Presupuesto
    {
        $results = DB::select("SELECT READ_ALL_PRESUPUESTOS_FN() AS mfrc FROM dual");
        $presModels = Presupuesto::hydrate($results);
        // $this->hydrate()->

        
        // $cursor = null;
        $stmt = DB::getPdo()->prepare("DECLARE EMPS_DATA_C SYS_REFCURSOR; BEGIN G6_SC504_VT_PROYECTO.READ_BY_ID_PRESUPUESTO_SP(:id, :pidc); END;");
        $stmt->bindParam(':pidc', $cursor, PDO::PARAM_STMT);
        $stmt->bindParam(':id', $value1, PDO::PARAM_INT);
        $stmt-> execute();
    
        $stmt = $cursor->stmt;
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // // Fetch results from the cursor
        // $stmt = $cursor->stmt;
        // $stmt->execute();
        // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $results;

        return \App\Models\Presupuesto::factory(10)->create();
    }
}
