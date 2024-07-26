<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\IngresoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ingresos', [IngresoController::class, 'index'])->name('Ingreso');

Route::get('/crearGasto', [GastoController::class, 'index'])->name('crearGasto');
Route::post('/registrarIngresos', [IngresoController::class, 'store'])->name('registrarIngresos');

Route::get('/editarIngreso/{id}', [IngresoController::class, 'edit'])->name('editarIngresoFormulario');
Route::put('/editarIngreso/{id}', [IngresoController::class, 'update'])->name('editarIngreso');


