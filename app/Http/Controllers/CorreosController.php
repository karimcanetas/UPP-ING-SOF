<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Models\Formato;
use App\Models\CorreosFormatos;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Mail\ReporteMailable;
use Illuminate\Support\Facades\Mail;

class CorreosController extends Controller
{
    public function index()
    {
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

            return response()->json([
                'message' => 'Correo agregado exitosamente.',
                'id_correo' => $correo->id_correo,
                'correo' => $correo->correo
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 400);
        }
    }

    public function editar()
    {
        $correo = Correos::on('mysql_2')->get();
        return response()->json($correo);
    }

    // public function destroy($id)
    // {
    //     $correo = Correos::findOrFail($id);
    //     $correo->delete();

    //     return redirect()->route('correos.index')->with('success', 'Correo eliminado exitosamente.');
    // }

    // public function show($id)
    // {
    //     $formato = Formato::with('correos')->find($id);
    //     $empresas = Empresa::all();

    //     if (!$formato) {
    //         return redirect()->back()->with('error', 'Formato no encontrado.');
    //     }
    //     return view('dashboard', compact('formato', 'empresas'));
    // }

    // public function create()
    // {
    //     $empresas = Empresa::all(); 
    //     return view('correos.create', compact('empresas'));
    // }

    // public function sendEmails(Request $request)
    // {
    //     // Validación
    //     $request->validate([
    //         'correosSeleccionados' => 'required|string',
    //         'subject' => 'required|string|max:255',
    //         'message' => 'required|string',
    //     ]);

    //     $correos = explode(',', $request->input('correosSeleccionados'));
    //     $subject = $request->input('subject');
    //     $message = $request->input('message');

    //     try {
    //         foreach ($correos as $correo) {
    //             Mail::to(trim($correo))->send(new ReporteMailable($subject, $message));
    //         }
    //         return redirect()->back()->with('success', 'Correos enviados exitosamente.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Error al enviar correos: ' . $e->getMessage());
    //     }
    // }
}
