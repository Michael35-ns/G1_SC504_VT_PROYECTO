<?php

use App\Http\Controllers\ResennaController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/resennas/create', [ResennaController::class, 'create'])->name('resennas.create');
Route::post('/resennas', [ResennaController::class, 'store'])->name('resennas.store');

Route::post('/resennas/{id}', [ResennaController::class, 'eliminar'])->name('resennas.eliminar');
Route::get('/resennas/delete/{id}', [ResennaController::class, 'confirmarEliminacion'])->name('resennas.delete');


Route::get('resenas', [ResennaController::class, 'index'])->name('resena');
