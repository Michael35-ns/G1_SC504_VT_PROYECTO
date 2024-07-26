<?php

namespace App\Http\Controllers;

use App\Models\Resenna;
use Illuminate\Http\Request;

// class ResennaController extends Controller
// {
//     public function index()
//     {
//         $resennas = Resenna::all();

//         return view('resennas.index', compact('resennas'));
//     }

//     public function create()
//     {
//         return view('resennas.create');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'detalle' => 'required|string|max:200',
//             'descripcion' => 'required|string|max:800',
//             'usuario_reg' => 'required|string|max:40',
//             'accion' => 'required|string|max:100',
//             'id_usuario' => 'required|integer',
//             'id_calificacion' => 'required|integer',
//         ]);

//         $resenna = Resenna::create([
//             'detalle' => $validated['detalle'],
//             'descripcion' => $validated['descripcion'],
//             'usuario_reg' => $validated['usuario_reg'],
//             'accion' => $validated['accion'],
//             'id_usuario' => $validated['id_usuario'],
//             'id_calificacion' => $validated['id_calificacion'],
//         ]);

//         return redirect()->route('resennas.index')->with([
//             'success' => 'Reseña creada con éxito.',
//             'resenna' => $resenna
//         ]);
//     }

//     public function show($idResenna)
//     {

//         $resenna = Resenna::find($idResenna);

//         if (!$resenna) {
//             return redirect()->route('resennas.index')->with('error', 'Reseña no encontrada.');
//         }

//         return view('resennas.show', compact('resenna'));
//     }
// }
