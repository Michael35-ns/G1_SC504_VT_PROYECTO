<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        $request->session()->forget('NombreUsuario');
        $request->session()->forget('Id_Usuario');
        return redirect()->route('login');
    }
}
