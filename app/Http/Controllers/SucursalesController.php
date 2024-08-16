<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Empresa;

class SucursalesController extends Controller
{
    public function getSucursales($empresa)
    {
        $empresa = Empresa::where('nombre', $empresa)->first();

        if ($empresa) {
            $sucursales = $empresa->sucursales;
            return response()->json($sucursales);
        } else {
            return response()->json(['error' => 'Empresa no encontrada'], 404);
        }
    }

    public function show($id)
    {
        // Encuentra la sucursal en la base de datos principal
        $sucursal = Sucursal::on('mysql')->find($id);

        if ($sucursal) {
            // Obtiene todas las casetas
            $casetas = $sucursal->casetas;
            
            // Devuelve una vista con los datos
            return view('sucursal.show', compact('sucursal', 'casetas'));
        }

        return abort(404, 'Sucursal no encontrada');
    }
}
