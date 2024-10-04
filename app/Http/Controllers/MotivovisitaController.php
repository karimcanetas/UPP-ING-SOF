<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motivovisita;

class MotivovisitaController extends Controller
{
    public function index() {
    $motivo_salida = Motivovisita::all();
    return view('incidencias.create', compact('motivo_salida'));
    }
}
