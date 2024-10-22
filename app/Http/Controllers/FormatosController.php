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
        // Obtener todos los formatos desde la base de datos
        $formatos = Formato::all();

        // Obtener todos los correos con sus formatos relacionados
        $correosConFormatos = CorreosFormatos::with(['correo', 'formato'])->get();

        // Pasar los formatos y correos a la vista
        return view('incidencias.create', compact('formatos', 'correosConFormatos'));
    }

    public function show($id)
    {
        // Obtener el formato por su ID
        $formato = Formato::with('correos')->find($id);

        // Verificar si el formato existe
        if (!$formato) {
            return redirect()->back()->with('error', 'Formato no encontrado.');
        }

        return view('dashboard', compact('formato'));
    }
    public function getCorreos($id)
    {
        // Obtener el formato y los correos relacionados
        $correos = CorreosFormatos::with('correo')
            ->where('id_formatos', $id)
            ->get();

        return response()->json(['correos' => $correos]);
    }
}
