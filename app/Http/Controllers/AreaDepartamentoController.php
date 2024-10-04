<?php 

namespace App\Http\Controllers;
use App\Models\AreaDepartamento;
use illuminate\Http\Request;

class AreaDepartamentoController extends Controller 
{
    public function index()
    {
        $area_departamento = AreaDepartamento::all();
        return view('incidencias.create', compact('area_departamento'));
    }
}