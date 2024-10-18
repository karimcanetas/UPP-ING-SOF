<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Puestos;
// use App\Models\TipoAsociado;
// use App\Models\EmpleadosNoRegistrados;
// use App\Models\Caseta;

// class EmpleadosNoRegistradosController extends Controller
// {
//     public function create(Request $request)
//     {
//         $tiposAsociados = TipoAsociado::on('mysql')->get();
//         $puestos = Puestos::on('mysql')->get();
//         $casetaSeleccionada = Caseta::first();
        
//         return view('incidencias.create', compact('puestos', 'tiposAsociados'));
//     }

//     public function store(Request $request)
//     {
//         //dd($request->all());
//         $request->validate([
//             'nombres' => 'required',
//             'puesto' => 'required',
//             'tipo_asociado' => 'required',
//             'apellido_p' => 'nullable',
//             'apellido_m' => 'nullable'
//         ]);


//         $empleado = new EmpleadosNoRegistrados();
//         $empleado->setConnection('mysql_2');
//         $empleado->nombres = strtoupper($request->nombres);
//         $empleado->puesto = $request->puesto;
//         $empleado->tipo_asociado = $request->tipo_asociado;
//         $empleado->apellido_p = strtoupper($request->apellido_p);
//         $empleado->apellido_m = strtoupper($request->apellido_m);


//         $empleado->save();

//         return redirect()->route('incidencias.create')->with('empleado_success', 'Empleado agregado exitosamente.');
//     }
// }
