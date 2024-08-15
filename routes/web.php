<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ObjetivoEconomicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Principal', [PrincipalController::class, 'index'])->name('Principal');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/agregarUsuario', [RegisterController::class, 'store'])->name('agregarUsuario');


Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/Ingresos', [IngresoController::class, 'index'])->name('Ingreso');
Route::get('/verMas/{id}', [IngresoController::class, 'mostrarIngreso'])->name('verMasForm');
Route::post('/eliminarIngreso/{id}', [IngresoController::class, 'destroy'])->name('eliminarIngreso');
Route::post('/registrarIngresos', [IngresoController::class, 'store'])->name('registrarIngresos');
Route::get('/editarIngreso/{id}', [IngresoController::class, 'edit'])->name('editarIngresoFormulario');
Route::put('/editarIngreso/{id}', [IngresoController::class, 'update'])->name('editarIngreso');

Route::get('/Gasto', [GastoController::class, 'index'])->name('Gasto');
Route::post('/registrarGastos', [GastoController::class, 'store'])->name('registrarGastos');
Route::get('/verMas/{id}', [GastoController::class, 'VerMasInfo'])->name('gastoVerMasInfo');
Route::get('/editarGasto/{id}', [GastoController::class, 'edit'])->name('editarGastoFormulario');
Route::put('/editarGasto/{id}', [GastoController::class, 'update'])->name('editarGasto');
Route::post('/eliminarGasto/{id}', [GastoController::class, 'destroy'])->name('eliminarGasto');

Route::get('/crear-objetivo', [ObjetivoEconomicoController::class, 'create'])->name('crearObjetivoEconomico');
Route::post('/agregar-objetivo', [ObjetivoEconomicoController::class, 'agregarObjetivo']);
Route::get('/objetivoEconomico', [ObjetivoEconomicoController::class, 'index'])->name('objetivoEconomico');

Route::resource('presupuestos', PresupuestoController::class)->only(['index', 'show']);
