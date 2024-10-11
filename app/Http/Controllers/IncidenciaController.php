<?php

namespace App\Http\Controllers;

use App\Models\AreaDepartamento;
use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Caseta;
use App\Models\Condicionsalida;
use App\Models\Formato;
use App\Models\Formatocaseta;
use App\Models\Motivovisita;
use App\Models\Turno;
use App\Models\Ubicacionunidad;
use App\Models\Unidad;
use App\Models\Unidadesutilitarias;
use App\Models\Campo;
use App\Models\CampoIncidencia;
use App\Models\EmpleadosCatalogo;
use App\Models\Puestos;

class IncidenciaController extends Controller
{
    // Muestra el formulario para crear una nueva incidencia
    public function create(Request $request)
    {
        $turnos = Turno::all();
        $casetas = Caseta::all();
        $formatos = Formato::all();
        $formato_casetas = Formatocaseta::all();
        $unidad = Unidad::all();
        $area_departamento = AreaDepartamento::all();
        $ubicacion_unidad = Ubicacionunidad::all();
        $unidades_utilitarias = Unidadesutilitarias::all();
        $condicion_salida = Condicionsalida::all();
        $motivo_visita = Motivovisita::all();
        $campos = Campo::all();
        $puetos = Puestos::all();
        $empleados = EmpleadosCatalogo::all();

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

        return view('incidencias.create', compact(
            'casetas',
            'turnos',
            'casetaSeleccionada',
            'formatos',
            'unidad',
            'area_departamento',
            'ubicacion_unidad',
            'unidades_utilitarias',
            'condicion_salida',
            'motivo_visita',
            'campos',
            'empleados'
        ));
    }

    public function store(Request $request)
    {

        //dd($request->all());
        // Validar datos generales del formulario
        $request->validate([
            'id_casetas' => 'required',
            'Detalles' => 'nullable',
            'id_formatos' => 'required',
            'fecha_hora' => 'required',
            'Nombre_vigilante' => 'required',
            'id_turnos' => 'required',
            'lt_gasolina_inicial' => 'nullable',
            'lt_gasolina_final' => 'nullable',
            'folio_Salida_definitiva' => 'nullable',
            'id_unidad' => 'nullable',
            // 'otroUnidad' => 'nullable|string', // 

        ]);

        $formato = $request->input('id_formatos');
        // Determinar qué formulario fue enviado
        $formulario = $request->input('formulario'); // Campo oculto que indica el formulario

        // Procesar dependiendo del formulario
        switch ($formulario) {
            case 'control_unidades':
                // Lógica específica para el formulario de "Control de Unidades"
                // Verificar si el usuario seleccionó "Otro" en el campo de unidad
                // $unidad = $request->input('campos.' . $request->input('campos_unidad'));
                // if ($unidad === 'otro') {
                //     $unidad = $request->input('otroUnidad');
                // }

                // Crear una nueva incidencia con la unidad seleccionada o ingresada
                $incidencia = Incidencia::create($request->all());
                break;

            case 'control_proveedores_TOTs':
                // Lógica específica para el formulario de "Control de Proveedores TOT'S"
                // Aquí puedes añadir la lógica específica para este formulario
                $incidencia = Incidencia::create($request->all());
                break;



            default:
                return redirect()->back()->withErrors(['formulario' => 'Formulario no reconocido.']);
        }

        // Insertar datos en campo_incidencias
        $campos = $request->input('campos', []);
        foreach ($campos as $id_campo => $valor) {
            CampoIncidencia::create([
                'id_incidencias' => $incidencia->id_incidencias,
                'id_campo' => $id_campo,
                'id_formatos' => $request->input('id_formatos'),
                'valor' => $valor
            ]);
        }

        // Redireccionar según el formulario procesado
        return redirect()->route('incidencias.create')->with('success', 'Incidencia creada exitosamente.');
    }
}
