<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;

class FormatosController extends Controller
{
    public function index()
    {
        // Obtener todos los formatos desde la base de datos
        $formatos = Formato::all();

        // Pasar los turnos a la vista
        return view('incidencias.create', compact('formatos'));
    }
}
