<?php 

namespace App\Http\Controllers;

use App\Models\Unidadesutilitarias;

class UnidadesutilitariasController extends Controller
{
    public function index()
    {
        $unidades_utilitarias = Unidadesutilitarias::all();
        return view('incidencias.create', compact('unidades_utilitarias'));
    }
}