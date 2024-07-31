<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

use App\Models\Sucursal;
use App\Models\Empresa;
use App\Models\Tema;
use App\Models\User;

use Carbon\Carbon;
use DateTime;
use Alert;
use Hash;
use DB;

class AppLayout extends Component
{
    public function render(): View
    {

        $now = Carbon::now();

        $empresas = DB::connection('mysql_2')->table('empleado_sucursal as emp_suc')
            ->leftJoin('sucursales as suc', 'suc.id_sucursal', '=', 'emp_suc.id_sucursal')
            ->leftJoin('empresas as empr', 'empr.id_empresa', '=', 'suc.id_empresa')
            ->distinct()
            ->select('empr.id_empresa as id_empresa', 'empr.nombre as nombre_empresa', 'empr.alias as alias_empresa')
            ->get();

        $user_email = User::all();
        $consulta_tarea = Empresa::all();

        return view('layouts.app', compact('consulta_tarea', 'user_email', 'empresas', 'now'));
    }
}
