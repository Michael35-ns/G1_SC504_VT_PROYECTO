<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class IngresoController extends Controller
{

    public function index(){
        return view('crearIngreso');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Guardar el ingreso en la base de datos
        // Aquí deberías añadir tu lógica para guardar el ingreso
        // Por ejemplo:
        // Ingreso::create($request->all());

        // Redirigir a una ruta o vista específica
        return redirect()->route('crearIngreso')->with('success', 'Ingreso creado con éxito');
    }

    public function show()
    {
        $label = 'Progreso';
        $percentage = 75;

        return view('crearIngreso', compact('label', 'percentage'));
    }

}