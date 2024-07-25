<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
<<<<<<< Updated upstream
=======
use App\Models\Objetivo;
>>>>>>> Stashed changes

class ObjetivoEconomicoController extends Controller
{
    public function create()
<<<<<<< Updated upstream
    {
        // Retorna la vista con el formulario para crear un nuevo objetivo económico
        return view('crearObjetivo');
    }

    public function agregarObjetivo(Request $request)
    {
        $pNombreObjetivo = $request->input('nombre_objetivo');
        $pDescripcionObjetivo = $request->input('descripcion_objetivo');
        $pMontoObjetivo = $request->input('monto_objetivo');
        $pFechaTope = $request->input('fecha_tope');
        $pIdGastos = $request->input('id_gastos') ?? null;
        $pIdEstado = $request->input('id_estado') ?? 1; // Suponiendo que 1 es el estado inicial
        $pIdTransaccion = $request->input('id_transaccion') ?? null;
        $pIdIngreso = $request->input('id_ingreso') ?? null;
        $pIdPresupuesto = $request->input('id_presupuesto') ?? null;
        $pIdUsuario = 1; // ID del usuario autenticado, modificar según sea necesario


            DB::beginTransaction();

            // Definir los bindings
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

            return view('objetivoEconomico');
    }
    
    public function index()
=======
>>>>>>> Stashed changes
    {
        // Retorna la vista con el formulario para crear un nuevo objetivo económico
        return view('crearObjetivo');
    }
}

<<<<<<< Updated upstream
=======
    public function agregarObjetivo(Request $request)
    {
        $pNombreObjetivo = $request->input('nombre_objetivo');
        $pDescripcionObjetivo = $request->input('descripcion_objetivo');
        $pMontoObjetivo = $request->input('monto_objetivo');
        $pFechaTope = $request->input('fecha_tope');
        $pIdGastos = $request->input('id_gastos') ?? null;
        $pIdEstado = $request->input('id_estado') ?? 1; // Suponiendo que 1 es el estado inicial
        $pIdTransaccion = $request->input('id_transaccion') ?? null;
        $pIdIngreso = $request->input('id_ingreso') ?? null;
        $pIdPresupuesto = $request->input('id_presupuesto') ?? null;
        $pIdUsuario = 1; // ID del usuario autenticado, modificar según sea necesario


            DB::beginTransaction();

            // Definir los bindings
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

            return view('objetivoEconomico');
    }
    
    public function index()
    {
        $objetivos = Objetivo::all(); // Reemplaza 'Producto' por el nombre correcto del modelo
    
        return view('objetivoEconomico', compact('objetivos'));
    }
        
}
>>>>>>> Stashed changes
