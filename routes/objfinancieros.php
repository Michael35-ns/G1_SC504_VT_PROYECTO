<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetivoEconomicoController;
use App\Http\Controllers\PresupuestoController;

Route::get('/crearObjetivo', [ObjetivoEconomicoController::class, 'create'])->name('crearObjetivoEconomico');
Route::post('/agregarObjetivos', [ObjetivoEconomicoController::class, 'agregarObjetivo'])->name('agregarObjetivos');
Route::get('/editarObjetivo/{id}', [ObjetivoEconomicoController::class, 'edit'])->name('editarObjetivoEconomico');
Route::put('/editarObjetivo/{id}', [ObjetivoEconomicoController::class, 'update'])->name('editarObjetivo');
Route::get('/objetivoEconomico', [ObjetivoEconomicoController::class, 'index'])->name('objetivoEconomico');
Route::get('objetivo/cambiar-estado/{id}', [ObjetivoEconomicoController::class, 'cambiarEstado'])->name('cambiarEstadoObjetivo');
Route::get('/buscarObjetivos', [ObjetivoEconomicoController::class, 'buscar'])->name('buscarObjetivos');



