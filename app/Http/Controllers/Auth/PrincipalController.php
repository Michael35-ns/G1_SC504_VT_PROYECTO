<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrincipalController extends Controller
{
    public function index(): View
    {
        return view('guest.principal');
    }
}
