<?php

namespace App\Http\Controllers;

use App\Models\Caseta;
use Illuminate\Http\Request;

class CasetasController extends Controller
{
    public function show($sucursalId)
    {
        // Encuentra todas las casetas asociadas a la sucursal con el ID proporcionado
        $casetas = Caseta::where('id_sucursal', $sucursalId)->get();

        // Pasar los datos a la vista
        return view('casetas/casetas', [
            'casetas' => $casetas,
            'id_sucursal' => $sucursalId
        ]);
    }
}

