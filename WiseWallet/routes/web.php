<?php

use App\Http\Controllers\GraficoController;
use App\Http\Controllers\IngresoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crearIngreso', [IngresoController::class, 'index'])->name('crearIngreso');
Route::get('/crearIngreso', [IngresoController::class, 'show'])->name('crearIngreso');
Route::post('/crearIngreso', [IngresoController::class, 'store'])->name('ingreso.store');

Route::get('/grafico', [GraficoController::class, 'show'])->name('grafico');

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