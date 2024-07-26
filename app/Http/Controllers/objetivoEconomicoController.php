<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Objetivo;

class ObjetivoEconomicoController extends Controller
{
    public function create()
    {
        return view('crearObjetivo');
    }

    public function agregarObjetivo(Request $request)
    {
        $pNombreObjetivo = $request->input('nombre_objetivo');
        $pDescripcionObjetivo = $request->input('descripcion_objetivo');
        $pMontoObjetivo = $request->input('monto_objetivo');
        $pFechaTope = $request->input('fecha_tope');
        $pIdGastos = $request->input('id_gastos') ?? null;
        $pIdEstado = $request->input('id_estado') ?? 1; 
        $pIdTransaccion = $request->input('id_transaccion') ?? null;
        $pIdIngreso = $request->input('id_ingreso') ?? null;
        $pIdPresupuesto = $request->input('id_presupuesto') ?? null;
        $pIdUsuario = 1; 

            DB::beginTransaction();
            $bindings = [
                'p_nombre_objetivo' => $pNombreObjetivo,
                'p_descripcion_objetivo' => $pDescripcionObjetivo,
                'p_monto_objetivo' => $pMontoObjetivo,
                'p_fecha_tope' => $pFechaTope,
                'p_id_gastos' => $pIdGastos,
                'p_id_usuario' => $pIdUsuario,
                'p_id_estado' => $pIdEstado,
                'p_id_transaccion' => $pIdTransaccion,
                'p_id_ingreso' => $pIdIngreso,
                'p_id_presupuesto' => $pIdPresupuesto,
            ];
            DB::statement('BEGIN OBJETIVOS_FINANCIEROS_AGREGAR_OBJETIVOS_SP(
                :p_nombre_objetivo, :p_descripcion_objetivo, :p_monto_objetivo, :p_fecha_tope,
                :p_id_gastos, :p_id_usuario, :p_id_estado, :p_id_transaccion, :p_id_ingreso, :p_id_presupuesto
            ); END;', $bindings);
            DB::commit();
            $objetivos = Objetivo::all();
            return view('objetivoEconomico', compact('objetivos'));
    }
    
    public function index()
    {
        $objetivos = Objetivo::all(); 
        return view('objetivoEconomico', compact('objetivos'));
    }
        
}