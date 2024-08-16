<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        $request->session()->forget('NombreUsuario');
        $request->session()->forget('Id_Usuario');
        return redirect()->route('login');
    }
}
