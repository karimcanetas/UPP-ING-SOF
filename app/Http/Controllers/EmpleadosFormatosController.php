<?php

namespace App\Http\Controllers;

use App\Models\EmpleadosCatalogo;
use App\Models\EmpleadosFormatos;
use Illuminate\Http\Request;

class EmpleadosFormatosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_formato' => 'nullable|array',
            'id_empleado' => 'nullable|array',
        ]);

        $formatos = $request->input('id_formato');
        $empleados = $request->input('id_empleado');

        if ($formatos && $empleados) {
            foreach ($empleados as $empleadoId) {
                foreach ($formatos as $formatoId) {
                    // revisa si existe la relacion
                    $exists = EmpleadosFormatos::where('id_formatos', $formatoId)
                        ->where('id_empleado', $empleadoId)
                        ->exists();

                    if ($exists) {
                        // si existe manda mensaje de que existe
                        return back()->with('error', 'La relación entre el empleado y el formato ya existe.');
                    }

                    // si no existe se crea
                    EmpleadosFormatos::create([
                        'id_formatos' => $formatoId,
                        'id_empleado' => $empleadoId,
                    ]);
                }
            }

            return redirect()->route('EmpleadoFormato.index')->with('success', 'Empleados y formatos asociados correctamente.');
        }

        return back()->with('error', 'Debe seleccionar al menos un empleado y un formato.');
    }
}
