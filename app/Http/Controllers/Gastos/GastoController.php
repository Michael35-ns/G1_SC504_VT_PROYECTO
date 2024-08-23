<?php

namespace App\Http\Controllers\Gastos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FideGastosTb;
use App\Models\FideFlujoTb;
use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideIngresosTb;


class GastoController extends Controller
{

    protected $id_usuario;

    public function __construct(Request $request)
    {
        $this->id_usuario = $request->session()->get('Id_Usuario');
        if (!$this->id_usuario) {
            return redirect()->route('login')->with('mensaje', 'Por favor inicie sesión.');
        }
    }


    public function index(Request $request)
    {

        // Recuperar los parámetros de filtro desde la solicitud
        $fecha_inicial = $request->input('fecha_inicial', '1900-01-01');
        $fecha_final = $request->input('fecha_final', '2050-01-01');
        $monto_Min = $request->input('monto_min', 0);
        $monto_Max = $request->input('monto_max', 100000000000);

        // Validar los parámetros
        $validated = $request->validate([
            'fecha_inicial' => 'nullable|date',
            'fecha_final' => 'nullable|date',
            'monto_min' => 'nullable|numeric',
            'monto_max' => 'nullable|numeric',
        ]);

        $flujos = FideFlujoTb::getAllFlujos(1);
        $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_GASTOS_BY_ID_USUARIO($this->id_usuario);
        $gastosTabla = FideGastosTb::getGastosByUsuario($this->id_usuario, $fecha_inicial, $fecha_final, $monto_Min, $monto_Max);
        $suamaGastosTotales = FideGastosTb::suamaGastosTotales($this->id_usuario);

        $suamaIngresosTotales = FideIngresosTb::valoresFuncionesActivas($this->id_usuario);

        $obtenerDineroRestante = FideGastosTb::obtenerDineroRestante($this->id_usuario);
        $porcentajeGastado = FideGastosTb::porcentajeGastado($this->id_usuario);

        return view('Gastos.Gasto', compact('flujos', 'categorias', 'gastosTabla', 'suamaGastosTotales', 'suamaIngresosTotales', 'obtenerDineroRestante', 'porcentajeGastado'));
    }

    //Agregar un gasto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'monto_gasto' => 'required|numeric',
            'descripcion' => 'required|string|max:1000',
            'fecha_gasto' => 'required|date',
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
            'id_flujo' => 'required|integer|exists:fide_flujo_tb,ID_FLUJO',
        ]);
        $resultado = FideGastosTb::validadrMontoGasto($this->id_usuario, $validated['monto_gasto']);
        if ($resultado == 1) {
            FideGastosTb::agregarGasto(
                $validated['monto_gasto'],
                $validated['descripcion'],
                $validated['fecha_gasto'],
                $this->id_usuario,
                $validated['id_flujo'],
                $validated['id_transaccion']
            );
            return redirect()->route('Gasto')->with('success', 'Gasto creado con éxito');
        } else {
            session()->flash('validated', $validated);
            return redirect()->back()->with('confirmacion', 'Este gasto supera tus ingresos actuales. ¿Deseas proceder?');
        }
    }


    public function confirmar(Request $request)
    {
        $validated = $request->all();

        FideGastosTb::agregarGasto(
            $validated['monto_gasto'],
            $validated['descripcion'],
            $validated['fecha_gasto'],
            $this->id_usuario,
            $validated['id_flujo'],
            $validated['id_transaccion']
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
        $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_GASTOS_BY_ID_USUARIO($this->id_usuario);
        $flujos = FideFlujoTb::getAllFlujos(2);
        return view('Gastos.editarGastos', compact('gasto', 'categorias', 'flujos'));
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
            $validated['id_flujo']
        );

        return redirect()->route('Gasto')->with('success', 'Gasto actualizado con éxito');
    }


    //Eliminar un gasto

    public function destroy($id_gasto)
    {
        FideGastosTb::eliminarGasto($id_gasto);
        return redirect()->route('Gasto')->with('success', 'Gasto eliminado con éxito');
    }


    public function crearCategoriaGasto(Request $request)
    {
        $validated = $request->validate([
            'categoria' => 'required|string|max:1000',
            'tipo_categoria' => 'required|string'
        ]);
    
        // Determinar el valor basado en la opción seleccionada
        $tipoCategoria = $request->input('tipo_categoria') === 'gasto' ? 2 : 3;
        FideCategoriaTransaccionTb::agregarCategoria(
            $validated['categoria'],
            $tipoCategoria,
            $this->id_usuario,
            1
        );
        return redirect()->route('Gasto')->with('success', 'Categoria creada con éxito');
    }

    public function eliminarCategoria(Request $request)
    {
        $validated = $request->validate([
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
        ]);
        FideCategoriaTransaccionTb::eliminarCategoria($validated['id_transaccion']);
        return redirect()->route('Gasto')->with('success', 'Categoria eliminada con éxito');
    }


    public function show()
    {
        return view('Gasto');
    }
}
