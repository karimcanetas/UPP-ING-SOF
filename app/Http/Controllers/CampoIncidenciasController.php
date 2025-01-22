<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Exports\ReporteExport;
use App\Exports\VigilanteExport;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
        $formatoIds = explode(',', $request->input('formato_id'));

        $formatoEspecialIds = [39, 32, 2, 3, 4, 5, 6, 8, 9, 10, 11, 36, 43, 22, 38, 47];
        $archivosGenerados = 0;
        $errorFormatos = [];

        foreach ($formatoIds as $formatoId) {
            $formato = Formato::find($formatoId);

            if (!$formato) {
                continue; // Ssi el formato no existe sigue
            }

            if (in_array($formatoId, $formatoEspecialIds)) {

                //formateo la fecha que ingreso el usuario al formato año /mes / dia
                $fechaInicioformateada = $fechaInicio->format('Y-m-d');
                $fechafinformateada = $fechaFin->format('Y-m-d');
                $idIncidencias = collect();
                $fechaActual = Carbon::parse($fechaInicioformateada);

                while ($fechaActual->format('Y-m-d') <= $fechafinformateada) {
                    $fechaFormateada = $fechaActual->format('Y-m-d');

                    // realizo la consulta con like para buscar fechas ya que la columna valor es tipo texto
                    $resultados = CampoIncidencia::on('mysql_2')
                        //cuando el formato sean $formatoIds y esten dentro de formatoEspecialIds
                        ->whereIn('id_formatos', $formatoIds)
                        ->whereIn('id_formatos', $formatoEspecialIds)
                        ->where('id_campo', 13)
                        ->where('valor', 'LIKE', "%$fechaFormateada%")
                        ->pluck('id_incidencias');

                    $idIncidencias = $idIncidencias->merge($resultados);
                    $fechaActual->addDay();

                    // obtengo los campos de incidencia por formato
                    $camposIncidencias = CampoIncidencia::on('mysql_2')
                        ->whereIn('id_incidencias', $idIncidencias)
                        ->where('id_formatos', $formatoId)
                        ->with('incidencia')
                        ->get();
                }
            } else {
                $camposIncidencias = $formato->campoIncidencias()
                    ->with(['campo', 'incidencia' => function ($query) use ($fechaInicio, $fechaFin) {
                        $query->whereBetween('fecha_hora', [$fechaInicio, $fechaFin]);
                    }])
                    ->whereHas('incidencia', function ($query) use ($fechaInicio, $fechaFin) {
                        $query->whereBetween('fecha_hora', [$fechaInicio, $fechaFin]);
                    })
                    ->whereNotNull('valor')
                    ->get();
            }

            if ($camposIncidencias->isEmpty()) {
                $errorFormatos[] = $formato->Tipo;
                continue; // si no hay incidencias se omite el formato
            }

            $empleadosHabilitados = EmpleadosFormatos::where('id_formatos', $formatoId)
                ->where('status', 1)
                ->get();

            if ($empleadosHabilitados->isEmpty()) {
                continue; // si no hay emplados habilitados omite el formato
            }

            $correosEmpleados = $empleadosHabilitados->map(function ($empleadoFormato) {
                $empleado = EmpleadosCatalogo::find($empleadoFormato->id_empleado);
                if ($empleado) {
                    $usuario = User::where('n_empleado', $empleado->n_empleado)->first();
                    return $usuario ? $usuario->email : null;
                }
                return null;
            })->filter()->toArray();

            if (empty($correosEmpleados)) {
                continue; // si no hay correos omite el formato
            }

            $tipoFormato = $formato->Tipo ?? 'formato desconocido';

            // Generar el archivo Excel.
            $export = new ReporteExport($formato, $camposIncidencias);
            $fileName = 'reporte_vigilancia_' . $formatoId . '.xlsx';
            $filePath = storage_path('app/' . $fileName);

            Excel::store($export, $fileName);

            $archivosGenerados++;

            // envio el archivo a los correos habilitados
            Mail::to($correosEmpleados)
                ->send(new ReporteMailable($filePath, $tipoFormato));

            // Eliminar el archivo después de enviarlo.
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        if ($archivosGenerados === 0 && !empty($errorFormatos)) {
            return redirect()->route('send.index')
                ->with('error', 'No se pudieron enviar los formatos: ' . implode(', ', $errorFormatos) . ' porque no cuentan con datos.');
        }

        return redirect()->route('send.index')->with('success', 'Correos enviados exitosamente.');
    }

    public function EnvioVigilante(Request $request)
    {
        $request->validate([
            'fecha_hora' => 'required',
            'Nombre_vigilante' => 'required',
            'id_turnos' => 'required|integer',
        ]);

        $nombreVigilante = $request->input('Nombre_vigilante');
        $fechaHora = $request->input('fecha_hora');
        $idTurnos = (int) $request->input('id_turnos');

        $turno = Turno::find($idTurnos);
        if (!$turno || empty($turno->Hora_Fin)) {
            return response()->json(['error' => 'Turno o Hora_Fin no válido'], 400);
        }

        $fechaHoraInicio = Carbon::parse($fechaHora);
        $fechaHoraFin = $fechaHoraInicio->copy()->setTimeFromTimeString($turno->Hora_Fin);

        //agrego un dia adicional cuando el turno es nocturno
        if ($turno->id_turnos == 2 || $turno->turnos = "Nocturno") {
            $fechaHoraFin->addDay();
        }

        // obtengo las incidencias
        $formatosCoincidentes = Incidencia::whereBetween('fecha_hora', [$fechaHoraInicio, $fechaHoraFin])
            // ->where('Nombre_vigilante', $nombreVigilante)
            ->where('id_turnos', $idTurnos)
            ->get();

        $fechaActual = Carbon::now()->startOfDay();
        $findemes = Carbon::now()->endOfMonth()->startOfDay();

        $formatosCoincidentes = $formatosCoincidentes->filter(function ($incidencia) use ($findemes, $fechaActual) {
            $idFormatos = $incidencia->id_formatos;

            if (!$fechaActual->eq($findemes) && in_array($idFormatos, [27, 29, 43])) {
                return false;
            }

            return true;
        });

        if ($fechaActual->eq($findemes)) {
            $formatosCoincidentes = $formatosCoincidentes->merge(
                Incidencia::whereIn('id_formatos', [27, 29, 43])
                    ->whereBetween('fecha_hora', [
                        $fechaActual->startOfMonth(),
                        $findemes
                    ])
                    ->get()
            );
        }
        // actualizar el campo enviado 1 es enviado
        $formatosCoincidentes->each(function ($incidencia) {
            $incidencia->enviado = 1;
            $incidencia->save();
        });

        Log::info('Consultando formatos con los parámetros:', [
            'fecha_hora_inicio' => $fechaHoraInicio,
            'fecha_hora_fin' => $fechaHoraFin,
            'nombre_vigilante' => $nombreVigilante,
            'id_turnos' => $idTurnos,
            'consulta_resultado' => $formatosCoincidentes->isEmpty() ? 'No se encontraron formatos' : 'Formatos encontrados'
        ]);

        if ($formatosCoincidentes->isEmpty()) {
            return redirect()->route('incidencias.create')->with('EnvioCorreoVigilante', 'Envia al menos un registro de algún formato');
        }

        // agrupo las incidencias por el id_formatos
        $formatosAgrupados = $formatosCoincidentes->groupBy('id_formatos');
        $archivosGenerados = 0; // test

        foreach ($formatosAgrupados as $idFormato => $formatos) {
            $formatoEjemplo = $formatos->first(); // el formato que representara por agrupacion
            $camposIncidencias = collect();

            // relaciono los campos con su formato
            foreach ($formatos as $formato) {
                $camposFormato = $formato->campoIncidencias()
                    ->with(['campo', 'incidencia' => function ($query) use ($fechaHoraInicio, $fechaHoraFin) {
                        $query->whereBetween('fecha_hora', [$fechaHoraInicio, $fechaHoraFin]);
                    }])
                    ->whereNotNull('valor')
                    ->get();

                $camposIncidencias = $camposIncidencias->merge($camposFormato);
            }

            if ($camposIncidencias->isEmpty()) {
                continue; // no hay campos para este formato
            }

            // test agrupacion
            $detalleCampos = $camposIncidencias->map(function ($incidencia) {
                return [
                    'campo' => $incidencia->campo->campo ?? 'deconocido',
                    'valor' => $incidencia->valor ?? 'sin valor',
                ];
            })->toArray();

            Log::info('procesando formato agrupado:', [
                'id_formato' => $idFormato,
                'tipo_formato' => $formatoEjemplo->Tipo ?? 'Desconocido',
                'campos_incidencias' => $detalleCampos,
            ]);

            $empleadosHabilitados = EmpleadosFormatos::where('id_formatos', $idFormato)
                ->where('status', 1)
                ->get();

            if ($empleadosHabilitados->isEmpty()) {
                continue; // no hay empleados habilitados
            }

            $correosEmpleados = $empleadosHabilitados->map(function ($empleadoFormato) {
                $empleado = EmpleadosCatalogo::find($empleadoFormato->id_empleado);
                if ($empleado) {
                    $usuario = User::where('n_empleado', $empleado->n_empleado)->first();
                    return $usuario ? $usuario->email : null;
                }
                return null;
            })->filter()->toArray();

            if (empty($correosEmpleados)) {
                continue; // no hay correos habilitados
            }

            $tipoFormato = $formatoEjemplo->formato->Tipo ?? 'formato desconocido';

            // genero el excel 
            $export = new VigilanteExport(collect([$formatoEjemplo]), $camposIncidencias, $tipoFormato);
            $fileName = 'reporte_vigilancia_' . $idFormato . '.xlsx';
            $filePath = storage_path('app/' . $fileName);

            Excel::store($export, $fileName);

            // test
            $archivosGenerados++;

            // envio el excel a los correos habilitados

            Mail::to($correosEmpleados)
                ->send(new ReporteMailable($filePath, $tipoFormato));

            // foreach ($correosEmpleados as $correo) {
            //     Mail::to($correo)->send(new ReporteMailable($filePath, $tipoFormato));
            // }


            // correos ocultos 
            // envio el archivo a los correos habilitados
            // Mail::bcc($correosEmpleados)
            //     ->send(new ReporteMailable($filePath, $tipoFormato));

            // elimino el archivo después de enviarlo
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Log::info('cantidad de archivos excel generados: ' . $archivosGenerados);

        return redirect()->route('incidencias.create')->with('successCorreos', 'Enviaste los correos exitosamente.');
    }
}
