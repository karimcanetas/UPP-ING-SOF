<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresasController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all(['id_empresa', 'alias']);
        return response()->json($empresas);
    }
    public function getSucursales($id_empresa)
    {
        $empresa = Empresa::find($id_empresa);
        
        if ($empresa) {
            $sucursales = $empresa->sucursales;
            return response()->json($sucursales);
        } else {
            return response()->json(['error' => 'Empresa no encontrada'], 404);
        }
    }
}
