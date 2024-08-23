<?php

namespace App\Http\Controllers;

use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideObjetivosFinancierosTb;
use Illuminate\Http\Request;
use App\Models\FideEstadoTb;
use App\Models\FideIngresosTb;
use App\Models\FideFlujoTb;
use Illuminate\Support\Facades\DB;

class ObjetivoEconomicoController extends Controller
{

    protected $id_usuario;

    public function __construct(Request $request)
    {
        $this->id_usuario = $request->session()->get('Id_Usuario');
        if (!$this->id_usuario) {
            return redirect()->route('login')->with('mensaje', 'Por favor inicie sesión.');
        }
    }
    public function create()
    {
        $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_OBJETIVOS_BY_ID_USUARIO($this->id_usuario);
        $estados = FideEstadoTb::getAllEstados($this->id_usuario);
        $ingresos = FideIngresosTb::mostrarIngresosPorUsuarios($this->id_usuario);
        $flujos = FideFlujoTb::getAllFlujos($this->id_usuario);
        return view('crearObjetivo', compact(
            'categorias',
            'estados',
            'ingresos',
            'flujos'
        ));
    }

   public function agregarObjetivo(Request $request)
    {
        $pNombreObjetivo = $request->input('nombre_objetivo');
        $pDescripcionObjetivo = $request->input('descripcion_objetivo');
        $pMontoObjetivo = $request->input('monto_objetivo');
        $pFechaTope = $request->input('fecha_tope');
        $pIdFlujo = $request->input('ID_FLUJO');
        $pIdEstado = $request->input('ID_ESTADO');
        $pIdTransaccion = $request->input('ID_TRANSACCION');
        $pIdUsuario = $this->id_usuario;

        DB::beginTransaction();

        FideObjetivosFinancierosTb::agregarObjetivo(
            $pNombreObjetivo, $pDescripcionObjetivo, $pMontoObjetivo, $pFechaTope,
            $pIdFlujo, $pIdEstado, $pIdTransaccion, $pIdUsuario
        );

        $objetivos = FideObjetivosFinancierosTb::mostrarObjetivosPorUsuario($this->id_usuario);
        $categorias = FideCategoriaTransaccionTb::Mostrar_Categorias_OBJETIVOS_BY_ID_USUARIO($this->id_usuario);
        $totalObjetivos = FideObjetivosFinancierosTb::contarObjetivos($this->id_usuario);
        $objetivosActivos = FideObjetivosFinancierosTb::contarObjetivosActivos($this->id_usuario);
        $objetivosInactivos = FideObjetivosFinancierosTb::contarObjetivosInactivos($this->id_usuario);
        $porcentaje = FideObjetivosFinancierosTb::calcPorcentaje($this->id_usuario);

        return view('objetivoEconomico', compact('objetivos'), [
            'totalObjetivos' => $totalObjetivos,
            'objetivosActivos' => $objetivosActivos,
            'objetivosInactivos' => $objetivosInactivos,
            'porcentaje' => $porcentaje
        ]);
    }

    public function edit($id)
    {
        $objetivo = FideObjetivosFinancierosTb::find($id);
        $transaccions = FideCategoriaTransaccionTb::Mostrar_Categorias_OBJETIVOS_BY_ID_USUARIO($this->id_usuario);
        $estados = FideEstadoTb::getAllEstados($this->id_usuario);
        $flujos = FideFlujoTb::getAllFlujos($this->id_usuario);

        return view('editarObjetivo', compact(
            'transaccions',
            'estados',
            'objetivo',
            'flujos'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre_objetivo' => 'required|string|max:1000',
            'descripcion_objetivo' => 'required|string',
            'monto_objetivo' => 'required|numeric',
            'fecha_tope' => 'required|date',
            'ID_FLUJO' => 'required|integer',
            'id_estado' => 'required|integer',
        ]);

        FideObjetivosFinancierosTb::editarObjetivo(
            $validated['nombre_objetivo'],
            $validated['descripcion_objetivo'],
            $validated['monto_objetivo'],
            $validated['fecha_tope'],
            $this->id_usuario,
            $validated['ID_FLUJO'],
            $validated['id_estado'],
            $id
        );

        return redirect()->route('objetivoEconomico')->with('statusEdit', 'success');
    }

    public function index()
    {
        $totalObjetivos = FideObjetivosFinancierosTb::contarObjetivos( $this->id_usuario);
        $objetivosActivos = FideObjetivosFinancierosTb::contarObjetivosActivos($this->id_usuario);
        $objetivosInactivos = FideObjetivosFinancierosTb::contarObjetivosInactivos( $this->id_usuario);
        $porcentaje = FideObjetivosFinancierosTb::calcPorcentaje( $this->id_usuario);
        $objetivos = FideObjetivosFinancierosTb::mostrarObjetivosPorUsuario($this->id_usuario);

        return view('objetivoEconomico', [
            'totalObjetivos' => $totalObjetivos,
            'objetivosActivos' => $objetivosActivos,
            'objetivosInactivos' => $objetivosInactivos,
            'objetivos' => $objetivos,
            'porcentaje' => $porcentaje
        ]);
    }

    public function cambiarEstado($id)
    {
        try {
            DB::statement('CALL FIDE_PROYECTO_FINAL_PKG.FIDE_OBJETIVOS_FINANCIEROS_CAMBIAR_ESTADO_SP(:id)', ['id' => $id]);

            return redirect()->back()->with('status', 'success');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }


    public function buscar(Request $request)
    {
        $query = $request->input('buscar');
        $objetivos = FideObjetivosFinancierosTb::buscarObjetivos($query, 2);
        $porcentaje = FideObjetivosFinancierosTb::calcPorcentaje( $this->id_usuario);
        $totalObjetivos = FideObjetivosFinancierosTb::contarObjetivos( $this->id_usuario);
        $objetivosActivos = FideObjetivosFinancierosTb::contarObjetivosActivos($this->id_usuario);
        $objetivosInactivos = FideObjetivosFinancierosTb::contarObjetivosInactivos( $this->id_usuario);
        $objetivo = FideObjetivosFinancierosTb::mostrarObjetivosPorUsuario( $this->id_usuario);
        return view('objetivoEconomico', compact('objetivos', 'porcentaje', 'totalObjetivos', 'objetivosActivos', 'objetivosInactivos',));
    }


public function view($id)
{
    $objetivos = FideObjetivosFinancierosTb::mostrarObjetivosId($this->id_usuario,$id);
    return view('verObjetivo', [
        'objetivos' => $objetivos
    ]);
}
}
