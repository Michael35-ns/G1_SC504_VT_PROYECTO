<?php

use App\Http\Controllers\Ingresos\IngresoController;
use Illuminate\Support\Facades\Route;

Route::get('/Ingresos', [IngresoController::class, 'index'])->name('Ingreso');
Route::get('/verMas/{id}', [IngresoController::class, 'mostrarIngreso'])->name('verMasForm');
Route::post('/eliminarIngreso/{id}', [IngresoController::class, 'destroy'])->name('eliminarIngreso');
Route::post('/registrarIngresos', [IngresoController::class, 'store'])->name('registrarIngresos');
Route::get('/editarIngreso/{id}', [IngresoController::class, 'edit'])->name('editarIngresoFormulario');
Route::put('/editarIngreso/{id}', [IngresoController::class, 'update'])->name('editarIngreso');
Route::post('/agregarCategoria', [IngresoController::class, 'crearCategoriaIngreso'])->name('ingreso.agregarCategoria');
Route::post('/eliminarCategoria', [IngresoController::class, 'eliminarCategoria'])->name('ingreso.eliminarCategoria');

