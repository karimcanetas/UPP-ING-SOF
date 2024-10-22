<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Models\Formato;
use App\Models\CorreosFormatos;
use Illuminate\Http\Request;

class CorreosController extends Controller
{
    public function index()
    {
        $correos = Correos::all();
        $formatos = Formato::all();
        $correos = [];
        return view('correos.index', compact('correos'));
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

        // Verificar si el formato existe
        if (!$formato) {
            return redirect()->back()->with('error', 'Formato no encontrado.');
        }
        return view('dashboard', compact('formato'));
    }
}
