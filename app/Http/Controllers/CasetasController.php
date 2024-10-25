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

    public function showFormatos($id_casetas)
    {
        $casetas = Caseta::findOrFail($id_casetas);
        $formatos = $casetas->formatos; // Obtiene todos los formatos asociados a esta caseta

        return view('incidencias.create', compact('casetas', 'formatos'));
    }
    public function getCasetas($sucursalId)
    {
        // Encuentra todas las casetas asociadas a la sucursal con el ID proporcionado
        $casetas = Caseta::where('id_sucursal', $sucursalId)->get();

        // Devuelve los datos en formato JSON para AJAX
        return response()->json($casetas);
    }

    public function getFormatos($id_casetas)
    {
        $caseta = Caseta::with('formatos')->findOrFail($id_casetas);
        $formatos = $caseta->formatos; // Obtiene todos los formatos asociados a esta caseta

        // Devuelve los datos en formato JSON para AJAX
        return response()->json($formatos);
    }
}



// namespace App\Http\Controllers;

// use App\Models\Caseta;
// use Illuminate\Http\Request;

// class CasetasController extends Controller
// {
//     public function getCasetas($sucursalId)
//     {
//         // Encuentra todas las casetas asociadas a la sucursal con el ID proporcionado
//         $casetas = Caseta::where('id_sucursal', $sucursalId)->get();

//         // Devuelve los datos en formato JSON para AJAX
//         return response()->json($casetas);
//     }

//     public function getFormatos($id_casetas)
//     {
//         $caseta = Caseta::with('formatos')->findOrFail($id_casetas);
//         $formatos = $caseta->formatos; // Obtiene todos los formatos asociados a esta caseta

//         // Devuelve los datos en formato JSON para AJAX
//         return response()->json($formatos);
//     }
// }
