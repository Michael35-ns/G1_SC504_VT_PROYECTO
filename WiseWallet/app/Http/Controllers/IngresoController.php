<?php

namespace App\Http\Controllers;

use App\Models\FideCategoriaTransaccionTb;
use App\Models\FideIngresosTb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngresoController extends Controller
{
    public function index()
    {
        // $categorias=FideCategoriaTransaccionTb::all();
        $categorias = FideCategoriaTransaccionTb::SP_ALL_BY_ID(2);
        return view('crearIngreso', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'NombreIngreso' => 'required|string|max:50',
            'categoria' => 'required|string|max:50',
            'descripcion' => 'required|string|max:200',
            'monto' => 'required|numeric',
        ]);

        $data = [
            'DESCRIPCION_INGRESO' => $validatedData['NombreIngreso'],
            'MONTO_INGRESO' => $validatedData['monto'],
            'FECHA_INGRESO' => now(),
            'ID_USUARIO' => auth()->id(),
            'ID_TRANSACCION' => null,
            'ID_ESTADO' => 1,
        ];

        $ingreso = new FideIngresosTb();
        $ingreso->agregarIngreso($data);

        return redirect()->route('crearIngreso')->with('success', 'Ingreso creado con éxito');
    }
}
