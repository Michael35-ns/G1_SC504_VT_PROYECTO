<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\FideUsuariosTb;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:40',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'required|string|max:50',
            'username' => 'required|string|max:30',
            'correo_electronico' => 'required|string|max:50',
            'contrasenna' => 'required|string|max:50|min:4',
            'foto_perfil_url' => 'nullable|string|max:3000',
        ]);

        FideUsuariosTb::agregarUsuario(
            $validated['nombre'],
            $validated['primer_apellido'],
            $validated['segundo_apellido'],
            $validated['username'],
            $validated['correo_electronico'],
            $validated['contrasenna'],
            $validated['foto_perfil_url'] ?? null,
            2,
            1
        );

        return redirect()->route('login')->with('success', 'Usuario registrado con éxito');
    }
}
