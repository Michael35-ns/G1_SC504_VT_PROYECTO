<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\IngresoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crearIngreso', [IngresoController::class, 'index'])->name('crearIngreso');
Route::get('/crearGasto', [GastoController::class, 'index'])->name('crearGasto');
Route::post('/buscarIngresos', [IngresoController::class, 'store'])->name('buscarIngresos');
Route::post('/registrarIngresos', [IngresoController::class, 'store'])->name('registrarIngresos');
Route::post('/crearIngreso', [IngresoController::class, 'store'])->name('ingreso.store');



// Route::get('/', function () {
//     $roles = DB::table('FIDE_ROL_TB')
//                 ->select(
//                     'ID_ROL as id_rol',
//                     'DESCRIPCION as descripcion',
//                     'NOMBRE_ROL as nombre_rol',
//                     'USUARIO_REG as usuario_reg',
//                     'FECHA_ACCION as fecha_accion',
//                     'ACCION as accion'
//                 )
//                 ->get();
//     return view('welcome', ['roles' => $roles]);
// });
