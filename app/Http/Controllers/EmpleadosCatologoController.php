<?php

namespace App\Http\Controllers;

use App\Models\EmpleadosCatalogo;
use App\Models\EmpleadosFormatos;
use App\Models\EmpleadosNoRegistrados;
use App\Models\Formato;
use Illuminate\Http\Request;
use App\Models\Puestos;
use App\Models\Sucursal;
use App\Models\TipoAsociado;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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
            // 'id_tipo_asociado' => 'required',
            'apellido_p' => 'nullable|string|max:255',
            'apellido_m' => 'nullable|string|max:255',
        ]);


        $empleado = new EmpleadosNoRegistrados();
        $empleado->setConnection('mysql_2');  // Cambia la conexión a 'mysql_2'
        $empleado->nombres = strtoupper($request->nombres);
        $empleado->id_puesto = $request->id_puesto;
        // $empleado->id_tipo_asociado = $request->id_tipo_asociado;
        $empleado->apellido_p = strtoupper($request->apellido_p);
        $empleado->apellido_m = strtoupper($request->apellido_m);


        $empleado->save();

        $puesto = Puestos::find($empleado->id_puesto);
        return response()->json([
            'id_empleado' => $empleado->id_empleado,
            'nombres' => $empleado->nombres,
            'id_puesto' => $empleado->id_puesto,
            'puestoNombre' => $puesto ? $puesto->nombre : '',
            'message' => 'Empleado agregado exitosamente.',
        ]);
        // return redirect()->route('incidencias.create')->with('empleado_success', 'Empleado agregado exitosamente.');
    }

    public function usuariosEmails($sucursalId, $departamentoId)
    {
        $empleados = EmpleadosCatalogo::join('empleado_sucursal', 'empleado_sucursal.id_empleado', '=', 'empleados.id_empleado')
            ->join('suc_dep', 'suc_dep.id_sucursal', '=', 'empleado_sucursal.id_sucursal')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'suc_dep.id_departamento')
            ->join('departamento_puesto', 'departamento_puesto.id_departamento', '=', 'departamentos.id_departamento')
            ->join('puestos', 'puestos.id_puesto', '=', 'departamento_puesto.id_puesto')
            ->join('empleados AS puesto_empleados', 'puesto_empleados.id_empleado', '=', 'empleados.id_empleado')
            ->join('users', 'users.n_empleado', '=', 'empleados.n_empleado')
            ->where('empleado_sucursal.id_sucursal', $sucursalId)  // filtro por sucursal
            ->where('suc_dep.id_departamento', $departamentoId)    // filtro por departamento
            ->select('empleados.id_empleado', 'empleados.n_empleado', 'empleados.nombres', 'users.email')
            ->get();

        return response()->json($empleados);
    }
    public function obtenerTodosLosFormatos()
    {
        // obtengo los registros de la tabla pivote
        $pivotData = DB::connection('mysql_2')
            ->table('empleados_formatos')
            ->join('formatos', 'empleados_formatos.id_formatos', '=', 'formatos.id_formatos') 
            ->select('empleados_formatos.id_empleado', 'empleados_formatos.id_formatos', 'empleados_formatos.status', 'formatos.Tipo') //campos deseados
            ->get();


        // recupero los nombres
        $empleados = DB::connection('mysql')
            ->table('empleados')
            ->whereIn('id_empleado', $pivotData->pluck('id_empleado'))
            ->pluck('nombres', 'id_empleado'); //campos necesarios





        //asociamos a la tabla empleados_formatos
        foreach ($pivotData as $item) {
            $item->nombres = $empleados[$item->id_empleado] ?? 'Empleado no encontrado';
        }

        return response()->json(['success' => true, 'data' => $pivotData]);
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
