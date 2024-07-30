<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\FideFlujoTb;
use App\Models\FideEstadoTb;
use Illuminate\Http\Request;
use App\Models\FideIngresosTb;
use App\Models\FideCategoriaTransaccionTb;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
        // Recuperar los parámetros de filtro desde la solicitud
        $fechaInicio = $request->input('fecha_inicial', '1900-01-01');
        $fechaFin = $request->input('fecha_final', '2050-01-01');
        $montoMin = $request->input('monto_min', 0);
        $montoMax = $request->input('monto_max', 100000000000);

        // Validar los parámetros
        $validated = $request->validate([
            'fecha_inicial' => 'nullable|date',
            'fecha_final' => 'nullable|date',
            'monto_min' => 'nullable|numeric',
            'monto_max' => 'nullable|numeric',
        ]);

        // Obtener los datos
        $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        $flujos = FideFlujoTb::getAllFlujos(2);
        $ingresosTabla = FideIngresosTb::mostrarIngresosPorUsuario(2, $fechaInicio, $fechaFin, $montoMin, $montoMax);
        $estados = FideEstadoTb::getAllEstados();
        $resultado = FideIngresosTb::valoresFuncionesActivas(2);

        
        // Pasar los datos a la vista
        return view('Ingreso', compact('categorias', 'flujos', 'ingresosTabla', 'estados', 'resultado', 'fechaInicio', 'fechaFin', 'montoMin', 'montoMax'));
    }


    public function mostrarIngreso($id)
    {
        $ingresoTabla = FideIngresosTb::encontrarIngresoPorID($id);
        return view('Ingresos.verMas', compact('ingresoTabla'));
    }

    public function verFiltros()
    {
        return view('Ingresos.filtros');
    }

    public function destroy($id)
    {
        FideIngresosTb::eliminarIngreso($id);
        return redirect()->route('Ingreso')->with('success', 'Ingreso eliminado con éxito');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:1000',
            'fecha_ingreso' => 'required|date',
            'monto_ingreso' => 'required|numeric',
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
            'id_flujo' => 'required|integer|exists:fide_flujo_tb,ID_FLUJO',
        ]);

        FideIngresosTb::agregarIngreso(
            $validated['descripcion'],
            $validated['monto_ingreso'],
            $validated['fecha_ingreso'],
            2,
            $validated['id_transaccion'],
            $validated['id_flujo'],
            1
        );

        return redirect()->route('Ingreso')->with('success', 'Ingreso creado con éxito');
    }

    public function edit($id)
    {
        $ingreso = FideIngresosTb::encontrarIngresoPorID($id);
        $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        $flujos = FideFlujoTb::getAllFlujos(2);
        $estados = FideEstadoTb::getAllEstados();
        return view('Ingresos.editar', compact('ingreso', 'categorias', 'flujos', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:1000',
            'monto_ingreso' => 'required|numeric',
            'fecha_ingreso' => 'required|date',
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
            'id_flujo' => 'required|integer|exists:fide_flujo_tb,ID_FLUJO'
        ]);

        FideIngresosTb::editarIngreso(
            $id,
            $validated['descripcion'],
            $validated['monto_ingreso'],
            $validated['fecha_ingreso'],
            $validated['id_transaccion'],
            $validated['id_flujo'],
            1
        );

        return redirect()->route('Ingreso')->with('success', 'Ingreso actualizado con éxito');
    }
}
