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
                    EmpleadosFormatos::create([
                        'id_formatos' => $formatoId,
                        'id_empleado' => $empleadoId,
                    ]);
                }
            }

            return redirect()->route('empleados_formatos.store')->with('success', 'Empleados y formatos asociados correctamente.');
        }

        return back()->with('error', 'Debe seleccionar al menos un empleado y un formato.');
    }

}
