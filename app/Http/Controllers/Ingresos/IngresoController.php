<?php

namespace App\Http\Controllers\Ingresos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FideFlujoTb;
use App\Models\FideEstadoTb;
use App\Models\FideIngresosTb;
use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideGastosTb;

class IngresoController extends Controller
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
        // Ya no necesitas obtener $id_usuario aquí porque está en $this->id_usuario
        $fechaInicio = $request->input('fecha_inicial', '1900-01-01');
        $fechaFin = $request->input('fecha_final', '2050-01-01');
        $montoMin = $request->input('monto_min', 0);
        $montoMax = $request->input('monto_max', 100000000000);

        $validated = $request->validate([
            'fecha_inicial' => 'nullable|date',
            'fecha_final' => 'nullable|date',
            'monto_min' => 'nullable|numeric',
            'monto_max' => 'nullable|numeric',
        ]);

        $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_INGRESOS_BY_ID_USUARIO($this->id_usuario);
        $flujos = FideFlujoTb::getAllFlujos($this->id_usuario);
        $ingresosTabla = FideIngresosTb::mostrarIngresosPorUsuario($this->id_usuario, $fechaInicio, $fechaFin, $montoMin, $montoMax);
        $estados = FideEstadoTb::getAllEstados();
        $resultado = FideIngresosTb::valoresFuncionesActivas($this->id_usuario);

        $suamaGastosTotales = FideGastosTb::suamaGastosTotales($this->id_usuario);
        $suamaIngresosTotales = FideIngresosTb::valoresFuncionesActivas($this->id_usuario);
        $obtenerDineroRestante = FideGastosTb::obtenerDineroRestante($this->id_usuario);
        $porcentajeGastado = FideGastosTb::porcentajeGastado($this->id_usuario);

        return view('Ingresos.Ingreso', compact('categorias', 'flujos', 'ingresosTabla', 'estados', 'resultado', 'fechaInicio', 'fechaFin', 'montoMin', 'montoMax', 'obtenerDineroRestante', 'suamaGastosTotales', 'porcentajeGastado'));
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
            $this->id_usuario,
            $validated['id_transaccion'],
            $validated['id_flujo'],
            1
        );

        return redirect()->route('Ingreso')->with('success', 'Ingreso creado con éxito');
    }

    public function edit($id)
    {
        $ingreso = FideIngresosTb::encontrarIngresoPorID($id);
        $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_INGRESOS_BY_ID_USUARIO($this->id_usuario);
        $flujos = FideFlujoTb::getAllFlujos($this->id_usuario);
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

    public function crearCategoriaIngreso(Request $request)
    {
        $validated = $request->validate([
            'categoria' => 'required|string|max:1000'
        ]);
        FideCategoriaTransaccionTb::agregarCategoria(
            $validated['categoria'],
            1,
            $this->id_usuario,
            1
        );
        return redirect()->route('Ingreso')->with('success', 'Categoria creada con éxito');
    }

    public function eliminarCategoria(Request $request)
    {
        $validated = $request->validate([
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
        ]);
        FideCategoriaTransaccionTb::eliminarCategoria($validated['id_transaccion']);
        return redirect()->route('Ingreso')->with('success', 'Categoria eliminada con éxito');
    }
}
