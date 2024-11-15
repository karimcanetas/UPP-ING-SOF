<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    public function getDepartamentos($id_departamento) {
        $departamento = Departamentos::on('mysql')->with('casetas')->find($id_departamento);
    }
}
