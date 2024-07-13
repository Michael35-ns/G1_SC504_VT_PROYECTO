<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/', function () {
    $roles = DB::table('FIDE_ROL_TB')
                ->select(
                    'ID_ROL as id_rol',
                    'DESCRIPCION as descripcion',
                    'NOMBRE_ROL as nombre_rol',
                    'USUARIO_REG as usuario_reg',
                    'FECHA_ACCION as fecha_accion',
                    'ACCION as accion'
                )
                ->get();
    return view('welcome', ['roles' => $roles]);
});
*/