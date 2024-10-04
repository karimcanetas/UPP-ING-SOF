<?php

namespace App\Http\Controllers;
use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function index()
    {
        // Obtener todos los turnos desde la base de datos
        $unidad = Unidad::all();

        // Pasar los turnos a la vista
        return view('incidencias.create', compact('unidad'));
    }
}
