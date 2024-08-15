<?php

namespace App\Http\Controllers;

use App\Models\FideGastosTb;
use App\Models\FideFlujoTb;
use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideIngresosTb;
use Illuminate\Http\Request;


class GastoController extends Controller
{

   //Imprimir la tabla, sin filtros
   public function index(Request $request)
   {
       $id_usuario = $request->session()->get('Id_Usuario');
       if (!$id_usuario) {
           return redirect()->route('login')->with('mensaje', 'Por favor inicie sesión.');
       }
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

       $flujos = FideFlujoTb::getAllFlujos(2);
       $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_GASTOS_BY_ID_USUARIO($id_usuario);
       $gastosTabla = FideGastosTb::getGastosByUsuario($id_usuario, $fechaInicio, $fechaFin, $montoMin, $montoMax);
       $suamaGastosTotales = FideGastosTb::suamaGastosTotales($id_usuario);
       $suamaIngresosTotales = FideIngresosTb::valoresFuncionesActivas($id_usuario);
       $obtenerDineroRestante = FideGastosTb::obtenerDineroRestante($id_usuario);
       $porcentajeGastado = FideGastosTb::porcentajeGastado($id_usuario);

       return view('Gasto', compact('flujos', 'categorias', 'gastosTabla', 'suamaGastosTotales', 'suamaIngresosTotales', 'obtenerDineroRestante', 'porcentajeGastado'));

   }

   //Agregar un gasto
   public function store(Request $request)
   {
       $id_usuario = $request->session()->get('Id_Usuario');
       if (!$id_usuario) {
           return redirect()->route('login')->with('mensaje', 'Por favor inicie sesión.');
       }
       $validated = $request->validate([
           'monto_gasto' => 'required|numeric',
           'descripcion' => 'required|string|max:1000',
           'fecha_gasto' => 'required|text',
           'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
           'id_flujo' => 'required|integer|exists:fide_flujo_tb,ID_FLUJO',
       ]);
       FideGastosTb::agregarGasto(
           $validated['monto_gasto'],
           $validated['descripcion'],
           $validated['fecha_gasto'],
           $id_usuario,
           $validated['id_flujo'],
           $validated['id_transaccion'],
           1
       );
       return redirect()->route('Gasto')->with('success', 'Gasto creado con éxito');
   }


   //Ver mas info del gasto
   public function VerMasInfo($id_gasto)
   {
       $gastoTabla = FideGastosTb::encontrarGastoPorID($id_gasto);
       return view('Gastos.gasto_verMas', compact('gastoTabla'));
   }
   

   //Envia toda la info vieja del gasto a editar
   public function edit($id_gasto)
   {
       $gasto = FideGastosTb::encontrarGastoPorID($id_gasto);
       $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
       $flujos = FideFlujoTb::getAllFlujos(2);
       return view('Gastos.editarGasto', compact('gasto', 'categorias', 'flujos'));
   }

   //Edita el gasto
   public function update(Request $request, $id)
   {
       $validated = $request->validate([
           'descripcion' => 'required|string|max:1000',
           'monto_gasto' => 'required|numeric',
           'fecha_gasto' => 'required|date',
           'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
           'id_flujo' => 'required|integer|exists:fide_flujo_tb,ID_FLUJO'
       ]);

       FideGastosTb::editarGasto(
           $id,
           $validated['descripcion'],
           $validated['monto_gasto'],
           $validated['fecha_gasto'],
           $validated['id_transaccion'],
           $validated['id_flujo'],
           1
       );

       return redirect()->route('Gasto')->with('success', 'Gasto actualizado con éxito');
   }


   //Eliminar un gasto

   public function destroy($id_gasto)
   {
       FideGastosTb::eliminarGasto($id_gasto);
       return redirect()->route('Gasto')->with('success', 'Gasto eliminado con éxito');
   }


   public function show()
   {
       return view('Gasto');
   }
   

}