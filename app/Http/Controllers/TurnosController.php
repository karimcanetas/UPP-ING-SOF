<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;

class TurnosController extends Controller
{
    public function index()
    {
        // Obtener todos los turnos desde la base de datos
        $turnos = Turno::all();

        // Pasar los turnos a la vista
        return view('incidencias.create', compact('turnos'));
    }
}
