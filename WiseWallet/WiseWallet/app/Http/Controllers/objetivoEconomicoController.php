<?php

namespace App\Http\Controllers;

use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideObjetivosFinancierosTb;
use Illuminate\Http\Request;
use App\Models\FideEstadoTb;
use App\Models\FideGastosTb;
use App\Models\FideIngresosTb;
use App\Models\FidePresupuestoTb;
use App\Models\FideTipoCategoriaTb;
use App\Models\FideFlujoTb;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Objetivo;

class ObjetivoEconomicoController extends Controller
{
    public function create()
    {
        $presupuestos = FidePresupuestoTb::GetPresupuesto(2);
        $gastos = FideGastosTb::getGastosByUsuario(2);
        $transaccions = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        $estados = FideEstadoTb::getAllEstados(2);
        $categorias = FideTipoCategoriaTb::getAllCategories();
        $ingresos = FideIngresosTb::mostrarIngresosPorUsuario(2);
        $flujos = FideFlujoTb::getAllFlows();
        return view('crearObjetivo',compact('transaccions','estados','gastos',
                                            'presupuestos','ingresos','categorias','flujos'));
    }

    public function agregarObjetivo(Request $request)
{
    $pNombreObjetivo = $request->input('nombre_objetivo');
    $pDescripcionObjetivo = $request->input('descripcion_objetivo');
    $pMontoObjetivo = $request->input('monto_objetivo');
    $pFechaTope = $request->input('fecha_tope');
    $pIdGasto = $request->input('ID_GASTO'); 
    $pIdFlujo = $request->input('ID_FLUJO');
    $pIdEstado = $request->input('ID_ESTADO'); 
    $pIdTransaccion = $request->input('ID_TRANSACCION'); 
    $pIdCategoria = $request->input('ID_TIPO_CATEGORIA'); 
    $pIdIngreso = $request->input('ID_INGRESO'); 
    $pIdPresupuesto = $request->input('ID_PRESUPUESTO'); 
    $pIdUsuario = 2; 

        DB::beginTransaction();

        $bindings = [
            'p_nombre_objetivo' => $pNombreObjetivo,
            'p_descripcion_objetivo' => $pDescripcionObjetivo,
            'p_monto_objetivo' => $pMontoObjetivo,
            'p_fecha_tope' => $pFechaTope,
            'p_id_gasto' => $pIdGasto, 
            'p_id_flujo' => $pIdFlujo, 
            'p_id_usuario' => $pIdUsuario,
            'p_id_estado' => $pIdEstado,
            'p_id_transaccion' => $pIdTransaccion,
            'p_id_tipo_categoria' => $pIdCategoria,
            'p_id_ingreso' => $pIdIngreso,
            'p_id_presupuesto' => $pIdPresupuesto,
        ];

        DB::statement('BEGIN OBJETIVOS_FINANCIEROS_AGREGAR_OBJETIVOS_SP(
            :p_nombre_objetivo, :p_descripcion_objetivo, :p_monto_objetivo, :p_fecha_tope,
            :p_id_gasto, :p_id_usuario,:p_id_flujo,:p_id_estado,:p_id_transaccion,:p_id_tipo_categoria, :p_id_ingreso, :p_id_presupuesto
        ); END;', $bindings);
        
        DB::commit();
        $objetivos = FideObjetivosFinancierosTb::mostrarObjetivosPorUsuario(2); 
        $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        $totalObjetivos = FideObjetivosFinancierosTb::contarObjetivos();
        $objetivosActivos = FideObjetivosFinancierosTb::contarObjetivosActivos();
        $objetivosInactivos = FideObjetivosFinancierosTb::contarObjetivosInactivos();
        $porcentaje = FideObjetivosFinancierosTb::calcPorcentaje();
        return view('objetivoEconomico', compact('objetivos'), [
            'totalObjetivos' => $totalObjetivos,
            'objetivosActivos' => $objetivosActivos,
            'objetivosInactivos' =>$objetivosInactivos,
            'objetivos' => $objetivos,
            'porcentaje' => $porcentaje
        ]);
        

}

public function edit($id)
{
    $objetivo = FideObjetivosFinancierosTb::find($id);
    $presupuestos = FidePresupuestoTb::GetPresupuesto(2);
    $gastos = FideGastosTb::getGastosByUsuario(2);
    $transaccions = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
    $estados = FideEstadoTb::getAllEstados(2);
    $categorias = FideTipoCategoriaTb::getAllCategories();
    $ingresos = FideIngresosTb::mostrarIngresosPorUsuario(2);
    $flujos = FideFlujoTb::getAllFlows();
    
    return view('editarObjetivo',compact('transaccions','estados','gastos',
                                        'presupuestos','objetivo','categorias','flujos','ingresos'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nombre_objetivo' => 'required|string|max:1000',
        'descripcion_objetivo' => 'required|string',
        'monto_objetivo' => 'required|numeric',
        'fecha_tope' => 'required|date',
        'ID_GASTO' => 'required|integer',
        'ID_TIPO_CATEGORIA' => 'required|integer',
        'ID_FLUJO' => 'required|integer',
        'id_estado' => 'required|integer',
        'ID_TRANSACCION' => 'required|integer',
        'ID_PRESUPUESTO' => 'required|integer',
        'ID_INGRESO' => 'required|integer',
    ]);
    
    $id_usuario = 2;


   FideObjetivosFinancierosTb::editarObjetivo(
        $validated['nombre_objetivo'],
        $validated['descripcion_objetivo'],
        $validated['monto_objetivo'],
        $validated['fecha_tope'],
        $validated['ID_GASTO'],
        $id_usuario,
        $validated['ID_FLUJO'],
        $validated['id_estado'],
        $validated['ID_TRANSACCION'],
        $validated['ID_TIPO_CATEGORIA'],
        $validated['ID_INGRESO'],
        $validated['ID_PRESUPUESTO'],
        $id
    ); 

    return redirect()->route('objetivoEconomico')->with('statusEdit', 'success');
}

public function index()
{
    $totalObjetivos = FideObjetivosFinancierosTb::contarObjetivos();
    $objetivosActivos = FideObjetivosFinancierosTb::contarObjetivosActivos();
    $objetivosInactivos = FideObjetivosFinancierosTb::contarObjetivosInactivos();
    $porcentaje = round(FideObjetivosFinancierosTb::calcPorcentaje(), 2);
    $objetivos = FideObjetivosFinancierosTb::mostrarObjetivosPorUsuario(2); 

    return view('objetivoEconomico', [
        'totalObjetivos' => $totalObjetivos,
        'objetivosActivos' => $objetivosActivos,
        'objetivosInactivos' =>$objetivosInactivos,
        'objetivos' => $objetivos,
        'porcentaje' => $porcentaje
    ]);
}

public function cambiarEstado($id)
{
    try {
        DB::statement('CALL FIDE_OBJETIVOS_FINANCIEROS_CAMBIAR_ESTADO_SP(:id)', ['id' => $id]);

        return redirect()->back()->with('status', 'success');
    } catch (\Exception $e) {
        // Manejo de errores
        return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
    }
}
public function buscar(Request $request)
{
    $query = $request->input('buscar');
    $objetivos = FideObjetivosFinancierosTb::buscarObjetivos($query,2);
    $porcentaje = FideObjetivosFinancierosTb::calcPorcentaje();
    $totalObjetivos = FideObjetivosFinancierosTb::contarObjetivos();
    $objetivosActivos = FideObjetivosFinancierosTb::contarObjetivosActivos();
    $objetivosInactivos = FideObjetivosFinancierosTb::contarObjetivosInactivos();
    $objetivo = FideObjetivosFinancierosTb::mostrarObjetivosPorUsuario(2); 
    return view('objetivoEconomico', compact('objetivos', 'porcentaje', 'totalObjetivos', 'objetivosActivos', 'objetivosInactivos',));
}




}

        
