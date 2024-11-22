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
            ->where('Nombre_vigilante', $nombreVigilante)
            ->where('id_turnos', $idTurnos)
            ->get();

        Log::info('Consultando formatos con los parámetros:', [
            'fecha_hora_inicio' => $fechaHoraInicio,
            'fecha_hora_fin' => $fechaHoraFin,
            'nombre_vigilante' => $nombreVigilante,
            'id_turnos' => $idTurnos,
            'consulta_resultado' => $formatosCoincidentes->isEmpty() ? 'No se encontraron formatos' : 'Formatos encontrados'
        ]);

        if ($formatosCoincidentes->isEmpty()) {
            return response()->json(['error' => 'no se encontraron formatos'], 404);
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
            foreach ($correosEmpleados as $correo) {
                Mail::to($correo)->send(new ReporteMailable($filePath, $tipoFormato));
            }

            // elimino el archivo después de enviarlo
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        Log::info('cantidad de archivos excel generados: ' . $archivosGenerados);

        return response()->json(['success' => 'Haz enviado tus formatos con exito', 'archivos generados' => $archivosGenerados], 200);
    }
}
