<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function index()
    {
        $defaultUser = 8;
        $preuspuestosFound = Presupuesto::readByUserId($defaultUser);
        // Presupuesto::findMany([1, 5, 6, 7])
        return view('presupuesto.index', ['presupuestos' => $preuspuestosFound ]);
    }

    public function show(string $id)
    {
        return view("presupuesto.show", ["presupuestoId" => $id]);
    }
}
