<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OracleController extends Controller
{
    public function agregarUsuario(Request $request)
    {
    $pUsername = $request->input('username');
    $pEmail = $request->input('email');

    $bindings = [
        'p_username' => $pUsername,
        'p_existe' => 0,
    ];
    DB::statement('BEGIN USUARIOS_VALIDAR_USERNAME_EXISTE_SP(:p_username, :p_existe); END;', $bindings);
    $usernameExists = $bindings['p_existe']< 0;

    $bindings = [
        'p_correo' => $pEmail,
        'p_existe' => 0,
    ];
    DB::statement('BEGIN USUARIOS_VALIDAR_CORREO_EXISTE_SP(:p_correo, :p_existe); END;', $bindings);
    $emailExists = $bindings['p_existe'] < 0;

    if ($usernameExists || $emailExists) {

        return back()->withErrors(['username' => 'El usuario o correo electrónico ya existe']);
    }

        $pNombre = $request->input('nombre');
        $pApellido1 = $request->input('apellido1');
        $pApellido2 = $request->input('apellido2');
        $pPassword = $request->input('password');
    
        $pImage = $request->file('image');
        $imageName = null;
        if ($pImage) {
            $imageName = time(). '.'. $pImage->getClientOriginalExtension();
            $pImage->move(public_path('images'), $imageName);
        }
    
        $bindings = [
            'pNombre' => $pNombre,
            'pApellido1' => $pApellido1,
            'pApellido2' => $pApellido2,
            'pUsername' => $pUsername,
            'pEmail' => $pEmail,
            'pPassword' => $pPassword,
            'pImage' => $imageName,
        ];
    
        DB::statement('BEGIN USUARIOS_AGREGAR_USUARIOS_SP(:pNombre, :pApellido1, :pApellido2, :pUsername, 
                                                              :pEmail, :pPassword, :pImage); END;', $bindings);
        return view('auth.login');
    }

    
}

