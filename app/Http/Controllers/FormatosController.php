<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Models\Formato;
use App\Models\CorreosFormatos;
use App\Models\Formatocaseta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormatosController extends Controller
{

    public function index()
    {
        $formatos = Formato::all();
        $correosConFormatos = CorreosFormatos::with(['correo', 'formato'])->get();
        // $formatoCasetas = Formatocaseta::with('Caseta', 'Fotmato')->get();

        return view('incidencias.create', compact('formatos', 'correosConFormatos'));
    }

    public function checksSeparadores()
    {
        $FormatoCasetas = Formatocaseta::with([
            'Caseta',
            'Formato',
            'Formato.EmpleadosFormatos.Empleado.user',
            'Caseta.empresa',
            'Caseta.sucursal'
        ])->get();

        // agrupo por caseta y mapea el contenido
        $groupedByCaseta = $FormatoCasetas->groupBy(function ($item) {
            return $item->Caseta->nombre;
        })->map(function ($items) {
            return $items->map(function ($item) {
                $empleados = $item->Formato->EmpleadosFormatos->filter(function ($pivot) {
                    return $pivot->status == 1;
                })->map(function ($pivot) {
                    $empleado = $pivot->Empleado;

                    if ($empleado && $empleado->user && $empleado->user->email) {
                        return [
                            'nombre' => $empleado->nombres,
                            'email' => $empleado->user->email,
                        ];
                    }
                    return null;
                })->filter(); // elimino empleados nulos

                return [
                    'id_formatos' => $item->id_formatos,
                    'Tipo' => $item->Formato->Tipo,
                    'nombre_caseta' => $item->Caseta->nombre,
                    'empresa' => $item->Caseta->sucursal->empresa->alias ?? 'Sin empresa',
                    'sucursal' => $item->Caseta->sucursal->nombre ?? 'Sin sucursal',
                    'empleados' => $empleados,
                ];
            });
        });

        Log::info('FormatoCasetas agrupadas por caseta:', $groupedByCaseta->toArray());

        return response()->json(['groupedByCaseta' => $groupedByCaseta]);
    }


    public function show($id)
    {
        $formato = Formato::with('correos')->findOrFail($id);

        // Verificar si el formato existe
        if (!$formato) {
            return redirect()->back()->with('error', 'Formato no encontrado.');
        }

        return view('dashboard', compact('formato'));
    }

    public function getCorreos($id)
    {

        $correos = CorreosFormatos::with('correo')
            ->where('id_formatos', $id)
            ->get();


        $correoList = $correos->map(function ($item) {
            return $item->correo ? $item->correo->correo : null;
        })->filter(); // filtrar nulos

        return response()->json(['correos' => $correoList]);
    }

    public function obtenerCamposPorFormato(Request $request)
    {
        // Validar los parámetros de fecha y formato
        $request->validate([
            'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Obtener los Formatocasetas con las relaciones de Caseta y Formato
        $FormatoCasetas = Formatocaseta::with('Caseta', 'Formato')->get();

        // Agrupar los Formatocasetas por nombre de la Caseta
        $groupedByCaseta = $FormatoCasetas->groupBy(function ($item) {
            return $item->Caseta->nombre;
        });

        // Para cada caseta, obtener los campos de incidencia filtrados por fecha
        $groupedByCaseta = $groupedByCaseta->map(function ($items) use ($request) {
            return $items->map(function ($item) use ($request) {
                // Obtener el Formato relacionado
                $formato = $item->Formato;

                // Verificar que el formato sea el que buscamos
                if ($formato->id_formatos != $request->formato_id) {
                    return null;  // Devolver null si no es el formato buscado
                }

                // Obtener los campos de incidencia dentro del rango de fechas
                $campoIncidencias = $formato->campoIncidencias->filter(function ($campoIncidencia) use ($request) {
                    return $campoIncidencia->incidencia &&
                        $campoIncidencia->incidencia->fecha_hora >= $request->fecha_inicio &&
                        $campoIncidencia->incidencia->fecha_hora <= $request->fecha_fin;
                });

                // Si se encontraron incidencias, devolver el formato con sus campos
                return $campoIncidencias->isNotEmpty() ? [
                    'id_formatos' => $formato->id_formatos,
                    'Tipo' => $formato->Tipo,
                    'campoIncidencias' => $campoIncidencias
                ] : null;
            })->filter();  // Filtrar los formatos que no tienen campos válidos
        });

        // Si no se encuentra ningún campo para el formato, retornar un error
        if ($groupedByCaseta->isEmpty()) {
            return response()->json(['error' => 'No se encontraron campos para el formato especificado'], 404);
        }

        // Retornar el JSON con los datos agrupados
        return response()->json(['groupedByCaseta' => $groupedByCaseta]);
    }
}
