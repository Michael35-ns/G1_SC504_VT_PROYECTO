<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $roles = DB::table('FIDE_ROL_TB')->get();
    return view('welcome', ['roles' => $roles]);
});
