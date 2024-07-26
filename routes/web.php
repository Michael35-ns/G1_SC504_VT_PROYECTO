<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OracleController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ObjetivoEconomicoController;
use App\Http\Controllers\PresupuestoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-user',[OracleController::class,'agregarUsuario']);

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/login',[LoginController::class,'store']);


Route::get('/Ingresos', [IngresoController::class, 'index'])->name('Ingreso');
Route::post('/buscarIngresos', [IngresoController::class, 'store'])->name('buscarIngresos');

Route::post('/registrarIngresos', [IngresoController::class, 'store'])->name('registrarIngresos');

Route::get('/Gasto', [GastoController::class, 'index'])->name('Gasto');

Route::get('/editarIngreso/{id}', [IngresoController::class, 'edit'])->name('editarIngresoFormulario');
Route::put('/editarIngreso/{id}', [IngresoController::class, 'update'])->name('editarIngreso');

Route::get('/crear-objetivo', [ObjetivoEconomicoController::class, 'create'])->name('crearObjetivoEconomico');
Route::post('/agregar-objetivo', [ObjetivoEconomicoController::class, 'agregarObjetivo']);
Route::get('/objetivoEconomico', [ObjetivoEconomicoController::class, 'index'])->name('objetivoEconomico');

Route::resource('presupuestos', PresupuestoController::class)->only(['index', 'show']);


