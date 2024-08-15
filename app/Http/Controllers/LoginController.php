<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'correo_electronico' => 'required|email',
            'contrasenna' => 'required',
        ]);
        $correo_electronico = $validatedData['correo_electronico'];
        $contrasenna = $validatedData['contrasenna'];
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('BEGIN FIDE_PROYECTO_FINAL_PKG.FIDE_USUARIOS_TB_LOGIN_SP(:correo_electronico, :contrasenna, :id_usuario, :username); END;');
        $stmt->bindParam(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
        $stmt->bindParam(':contrasenna', $contrasenna, PDO::PARAM_STR);
        $id_usuario = null;
        $username = null;
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 32);
        $stmt->execute();
        if ($id_usuario) {
            $request->session()->put('NombreUsuario', $username);
            $request->session()->put('Id_Usuario', $id_usuario);
            return redirect()->route('Principal');
        } else {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
    }
}
