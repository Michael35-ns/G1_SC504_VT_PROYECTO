<?php


namespace App\Http\Controllers;

use App\Models\Resenna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResennaController extends Controller
{
    public function index()
    {
        $resennas = Resenna::with('usuario')->get(); // Asegúrate de que el modelo tenga una relación 'usuario'
        return view('resennas.index', compact('resennas'));
    }

    public function create()
    {
        return view('resennas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'detalle' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Resenna::create([
            'detalle' => $request->detalle,
            'descripcion' => $request->descripcion,
            'usuario_id' => Auth::id(),
            'calificacion' => 0, // Calificación inicial
        ]);

        return redirect()->route('resennas.index')->with('success', 'Reseña creada con éxito.');
    }

    public function edit(Resenna $resenna)
    {
        return view('resennas.edit', compact('resenna'));
    }

    public function update(Request $request, Resenna $resenna)
    {
        $request->validate([
            'detalle' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $resenna->update([
            'detalle' => $request->detalle,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('resennas.index')->with('success', 'Reseña actualizada con éxito.');
    }

    public function destroy(Resenna $resenna)
    {
        $resenna->delete();
        return redirect()->route('resennas.index')->with('success', 'Reseña eliminada con éxito.');
    }
}
