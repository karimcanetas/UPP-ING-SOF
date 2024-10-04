<?php

namespace App\Http\Controllers;

use App\Models\Ubicacionunidad;

class UbicacionunidadController extends Controller
{
    public function index()
    {
        $ubicacion_unidad = Ubicacionunidad::all();
        return view('inicidencias.create', compact('ubicacion_unidad'));
    }
}
