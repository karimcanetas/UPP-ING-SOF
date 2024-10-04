<?php

namespace App\Http\Controllers;

use App\Models\EmpleadosCatalogo;
use Illuminate\Http\Request;
use App\Models\Puestos;

class EmpleadosCatologoController extends Controller
{
    public function index()
    {
        // Obtener todos los puestos
        $puestos = Puestos::all();
        $empleados = EmpleadosCatalogo::with('puesto')->get();

        // Pasar los empleados a la vista
        return view('incidencias.create', compact('empleados'));
    }
}
