<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetivoEconomicoController;
use App\Http\Controllers\PresupuestoController;

Route::get('/crear-objetivo', [ObjetivoEconomicoController::class, 'create'])->name('crearObjetivoEconomico');
Route::post('/agregar-objetivo', [ObjetivoEconomicoController::class, 'agregarObjetivo']);
Route::get('/objetivoEconomico', [ObjetivoEconomicoController::class, 'index'])->name('objetivoEconomico');
Route::resource('presupuestos', PresupuestoController::class)->only(['index', 'show']);
