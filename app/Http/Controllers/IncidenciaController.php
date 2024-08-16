<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Caseta;
use App\Models\Formato;
use App\Models\Turno;


class IncidenciaController extends Controller
{
    // Muestra el formulario para crear una nueva incidencia
    public function create(Request $request)
    {
        $turnos = Turno::all();
        $casetas = Caseta::all();
        $formatos = Formato::all();
    
        // Capturar el id_caseta desde la URL
        $id_caseta = $request->query('id_caseta');
        $casetaSeleccionada = null;
    
        if ($id_caseta) {
            $casetaSeleccionada = Caseta::find($id_caseta);
        }
    
        return view('incidencias.create', compact('casetas', 'turnos', 'casetaSeleccionada', 'formatos'));
    }
    // Guarda la nueva incidencia en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_casetas' => 'required|integer',
            'Detalles' => 'required|string',
            'id_formatos' => 'required|integer',
            'fecha_hora' => 'required|date',
            'guardia' => 'required|string',
            'Nombre_vigilante' => 'required|string',
            'id_turnos' => 'required|integer',
        ]);


        // Crear una nueva incidencia
        Incidencia::create($request->all());
        

        // Redirigir a una página de éxito o regresar al formulario con un mensaje
        return redirect()->route('incidencias.create')->with('success', 'Incidencia creada exitosamente.');
    }
}