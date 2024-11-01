<?php

namespace App\Exports;

use App\Models\CampoIncidencia;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;

class ReporteExport implements FromView, WithTitle
{

    protected $formato;

    public function __construct($formato)
    {
        $this->formato = $formato;
        // $this->campos = $campos;
        // $this->fechaInicio = $fechaInicio;
        // $this->fechaFin = 
    }

    public function view(): View
    {
        $camposIncidencias = CampoIncidencia::on('mysql_2')
            ->with('campo')
            ->where('id_formatos', $this->formato->id_formatos)
            ->whereNotNull('valor')
            ->get();

        $datos = [];
        foreach ($camposIncidencias as $incidencia) {
            $datos[] = [
                'nombre' => $incidencia->campo->campo,
                'valor'  => $incidencia->valor,
            ];
        }

        return view('Formatos.reporte_export', [
            'datos' => $datos,
            'formato' => $this->formato
        ]);
    }

    public function title(): string
    {
        return 'Reporte Vigilancia PRT' .  $this->formato->Tipo;
    }
}
