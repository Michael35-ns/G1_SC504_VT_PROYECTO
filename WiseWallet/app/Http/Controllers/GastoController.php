<?php

namespace App\Http\Controllers;

use App\Models\FideGastosTb;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GastoController extends Controller
{

    public function index(){
        $gastosTabla = FideGastosTb::SP_ALL_BY_ID(2);
        return view('crearGasto', compact('gastosTabla'));
    }


    public function show()
    {
        return view('crearGasto');
    }

}