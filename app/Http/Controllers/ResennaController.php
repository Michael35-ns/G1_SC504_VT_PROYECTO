<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FideResennasTb;
use App\Models\ResumenRatingTb;

class ResennaController extends Controller
{
    protected $id_usuario;

    public function __construct(Request $request)
    {
        $this->id_usuario = $request->session()->get('Id_Usuario');
        if (!$this->id_usuario) {
            return redirect()->route('login')->with('mensaje', 'Por favor inicie sesión.');
        }
    }

    public function index()
    {
        $resenas = FideResennasTb::obtenerTodasResennas();
        $id_usuario = $this->id_usuario;

        $resenasCollection = collect($resenas);

        $resenasPorUsuario = $resenasCollection->filter(function ($resena) use ($id_usuario) {
            return $resena['ID_USUARIO'] == $id_usuario;
        });

        $resenasOtras = $resenasCollection->filter(function ($resena) use ($id_usuario) {
            return $resena['ID_USUARIO'] != $id_usuario;
        });

        $resenasOrdenadas = $resenasPorUsuario->concat($resenasOtras);
        
        return view('resennas.Resena', compact('resenasOrdenadas', 'id_usuario'));
    }

    public function create()
    {
        return view('resennas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'detalle' => 'required|string|max:200',
            'descripcion' => 'required|string|max:800',
            'rating' => 'required|numeric|min:0|max:5'
        ]);

        FideResennasTb::agregarResenna(
            $validated['detalle'],
            $validated['descripcion'],
            $this->id_usuario,
            $validated['rating']
        );

        return redirect()->route('resena')->with('success', 'Reseña creada exitosamente.');
    }

    public function confirmarEliminacion($id)
    {

        $resenna = FideResennasTb::encontrarResennaPorID($id);

        if ($resenna) {
            return view('resennas.delete', ['resenna' => $resenna]);
        }

        return redirect()->route('resena')->with('error', 'Reseña no encontrada.');
    }

    public function eliminar(Request $request, $id)
    {
        $resenna = FideResennasTb::encontrarResennaPorID($id);

        if ($resenna) {
            FideResennasTb::eliminarResenna($id);

            return redirect()->route('resena')->with('success', 'Reseña eliminada correctamente.');
        }

        return redirect()->route('resena')->with('error', 'Reseña no encontrada.');
    }

}
