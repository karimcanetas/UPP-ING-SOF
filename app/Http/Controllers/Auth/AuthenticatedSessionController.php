<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\EmpleadosCatalogo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Validation\ValidatesRequests;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{

    use ValidatesRequests;

    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'n_empleado' => 'required|string',
            'password' => 'required|string'
        ]);

        $credenciales = [
            'n_empleado' => $credentials['n_empleado'],
            'password' => $credentials['password']
        ];

        if (Auth::attempt($credenciales)) {
            $user = $request->user();

            $sucursalPrincipal = $user->empleado->id_sucursal_principal;

            Session::put('id_sucursal_principal', $sucursalPrincipal);

            Log::info('Usuario logueado:', [
                'usuario' => Auth::user()->empleado->nombres,
                'id_sucursal_principal' => $sucursalPrincipal
            ]);

            Alert::html(
                '<b> Bienvenido <u class="text-primary">' . Auth::user()->empleado->nombres . '</u> </b>',
                " Al <b class='text-danger'> Sistema de Vigilancia PRT</b>",
                'success'
            );

            return redirect()->route('send.index');
        } else {
            // Si las credenciales son inválidas
            Alert::error('Error', 'Credenciales inválidas.');
            return redirect()->back()->withInput(); // Redirige de vuelta con los datos del formulario
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
