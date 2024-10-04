<?php 

namespace App\Http\Controllers;

use App\Models\Condicionsalida;

class CondicionsalidaController extends Controller
{
    public function index()
{
    $condicion_salida = Condicionsalida::all();
    return view('incidencias.create,', compact('condicion_salida'));
}
}