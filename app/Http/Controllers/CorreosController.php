<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Models\Formato;
use App\Models\CorreosFormatos;
use App\Models\Empresa;
use Illuminate\Http\Request;

class CorreosController extends Controller
{
    public function index()
    {
        // $correos = Correos::on('mysql_2')->get();
        // return view('correos_formatos_store', compact('correos'));

        $correos = Correos::on('mysql_2')->get();
    return response()->json($correos);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'correo' => 'required|email|unique:mysql_2.correos,correo',
            ]);

            $correo = Correos::on('mysql_2')->create([
                'correo' => ($request->correo),
            ]);

            return response()->json(['message' => 'Correo agregado exitosamente.', 'correo' => $correo], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 400);
        }
    }






    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'correo_destino' => 'required|email',
    //         'asunto' => 'required|string|max:255',
    //         'mensaje' => 'required|string',
    //     ]);

    //     Correos::create([
    //         'correo' => $request->correo_destino,
    //         'asunto' => $request->asunto,
    //         'mensaje' => $request->mensaje,
    //     ]);

    //     return redirect()->route('correos.index')->with('success', 'Correo enviado exitosamente.');
    // }

    public function edit($id)
    {
        $correo = Correos::findOrFail($id);
        return view('correos.edit', compact('correo'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'correo_destino' => 'required|email',
    //         'asunto' => 'required|string|max:255',
    //         'mensaje' => 'required|string',
    //     ]);

    //     $correo = Correos::findOrFail($id);
    //     $correo->update([
    //         'correo' => $request->correo_destino,
    //         'asunto' => $request->asunto,
    //         'mensaje' => $request->mensaje,
    //     ]);

    //     return redirect()->route('correos.index')->with('success', 'Correo actualizado exitosamente.');
    // }

    public function destroy($id)
    {
        $correo = Correos::findOrFail($id);
        $correo->delete();

        return redirect()->route('correos.index')->with('success', 'Correo eliminado exitosamente.');
    }
    public function show($id)
    {
        // Obtener el formato por su ID
        $formato = Formato::with('correos')->find($id);
        $empresas = Empresa::all();

        // Verificar si el formato existe
        if (!$formato) {
            return redirect()->back()->with('error', 'Formato no encontrado.');
        }
        return view('dashboard', compact('formato', 'empresas'));
    }
    // En tu controlador
    public function create()
    {
        $empresas = Empresa::all(); // Suponiendo que tienes un modelo Empresa
        return view('correos.create', compact('empresas'));
    }
}
