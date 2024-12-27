<?php

namespace App\Http\Controllers;

use App\Models\AreaDepartamento;
use Illuminate\Support\Facades\Log;
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
use Carbon\Carbon;
use App\Models\CampoIncidencia;
use App\Models\EmpleadosCatalogo;
use App\Models\Puestos;
use App\Models\TipoAsociado;
use App\Models\EmpleadosNoRegistrados;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

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
        $puestos = Puestos::all();
        $empleados = EmpleadosCatalogo::all();
        $tiposAsociados = TipoAsociado::all();
        $empleadosNoRegistrados = EmpleadosNoRegistrados::all();
        $empleadosNoRegistrados = EmpleadosNoRegistrados::with('puesto')->get();
        $empresas = Empresa::all();


        // Capturar el id_caseta desde la URL
        $id_caseta = $request->query('id_caseta');
        $casetaSeleccionada = null;

        if ($id_caseta) {
            $casetaSeleccionada = Caseta::find($id_caseta);
        }

        if ($casetaSeleccionada) {
            $turnos = $casetaSeleccionada->sucursal->turnos;
            $formatos = $casetaSeleccionada->formatos;
        } else {
            $formatos = collect();
            $turnos = collect();
        }

        $incidencias = Incidencia::with('caseta', 'turnos', 'formatos')->get();

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
            'empleados',
            'puestos',
            'tiposAsociados',
            'empleadosNoRegistrados',
            'incidencias'
        ));
    }

    public function store(Request $request)
    {

        // dd($request->all());
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
            'foto_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_camara' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'otroUnidad' => 'nullable|string', // 

        ]);

        // if ($request->hasFile('foto_upload')) {
        //     $archivo = $request->file('foto_upload');
        //     $rutaFoto = $archivo->store('fotos', 'public'); // Guarda en 'storage/app/public/fotos'
        // } elseif ($request->hasFile('foto_camara')) {
        //     $archivo = $request->file('foto_camara');
        //     $rutaFoto = $archivo->store('fotos', 'public'); // Guarda en 'storage/app/public/fotos'
        // }

        // $incidencia = Incidencia::create(array_merge($request->all(), ['foto_path' => $rutaFoto]));
        // $formato = $request->input('id_formatos');
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


                $incidencia = Incidencia::create($request->all());
                break;

            case 'control_proveedores_TOTs':
                $incidencia = Incidencia::create($request->all());
                break;



            default:
                return redirect()->back()->withErrors(['formulario' => 'Formulario no reconocido.']);
        }

        // insertar datos en campo_incidencias
        $campos = $request->input('campos', []);
        foreach ($campos as $id_campo => $valor) {
            // si el valor es nulo o vacío, asignar "N/A"
            if (is_null($valor) || trim($valor) === '') {
                $valor = 'N/A';
            }



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

    public function obtenerHoraSalida()
    {
        $hoy = Carbon::today();
        $resultados = Incidencia::where('id_formatos', 34)
            ->whereHas('campos', function ($query) {
                $query->whereIn('id_campo', [67, 76, 34])
                    ->where(function ($subQuery) {
                        $subQuery->where(function ($campo34) {
                            $campo34->where('id_campo', 34)
                                ->where(function ($valor) {
                                    $valor->whereNull('valor')
                                        ->orWhere('valor', 'N/A')
                                        ->orWhereRaw("valor NOT REGEXP '^[0-9]{2}:[0-9]{2}$'");
                                });
                        })->orWhereNotIn('id_campo', [34]);
                    });
            })
            ->whereDate('fecha_hora', '=', $hoy)
            ->with(['campoIncidencias' => function ($query) {
                $query->select('id_incidencias', 'id_campo', 'valor');
            }])
            ->get()
            ->map(function (Incidencia $incidencia) {
                $HoraSalida34 = $incidencia->campoIncidencias
                    ->where('id_campo', 34)
                    ->first()?->valor;

                if ($HoraSalida34 !== null && $HoraSalida34 !== 'N/A') {
                    return null;
                }

                $empleados67 = $incidencia->campoIncidencias
                    ->where('id_campo', 67)
                    ->first()?->valor ?? null;

                $empleados76 = $incidencia->campoIncidencias
                    ->where('id_campo', 76)
                    ->first()?->valor ?? null;

                $empleados = [
                    'empleado_67' => $empleados67,
                    'empleado_76' => $empleados76,
                ];

                return [
                    'id_incidencias' => $incidencia->id_incidencias,
                    'id_formatos' => $incidencia->id_formatos,
                    'fecha_hora' => $incidencia->fecha_hora,
                    'valor_campo_34' => $HoraSalida34,
                    'empleados' => $empleados,
                ];
            })
            ->filter();

        return response()->json($resultados);
    }

    public function ActualizarSalida(Request $request)
    {
        $validated = $request->validate([
            'id_incidencias' => 'required|exists:mysql_2.campo_incidencias,id_incidencias',
            'HoraSalida' => 'required|date_format:H:i',
        ]);
    
        $id_incidencias = $request->input('id_incidencias');
        $HoraSalida = $request->input('HoraSalida');
    
        $campoIncidencia = DB::connection('mysql_2')->table('campo_incidencias')
            ->where('id_incidencias', $id_incidencias)
            ->where('id_campo', 34)
            ->first();
    
        if ($campoIncidencia) {
            DB::connection('mysql_2')->table('campo_incidencias')
                ->where('id_incidencias', $id_incidencias)
                ->where('id_campo', 34)
                ->update(['valor' => $HoraSalida]);
    
            return response()->json(['success' => 'Hora de salida actualizada exitosamente.']);
        } else {
            return response()->json(['error' => 'No se encontró el registro en campo_incidencias.'], 404);
        }
    }
    
}
