<?php

namespace App\Http\Controllers;

use App\Models\DepartamentoPuesto;
use App\Models\empleado_sucursal;
use App\Models\EmpleadosCatalogo;
use App\Models\EmpleadosFormatos;
use App\Models\EmpleadosNoRegistrados;
use App\Models\Formato;
use Illuminate\Http\Request;
use App\Models\Puestos;
use App\Models\Sucursal;
use App\Models\TipoAsociado;
use Database\Seeders\departamento_puesto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Formatocaseta;


class EmpleadosCatologoController extends Controller
{
    public function create()
    {
        $puestos = Puestos::all();
        $tiposAsociados = TipoAsociado::on('mysql')->get(); //obtengo el los datos de la concentradora
        $puestos = Puestos::on('mysql')->get();

        return view('incidencias.create', compact('tiposAsociados', 'puestos', 'empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'id_puesto' => 'required',
            'apellido_p' => 'nullable|string|max:255',
            'apellido_m' => 'nullable|string|max:255',
        ]);

        $empleado = new EmpleadosNoRegistrados();
        $empleado->setConnection('mysql_2');  // Cambia la conexión a 'mysql_2'
        $empleado->nombres = strtoupper($request->nombres);
        $empleado->id_puesto = $request->id_puesto;
        $empleado->apellido_p = strtoupper($request->apellido_p);
        $empleado->apellido_m = strtoupper($request->apellido_m);

        $empleado->save();

        $puesto = Puestos::find($empleado->id_puesto);

        // concateno el nombre completo con los apellidos
        $nombreCompleto = $empleado->nombres . ' ' . $empleado->apellido_p . ' ' . $empleado->apellido_m;

        return response()->json([
            'id_empleado' => $empleado->id_empleado,
            'nombres' => $nombreCompleto,
            'id_puesto' => $empleado->id_puesto,
            'puestoNombre' => $puesto ? $puesto->nombre : '',
            'message' => 'Empleado agregado exitosamente.',
        ]);
    }

    public function usuariosEmails($sucursalId, $departamentoId)
    {
        // obtengo los empleados de la sucursal especificada
        $empSuc = empleado_sucursal::where('id_sucursal', $sucursalId)->pluck('id_empleado');
        // obtengo los puestos asociados al departamento especificado
        $puestos = DepartamentoPuesto::where('id_departamento', $departamentoId)->pluck('id_puesto');
        // obtengo los empleados que están en la sucursal y puestos solicitados y que su status sea 1
        $empleados = EmpleadosCatalogo::whereIn('id_empleado', $empSuc)
            ->whereIn('id_puesto', $puestos)
            ->where('status', 1)
            ->with(['user:id,n_empleado,email'])
            ->get()
            ->map(function ($empleado) {
                return [
                    'id_empleado' => $empleado->id_empleado,
                    'nombres' => $empleado->nombres,
                    'apellidos' => $empleado->apellido_p . ' ' . $empleado->apellido_m,
                    'email' => $empleado->user->email ?? '',
                ];
            });

        return response()->json($empleados);
    }


    public function obtenerTodosLosFormatos()
    {
        $pivotData = DB::connection('mysql_2')
            ->table('empleados_formatos')
            ->join('formatos', 'empleados_formatos.id_formatos', '=', 'formatos.id_formatos')
            ->select('empleados_formatos.id_empleado', 'empleados_formatos.id_formatos', 'empleados_formatos.status', 'formatos.Tipo')
            ->get();
        $empleados = DB::connection('mysql')
            ->table('empleados')
            ->whereIn('id_empleado', $pivotData->pluck('id_empleado'))
            ->select(
                'id_empleado',
                DB::raw("CONCAT(nombres, ' ', apellido_p, ' ', apellido_m) AS nombres")
            )
            ->pluck('nombres', 'id_empleado');

        // recupero la empresa y sucursal junto con la caseta
        $FormatoCasetas = Formatocaseta::with([
            'Caseta.empresa',
            'Caseta.sucursal'
        ])->get()->keyBy('id_formatos');

        // los paso todo a a varible pivoteData
        foreach ($pivotData as $item) {
            $formatoCaseta = $FormatoCasetas[$item->id_formatos] ?? null;
            $item->id_casetas = $formatoCaseta->id_casetas;
            $item->nombres = $empleados[$item->id_empleado] ?? 'Empleado no encontrado';
            $item->nombre_caseta = $formatoCaseta->Caseta->nombre ?? 'Caseta no encontrada';
            $item->empresa = $formatoCaseta->Caseta->sucursal->empresa->alias ?? 'Sin empresa';
            $item->sucursal = $formatoCaseta->Caseta->sucursal->nombre ?? 'Sin sucursal';
        }
        Log::info('Datos de pivotData:', ['pivotData' => $pivotData]);
        return response()->json([
            'success' => true,
            'data' => $pivotData
        ]);
    }

    public function actualizarStatus(Request $request, $empleadoId, $formatoId)
    {
        // Validación del status
        $validated = $request->validate([
            'status' => 'required|boolean',
        ]);

        try {
            $empleadoFormato = EmpleadosFormatos::where('id_empleado', $empleadoId)
                ->where('id_formatos', $formatoId)
                ->first(); //obtener un registro

            if (!$empleadoFormato) {
                return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
            }

            //actualizacion del status
            $empleadoFormato->status = $validated['status'];
            $empleadoFormato->save();

            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar el estado', 'error' => $e->getMessage()], 500);
        }
    }
}
