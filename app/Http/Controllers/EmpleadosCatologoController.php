<?php

namespace App\Http\Controllers;

use App\Models\EmpleadosNoRegistrados;
use Illuminate\Http\Request;
use App\Models\Puestos;
use App\Models\TipoAsociado;

class EmpleadosCatologoController extends Controller
{
    public function create()
    {
        $puestos = Puestos::all();
        $tiposAsociados = TipoAsociado::on('mysql')->get(); //obtengo el los datos de la concentradora
        $puestos = Puestos::on('mysql')->get();

        return view('incidencias.create', compact('tiposAsociados', 'puestos', 'empleados'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombres' => 'required|string|max:255',
            'id_puesto' => 'required',
            // 'id_tipo_asociado' => 'required',
            'apellido_p' => 'nullable|string|max:255',
            'apellido_m' => 'nullable|string|max:255',
        ]);


        $empleado = new EmpleadosNoRegistrados();
        $empleado->setConnection('mysql_2');  // Cambia la conexión a 'mysql_2'
        $empleado->nombres = strtoupper($request->nombres);
        $empleado->id_puesto = $request->id_puesto;
        // $empleado->id_tipo_asociado = $request->id_tipo_asociado;
        $empleado->apellido_p = strtoupper($request->apellido_p);
        $empleado->apellido_m = strtoupper($request->apellido_m);


        $empleado->save();

        $puesto = Puestos::find($empleado->id_puesto);
        return response()->json([
            'id_empleado' => $empleado->id_empleado,
            'nombres' => $empleado->nombres,
            'id_puesto' => $empleado->id_puesto,
            'puestoNombre' => $puesto ? $puesto->nombre : '',
            'message' => 'Empleado agregado exitosamente.',
        ]);
        // return redirect()->route('incidencias.create')->with('empleado_success', 'Empleado agregado exitosamente.');
    }
}
