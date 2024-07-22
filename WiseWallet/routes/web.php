<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ObjetivoEconomicoController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/crearIngreso', [IngresoController::class, 'index'])->name('crearIngreso');
Route::get('/crearGasto', [IngresoController::class, 'index'])->name('crearGasto');
Route::post('/buscarIngresos', [IngresoController::class, 'store'])->name('buscarIngresos');

Route::post('/crearIngreso', [IngresoController::class, 'store'])->name('ingreso.store');

Route::get('/objetivoEconomico', [ObjetivoEconomicoController::class, 'index'])->name('objetivoEconomico');  // Asegúrate de tener esta línea

Route::post('/objetivoEconomico', [ObjetivoEconomicoController::class, 'store'])->name('objetivoEconomico.store'); //


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