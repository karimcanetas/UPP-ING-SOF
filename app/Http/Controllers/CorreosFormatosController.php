<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorreosFormatos;

class CorreosFormatosController extends Controller
{
    // public function store(Request $request)
    // {
    //     //dd($request->all());
    //     $request->validate([
    //         'id_formato' => 'nullable|array',
    //         'id_empleado' => 'required|array',
    //     ]);

    //     // Obtener los formatos y correos seleccionados
    //     $formatos = $request->input('id_formato');
    //     $empleados = $request->input('id_empleado');

    //     // Guardar cada combinación en la tabla pivote
    //     foreach ($empleados as $empleadoId) {
    //         foreach ($formatos as $formatoId) {
    //             CorreosFormatos::create([
    //                 'empleados' => $empleadoId,
    //                 'id_formatos' => $formatoId,
    //             ]);
    //         }
    //     }

    //     return redirect()->route('correos_formatos.store')->with('success', 'Correos y formatos asociados correctamente.');
    // }
}


