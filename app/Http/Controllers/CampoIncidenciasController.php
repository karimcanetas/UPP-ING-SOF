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
use Carbon\Carbon;

class CampoIncidenciasController extends Controller
{
    // public function exportar(Request $request)
    // {

    //     $request->validate([
    //         'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
    //     ]);

    //     // mysql_2
    //     $formato = Formato::with(['campoIncidencias.campo'])
    //         ->find($request->formato_id);


    //     if (!$formato) {
    //         return response()->json(['error' => 'Formato no encontrado'], 404);
    //     }

    //     return Excel::download(new ReporteExport($formato), 'reporte_vigilancia.xlsx');
    // }
    public function envio(Request $request)
    {
        $request->validate([
            'correosSeleccionados' => 'required',
            'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $fechaInicio = Carbon::parse($request->input('fecha_inicio'));
        $fechaFin = Carbon::parse($request->input('fecha_fin'));

        // Dividir los correos si es necesario
        $correos = explode(',', $request->input('correosSeleccionados'));

        // Generar el Excel
        $formato = Formato::find($request->formato_id);

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

        $export = new ReporteExport($formato, $camposIncidencias);
        $filePath = storage_path('app/reporte_vigilancia.xlsx');

        // Guardado temporal
        Excel::store($export, 'reporte_vigilancia.xlsx');

        foreach ($correos as $correo) {
            Mail::to(trim($correo))->send(new ReporteMailable($filePath, $formato->Tipo));
        }

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json(['success' => 'Correos enviados correctamente.']);
    }
}



// public function envio(Request $request)
//     {
//         // Validar el campo oculto
//         $request->validate([
//             'correosSeleccionados' => 'required',
//             'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
//             'fecha_inicio' => 'required|date',
//             'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
//         ]);

//         // Dividir los correos si es necesario
//         $correos = explode(',', $request->input('correosSeleccionados'));

//         // Obtener el formato con los campos relacionados
//         $formato = Formato::with(['campoIncidencias.campo'])->find($request->formato_id);

//         // Filtrar los campos de incidencia según el rango de fechas
//         $campoIncidenciasFiltrados = $formato->campoIncidencias->filter(function ($campoIncidencia) use ($request) {
//             return $campoIncidencia->incidencia &&
//                 $campoIncidencia->incidencia->fecha_hora >= $request->fecha_inicio &&
//                 $campoIncidencia->incidencia->fecha_hora <= $request->fecha_fin;
//         });

//         // Verificar si se encontraron campos filtrados
//         if ($campoIncidenciasFiltrados->isEmpty()) {
//             return response()->json(['error' => 'No se encontraron incidencias en el rango de fechas especificado.'], 404);
//         }

//         // Generar el Excel con los campos filtrados
//         $export = new ReporteExport($campoIncidenciasFiltrados, $formato);
//         $filePath = storage_path('app/reporte_vigilancia.xlsx');

//         // Guardado temporal
//         Excel::store($export, 'reporte_vigilancia.xlsx');

//         // Enviar a todos los correos
//         foreach ($correos as $correo) {
//             Mail::to(trim($correo))->send(new ReporteMailable($filePath, $formato->Tipo));
//         }

//         // Eliminar el archivo temporal
//         if (file_exists($filePath)) {
//             unlink($filePath);
//         }

//         return response()->json(['success' => 'Correos enviados correctamente.']);
//     }
