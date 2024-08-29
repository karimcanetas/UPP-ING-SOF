<?php

namespace App\Http\Controllers;

use App\Models\Formatocaseta;
use Illuminate\Http\Request;

class FormatocasetasController extends Controller
{
    public function show($id_formatocaseta)
    {
        // Encuentra todas las casetas asociadas a la sucursal con el ID proporcionado
        $formato_caseta = Formatocaseta::where('id_formatocaseta', $id_formatocaseta) ->get();

        // Pasar los datos a la vista
        return view('inicidencias/incidencias', [
            'formato_caseta' => $formato_caseta,
            'id_formatocaseta' => $id_formatocaseta
        ]);
    }
}

