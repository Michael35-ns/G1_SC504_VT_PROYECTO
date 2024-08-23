<?php

use App\Http\Controllers\Gastos\GastoController;
use Illuminate\Support\Facades\Route;



Route::get('/Gasto', [GastoController::class, 'index'])->name('Gasto');
Route::post('/registrarGastos', [GastoController::class, 'store'])->name('registrarGastos');
Route::post('/confirmarGasto', [GastoController::class, 'confirmar'])->name('gastos.confirmar');
Route::get('/verMas/{id}', [GastoController::class, 'VerMasInfo'])->name('gastoVerMasInfo');
Route::get('/editarGasto/{id}', [GastoController::class, 'edit'])->name('editarGastoFormulario');
Route::put('/editarGasto/{id}', [GastoController::class, 'update'])->name('editarGasto');
Route::post('/eliminarGasto/{id}', [GastoController::class, 'destroy'])->name('eliminarGasto');
Route::post('/agregarCategoria', [GastoController::class, 'crearCategoriaGasto'])->name('agregarCategoria');
Route::post('/eliminarCategoria', [GastoController::class, 'eliminarCategoria'])->name('eliminarCategoria');
