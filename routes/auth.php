<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PrincipalController;


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/agregarUsuario', [RegisterController::class, 'store'])->name('agregarUsuario');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/Principal', [PrincipalController::class, 'index'])->name('Principal');
