<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GastoController extends Controller
{

    public function index(){
        return view('crearGasto');
    }


    public function show()
    {
        return view('crearGasto');
    }

}