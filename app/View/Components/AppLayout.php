<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Puestos;
use App\Models\TipoAsociado;
use App\Models\Empresa;
use App\Models\EmpleadosNoRegistrados;

use Carbon\Carbon;
use DateTime;
use Alert;
use App\Models\Caseta;
use App\Models\Correos;
use Hash;
use DB;

class AppLayout extends Component
{
    public $puestos;
    public $tiposAsociados;
    public $empresas;
    public $casetas;
    // public $correos;


    public function __construct()
    {

        $this->empresas = Empresa::all();
        $this->puestos = Puestos::all();
        $this->tiposAsociados = TipoAsociado::on('mysql')->get();
        $this->casetas = Caseta::on('mysql_2')->get();
        // $this->correos = Correos::on('mysql_2')->get();

    }

    public function render(): View
    {
        return view('layouts.app', [
            'empresas' => $this->empresas,
            'puestos' => $this->puestos,
            'tiposAsociados' => $this->tiposAsociados,
            'casetas' => $this->casetas,
            // 'correos' => $this->correos,

        ]);
    }
};
