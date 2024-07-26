<?php
 
namespace App\Http\Controllers;
 
use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideEstadoTb;
use App\Models\FideIngresosTb;
use Illuminate\Http\Request;
 
class IngresoController extends Controller
{
    public function index()
    {
        $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        $estados = FideEstadoTb::getAllEstados(2);
        $ingresosTabla = FideIngresosTb::mostrarIngresosPorUsuario(2);
        return view('Ingreso', compact('categorias', 'estados', 'ingresosTabla'));
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NombreIngreso' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'fecha_ingreso' => 'required|date',
            'monto_ingreso' => 'required|numeric',
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
            'id_estado' => 'required|integer|exists:fide_estado_tb,ID_ESTADO',
        ]);
 

    
        FideIngresosTb::agregarIngreso(
            $validated['descripcion'],
            $validated['monto_ingreso'],
            $validated['fecha_ingreso'],
            2,
            $validated['id_transaccion'],
            $validated['id_estado']
        );
 
        return redirect()->route('Ingreso')->with('success', 'Ingreso creado con éxito');
    }
 
    public function edit($id)
    {
        $ingreso = FideIngresosTb::find($id);
        $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        $estados = FideEstadoTb::getAllEstados(2);
        return view('Ingresos.editar', compact('ingreso', 'categorias', 'estados'));
    }
 
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:1000',
            'monto_ingreso' => 'required|numeric',
            'fecha_ingreso' => 'required|date',
            'id_transaccion' => 'required|integer|exists:fide_categoria_transaccion_tb,ID_TRANSACCION',
            'id_estado' => 'required|integer|exists:fide_estado_tb,ID_ESTADO',
        ]);
 
        $id_usuario = 2;
 
        FideIngresosTb::editarIngreso(
            $id,
            $validated['descripcion'],
            $validated['monto_ingreso'],
            $validated['fecha_ingreso'],
            $id_usuario,
            $validated['id_transaccion'],
            $validated['id_estado']
        );
 
        return redirect()->route('Ingreso')->with('success', 'Ingreso actualizado con éxito');
    }
}
 