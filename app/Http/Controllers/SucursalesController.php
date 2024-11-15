<?php

namespace App\Http\Controllers;

use App\Models\Departamentos as ModelsDepartamentos;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Empresa;
// use Database\Seeders\departamentos;
use App\Models\Departamentos;

class SucursalesController extends Controller
{
    public function getSucursales($id_empresa)
    {
        // Encuentra la empresa por su ID y carga sus sucursales
        $empresa = Empresa::with('sucursales')->find($id_empresa);

        return $empresa
            ? response()->json($empresa->sucursales)
            : response()->json(['error' => 'Empresa no encontrada'], 404);
    }

    public function show($id)
    {
        // Encuentra la sucursal en la base de datos principal junto con sus casetas
        $sucursal = Sucursal::on('mysql')->with('casetas')->find($id);

        return $sucursal
            ? view('sucursal.show', compact('sucursal'))
            : abort(404, 'Sucursal no encontrada');
    }

    // public function getDepartamentos($id_departamento)
    // {
    //     $sucursal = Sucursal::on('mysql')->with('departamentos')->find($id_departamento);

    //     return $sucursal;
    // }
    // public function getDepartamentos($sucursalId)
    // {
    //     $departamentos = Departamentos::where('sucursal_id', $sucursalId)->get();
    //     return response()->json($departamentos);
    // }

    
}
