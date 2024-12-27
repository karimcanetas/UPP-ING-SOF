<?php

namespace App\Http\Controllers;
use App\Models\Puestos;
use App\Models\EmpleadosCatalogo;
use App\Models\EmpleadosNoRegistrados;
use Illuminate\Http\Request;

class PuestosController extends Controller
{
    public function tuMetodo()
    {
        $puestos = EmpleadosCatalogo::with('id_puesto')->get();
    
        return view('incidencias.create', compact('empleados'));
    }

    public  function recuperar(){
        $empleados22 = EmpleadosNoRegistrados::with('puestos')->get();
        return view('incidencias.create', compact('empleados22'));
    }
}
