<?php

namespace App\Http\Controllers;

use App\Models\Caseta;
use App\Models\Departamentos;
use App\Models\Sucursal;
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
        // Obtener la sucursal por su ID
        $sucursal = Sucursal::find($sucursalId);

        // Comprobar si la sucursal existe
        if (!$sucursal) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        // Obtener los departamentos asociados a la sucursal
        $departamentos = $sucursal->departamentos;

        // Obtener las casetas asociadas a la sucursal
        $casetas = $sucursal->casetas;

        // Obtener los turnos asociados a la sucursal
        $turnos = $sucursal->turnos;

        // Devolver las casetas, departamentos y turnos en una respuesta JSON
        return response()->json([
            'casetas' => $casetas,
            'departamentos' => $departamentos,
            'turnos' => $turnos
        ]);
    }



    public function getFormatos($id_casetas)
    {
        $caseta = Caseta::with('formatos')->findOrFail($id_casetas);
        $formatos = $caseta->formatos; // obtiene todos los formatos asociados a esta caseta


        return response()->json($formatos);
    }
    public function getDepartamentos($sucursalId)
    {

        $sucursal = Sucursal::find($sucursalId);

        if (!$sucursal) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $departamentos = $sucursal->departamentos;
        return response()->json($departamentos);
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
