<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Puestos;
use App\Models\TipoAsociado;
use App\Models\EmpleadosNoRegistrados;

use Carbon\Carbon;
use DateTime;
use Alert;
use Hash;
use DB;

class AppLayout extends Component
{
    public $puestos; 
    public $tiposAsociados; 

    public function __construct()
    {
        $this->puestos = Puestos::all();
        $this->tiposAsociados = TipoAsociado::on('mysql')->get(); // Obtengo los datos de la concentradora
    }
    public function render(): View
    {
        return view('layouts.app', [
            'puestos' => $this->puestos,
            'tiposAsociados' => $this->tiposAsociados,

            
        ]);
       
    }
}
