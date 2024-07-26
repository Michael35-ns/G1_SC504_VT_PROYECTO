<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = "FIDE_PRESUPUESTO_TB";
    protected $primaryKey = 'ID_PRESUPUESTO';
    public $timestamps = false;

    public static function readByUserId(int $userId): Collection
    {

        $stmtBinds = ["pUserId" => $userId];
        $results = DB::select("SELECT READ_ALL_PRESUPUESTOS_FN(P_USER_ID => :pUserId) AS mfrc FROM dual", $stmtBinds);
        $presModels = \App\Models\Presupuesto::hydrate($results);


        // $cursor = null;
        // $stmt = DB::getPdo()->prepare("DECLARE EMPS_DATA_C SYS_REFCURSOR; BEGIN G6_SC504_VT_PROYECTO.READ_BY_ID_PRESUPUESTO_SP(:id, :pidc); END;");
        // $stmt->bindParam(':pidc', $cursor, PDO::PARAM_STMT);
        // $stmt->bindParam(':id', $value1, PDO::PARAM_INT);
        // $stmt-> execute();

        if ($presModels->isEmpty()) {
            return \App\Models\Presupuesto::factory(10)->create();
        } else return $presModels;
    }
}
