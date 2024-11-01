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
    public function exportar(Request $request)
    {

        $request->validate([
            'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
        ]);

        // mysql_2
        $formato = Formato::with(['campoIncidencias.campo'])
            ->find($request->formato_id);


        if (!$formato) {
            return response()->json(['error' => 'Formato no encontrado'], 404);
        }

        return Excel::download(new ReporteExport($formato), 'reporte_vigilancia.xlsx');
    }
    public function envio(Request $request)
    {
        // Validar el campo oculto
        $request->validate([
            'correosSeleccionados' => 'required',
            'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
            // 'fecha_inicio' => 'required|date',
            // 'fecha_fin' => 'required|date',
        ]);

        // dividir los correos si es necesario
        $correos = explode(',', $request->input('correosSeleccionados'));

        // generar el excel
        $formato = Formato::with(['campoIncidencias.campo'])->find($request->formato_id);
        // $fechaInicio = Carbon::parse($request->fecha_inicio);
        // $fechaFin = Carbon::parse($request->fecha_fin);

        // $campos = $formato->campoIncidencias->filter(function($campoIncidencia) use ($fechaInicio, $fechaFin) {
        //     return $campoIncidencia->incidencia && 
        //     Carbon::parse($campoIncidencia->incidencias->fecha_hora)->between($fechaInicio, $fechaFin);
        // });
        
        $export = new ReporteExport($formato);
        $filePath = storage_path('app/reporte_vigilancia.xlsx');

        // guardado temporal
        Excel::store($export, 'reporte_vigilancia.xlsx');

        // enviar a todos los correos
        foreach ($correos as $correo) {
            Mail::to(trim($correo))->send(new ReporteMailable($filePath, $formato->Tipo));
        }

        // eliminar el archivo temporal
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json(['success' => 'Correos enviados correctamente.']);
    }
}
