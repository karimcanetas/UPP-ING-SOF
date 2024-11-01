<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Models\Formato;
use App\Models\CorreosFormatos;

use Illuminate\Http\Request;

class FormatosController extends Controller
{

    public function index()
    {
        $formatos = Formato::all();
        $correosConFormatos = CorreosFormatos::with(['correo', 'formato'])->get();

        return view('incidencias.create', compact('formatos', 'correosConFormatos'));
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
        // obtener los correos asociados al formato
        $correos = CorreosFormatos::with('correo')
            ->where('id_formatos', $id)
            ->get();

        // asegurarse de que hay correos asociados
        $correoList = $correos->map(function ($item) {
            return $item->correo ? $item->correo->correo : null; // asegurar de que esto sea correcto
        })->filter(); // filtrar nulos

        return response()->json(['correos' => $correoList]);
    }
    public function obtenerCamposPorFormato(Request $request)
    {
        $request->validate([
            'formato_id' => 'required|exists:mysql_2.formatos,id_formatos',
        ]);

        $formato = Formato::with('campoIncidencias.campo')
            ->find($request->formato_id);

        if (!$formato) {
            return response()->json(['error' => 'Formato no encontrado'], 404);
        }

        // Si existe, devolver los campos relacionados en formato JSON
        return response()->json($formato->campoIncidencias);
    }
}
