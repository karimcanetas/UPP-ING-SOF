<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Models\Formato;
use Illuminate\Support\Facades\Session;
use App\Models\CorreosFormatos;
use Illuminate\Support\Facades\DB;
use App\Models\Formatocaseta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormatosController extends Controller
{
    public function checksSeparadores()
    {

        $idSucursalPrincipal = Session::get('id_sucursal_principal');
        Log::info('ID de sucursal principal desde otro metodo:', ['id_sucursal' => $idSucursalPrincipal]);

        //buscar formatos de esa sucursal principal dada

        $sucursalIds = DB::connection('mysql')
            ->table('sucursales')
            ->where('id_sucursal', $idSucursalPrincipal)
            ->pluck('id_sucursal')
            ->toArray();

        $FormatoCasetas = Formatocaseta::with([
            'Caseta.sucursal.empresa',
            'Formato.EmpleadosFormatos.Empleado.user'
        ])
            // ->get();
            ->whereHas('Caseta', function ($query) use ($sucursalIds) {
                $query->whereIn('id_sucursal', $sucursalIds);
            })
            ->get();

        // agrupo por sucursal
        $groupedBySucursal = $FormatoCasetas->groupBy(function ($item) {
            return $item->Caseta->sucursal->nombre ?? 'Sin sucursal';
        })->map(function ($items) {
            return $items->groupBy(function ($item) {
                return $item->Caseta->nombre;
            })->map(function ($items) {
                return $items->map(function ($item) {

                    $empleados = $item->Formato->EmpleadosFormatos
                        ->where('status', 1)
                        ->map(fn($pivot) => $pivot->Empleado?->user?->email ? [
                            'nombre' => $pivot->Empleado->nombres . ' ' . $pivot->Empleado->apellido_p . ' ' . $pivot->Empleado->apellido_m,
                            'email' => $pivot->Empleado->user->email,
                        ] : null)
                        ->filter();

                    return [
                        'id_casetas' => $item->id_casetas,
                        'nombre_caseta' => $item->Caseta->nombre,
                        'id_formatos' => $item->id_formatos,
                        'Tipo' => $item->Formato->Tipo,
                        'empresa' => $item->Caseta->sucursal->empresa->alias ?? 'Sin empresa',
                        'sucursal' => $item->Caseta->sucursal->nombre ?? 'Sin sucursal',
                        'empleados' => $empleados->values(),
                    ];
                });
            });
        });

        Log::info(' agrupadas por sucursal:', $groupedBySucursal->toArray());

        return response()->json(['groupedBySucursal' => $groupedBySucursal]);
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
