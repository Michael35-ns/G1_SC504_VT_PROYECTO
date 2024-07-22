<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjetivoEconomicoController extends Controller
{
    public function index()
    {
        return view('objetivoEconomico');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);
        return redirect()->route('objetivoEconomico')->with('success', 'Objetivo creado con éxito');
 
    }
}