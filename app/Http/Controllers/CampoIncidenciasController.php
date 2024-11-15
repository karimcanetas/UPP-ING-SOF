<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Exports\ReporteExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\ReporteMailable;
use App\Models\CampoIncidencia;
use App\Models\Campo;
use App\Models\EmpleadosCatalogo;
use App\Models\EmpleadosFormatos;
use App\Models\Incidencia;
use App\Models\Turno;
use App\Models\User;
use Carbon\Carbon;

class CampoIncidenciasController extends Controller
{
    public function envio(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'formato_id' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $fechaInicio = Carbon::parse($request->input('fecha_inicio'));
        $fechaFin = Carbon::parse($request->input('fecha_fin'));

        // Dividir los correos y formatos en arreglos
        $correos = explode(',', $request->input('email'));
        $formatoIds = explode(',', $request->input('formato_id'));

        if (count($correos) != count($formatoIds)) {
            return response()->json(['error' => 'El número de correos no coincide con el número de formatos.'], 400);
        }

        // genero el excel para cada formato
        foreach ($formatoIds as $key => $formatoId) {
            $formato = Formato::find($formatoId);

            if (!$formato) {
                return response()->json(['error' => 'Formato no encontrado.'], 404);
            }

            $camposIncidencias = $formato->campoIncidencias()
                ->with(['campo', 'incidencia' => function ($query) use ($fechaInicio, $fechaFin) {
                    $query->whereBetween('fecha_hora', [$fechaInicio, $fechaFin]);
                }])
                ->whereHas('incidencia', function ($query) use ($fechaInicio, $fechaFin) {
                    $query->whereBetween('fecha_hora', [$fechaInicio, $fechaFin]);
                })
                ->whereNotNull('valor')
                ->get();


            // Export
            $export = new ReporteExport($formato, $camposIncidencias);
            $filePath = storage_path('app/reporte_vigilancia_' . $formato->id_formatos . '.xlsx');

            // Guardado temporal
            Excel::store($export, 'reporte_vigilancia_' . $formato->id_formatos . '.xlsx');

            // Enviar el correo correspondiente con el archivo adjunto
            $correo = trim($correos[$key]);
            Mail::to($correo)->send(new ReporteMailable($filePath, $formato->Tipo));

            // Eliminar el archivo después de enviarlo
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return response()->json(['success' => 'Correos enviados correctamente.']);
    }

    // public function EnvioVigilante(Request $request)
    // {
    //     $request->validate([
    //         'fecha_hora' => 'required',
    //         'Nombre_vigilante' => 'required',
    //         'id_turnos' => 'required',
    //     ]);

    //     $fechahora = Carbon::parse($request->input('fecha_hora'));
    //     $vigilante = $request->input('Nombre_vigilante');
    //     $turnos = $request->input('id_turnos');

    //     // Obtener el turno 
    //     $turno = Turno::find($turnos);

    //     if (!$turno) {
    //         return response()->json(['error' => 'Turno no encontrado'], 404);
    //     }

    //     $horaInicio = Carbon::parse($turno->Hora_inicio);
    //     $horaFin = Carbon::parse($turno->Hora_fin);

    //     $formatosCoincidentes = Incidencia::where('fecha_hora', '>=', $fechahora)
    //         ->where('Nombre_vigilante', $vigilante)
    //         ->where('id_turnos', $turnos)
    //         ->get();

    //     if ($formatosCoincidentes->isEmpty()) {
    //         return response()->json(['error' => 'No se encontraron formatos para este vigilante'], 404);
    //     }

    //     $empleadosHabilitados = EmpleadosFormatos::where('id_formatos', $formatosCoincidentes->first()->id_formatos)
    //         ->where('status', 1) 
    //         ->get();

    //     if ($empleadosHabilitados->isEmpty()) {
    //         return response()->json(['error' => 'No hay empleados habilitados para enviar el correo'], 404);
    //     }

    //     $correosEmpleados = [];
    //     foreach ($empleadosHabilitados as $empleadoFormato) {
    //         $empleado = EmpleadosCatalogo::find($empleadoFormato->id_empleado);
    //         if ($empleado) {
    //             $nEmpleado = $empleado->n_empleado;
    //             $usuario = User::where('n_empleado', $nEmpleado)->first();
    //             if ($usuario) {
    //                 // Agregamos a la lista de correos
    //                 $correosEmpleados[] = $usuario->email;
    //             }
    //         }
    //     }

    //     if (empty($correosEmpleados)) {
    //         return response()->json(['error' => 'No se encontraron correos electrónicos de empleados habilitados'], 404);
    //     }

    //     $camposIncidencias = $formatosCoincidentes->first()->campoIncidencias()
    //         ->with(['campo', 'incidencia' => function ($query) use ($horaInicio, $horaFin) {
    //             $query->whereBetween('fecha_hora', [$horaInicio, $horaFin]);
    //         }])
    //         ->whereNotNull('valor')
    //         ->get();

    //     // Exportar el reporte
    //     $export = new ReporteExport($formatosCoincidentes, $camposIncidencias);
    //     $filePath = storage_path('app/reporte_vigilancia_' . $formatosCoincidentes->first()->id_formatos . '.xlsx');

    //     // Guardar el archivo de manera temporal
    //     Excel::store($export, 'reporte_vigilancia_' . $formatosCoincidentes->first()->id_formatos . '.xlsx');

    //     // Enviar el correo a los empleados habilitados con el archivo adjunto
    //     foreach ($correosEmpleados as $correo) {
    //         Mail::to($correo)->send(new ReporteMailable($filePath, $formatosCoincidentes->first()->Tipo));
    //     }

    //     // Eliminar el archivo después de enviarlo
    //     if (file_exists($filePath)) {
    //         unlink($filePath);
    //     }

    //     return response()->json(['success' => 'Correo enviado a los administrativos'], 200);
    // }
}
