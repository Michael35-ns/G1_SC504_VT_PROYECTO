<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ObjetivoEconomicoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OracleController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/agregar-usuario', [OracleController::class, 'agregarUsuario']);


Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/login',[LoginController::class,'store']);
Route::post('/iniciar-sesion',[OracleController::class, 'iniciarSesion']);

Route::get('/crearIngreso', [IngresoController::class, 'index'])->name('crearIngreso');
Route::get('/crearGasto', [IngresoController::class, 'index'])->name('crearGasto');
Route::post('/buscarIngresos', [IngresoController::class, 'store'])->name('buscarIngresos');

Route::post('/crearIngreso', [IngresoController::class, 'store'])->name('ingreso.store');

Route::get('/crear-objetivo', [ObjetivoEconomicoController::class, 'create'])->name('crearObjetivoEconomico');
Route::post('/agregar-objetivo', [ObjetivoEconomicoController::class, 'agregarObjetivo']);
Route::get('/objetivoEconomico', [ObjetivoEconomicoController::class, 'index'])->name('objetivoEconomico');



