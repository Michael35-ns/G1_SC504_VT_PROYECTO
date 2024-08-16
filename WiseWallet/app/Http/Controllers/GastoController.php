<?php

namespace App\Http\Controllers;

use App\Models\FideGastosTb;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GastoController extends Controller
{

    public function index(){
        $gastosTabla = FideGastosTb::getGastosByUsuario(2);
        return view('Gasto', compact('gastosTabla'));
    }


    public function show()
    {
        return view('Gasto');
    }

}