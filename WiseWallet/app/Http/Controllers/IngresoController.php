<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        return view('crearIngreso');
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
            'DESCRIPCION_INGRESO' => $validatedData['descripcion'],
            'MONTO_INGRESO' => $validatedData['monto'],
            'FECHA_INGRESO' => now(),
            'ID_USUARIO' => auth()->id(),
            'ID_TRANSACCION' => null,
            'ID_ESTADO' => 1,
        ];

        $ingreso = new Ingreso();
        $ingreso->agregarIngreso($data);

        return redirect()->route('crearIngreso')->with('success', 'Ingreso creado con éxito');
    }

    public function show()
    {
        $label = 'Progreso';
        $percentage = 75;

        return view('crearIngreso', compact('label', 'percentage'));
    }
}