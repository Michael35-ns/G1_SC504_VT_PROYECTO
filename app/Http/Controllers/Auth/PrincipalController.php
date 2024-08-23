<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ResumenRatingTb;
use App\Http\Controllers\Controller;
use App\Models\PeorResenaTb;
use App\Models\ResenasTopTb;

class PrincipalController extends Controller
{
    public function index(): View
    {   

        $resumen = ResumenRatingTb::first(); 

        if (!$resumen) {
            return view('principal')->with('error', 'No se encontraron datos en la vista.');
        }

        $usuariosTop5 = ResenasTopTb::all();
        $peorCalificacion = PeorResenaTb::obtenerPeorCalificacion()->first();

        return view('guest.principal',compact('resumen','usuariosTop5','peorCalificacion'));

    }
}
