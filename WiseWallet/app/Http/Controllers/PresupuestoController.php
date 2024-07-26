<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function index()
    {
        return view('presupuesto.index', ['presupuestos' => Presupuesto::findMany([1, 5, 6, 7])]);
    }

    public function show(string $id)
    {
        return view("presupuesto.show", ["presupuestoId" => $id]);
    }
}
