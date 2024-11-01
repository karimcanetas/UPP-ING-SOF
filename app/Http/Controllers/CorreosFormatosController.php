<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorreosFormatos;

class CorreosFormatosController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'id_formato' => 'nullable|array',
            'emails' => 'required|array',
        ]);

        // Obtener los formatos y correos seleccionados
        $formatos = $request->input('id_formato');
        $correos = $request->input('id_emails');

        // Guardar cada combinación en la tabla pivote
        foreach ($correos as $correoId) {
            foreach ($formatos as $formatoId) {
                CorreosFormatos::create([
                    'id_correo' => $correoId,
                    'id_formatos' => $formatoId,
                ]);
            }
        }

        return redirect()->route('correos_formatos.store')->with('success', 'Correos y formatos asociados correctamente.');
    }
}
