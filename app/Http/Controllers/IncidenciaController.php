<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Caseta;
use App\Models\Formato;
use App\Models\Formatocaseta;
use App\Models\Turno;
use Carbon\Carbon;


class IncidenciaController extends Controller
{
    // Muestra el formulario para crear una nueva incidencia
    public function create(Request $request)
    {
        $turnos = Turno::all();
        $casetas = Caseta::all();
        $formatos = Formato::all();
        $formato_casetas = Formatocaseta::all();
            

        // Capturar el id_caseta desde la URL
        $id_caseta = $request->query('id_caseta');
        $casetaSeleccionada = null;

        if ($id_caseta) {
            $casetaSeleccionada = Caseta::find($id_caseta);
        }

        if ($casetaSeleccionada) { 
            $formatos = $casetaSeleccionada->formatos;
        } else {
            $formatos = collect();
        } 

        return view('incidencias.create', compact('casetas', 'turnos', 'casetaSeleccionada', 'formatos'));
    }
    // Guarda la nueva incidencia en la base de datos
    public function store(Request $request)
    {

        //dd($request->all());

        // Validar los datos del formulario
        $request->validate([
            'id_casetas' => 'required',
            'Detalles' => 'required',
            'id_formatos' => 'required',
            'fecha_hora' => 'required',
            'guardia' => 'required',
            'Nombre_vigilante' => 'required',
            'id_turnos' => 'required',
            'lt_gasolina_inicial' => 'nullable',
            'lt_gasolina_final' => 'nullable',
        ]);


        // Crear una nueva incidencia
        Incidencia::create($request->all());


        // Redirigir a una página de éxito o regresar al formulario con un mensaje
        return redirect()->route('incidencias.create')->with('success', 'Incidencia creada exitosamente.');
    }
}
