<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ReporteExport implements FromView, WithTitle, WithEvents, ShouldAutoSize
{
    protected $camposIncidencias;
    protected $formato;

    public function __construct($formato, $camposIncidencias)
    {
        $this->camposIncidencias = $camposIncidencias;
        $this->formato = $formato;
    }

    public function view(): View
    {
        $nombresCampos = [];
        $valoresPorCampo = [];

        foreach ($this->camposIncidencias as $incidencia) {
            $nombreCampo = $incidencia->campo->campo;

            if (!in_array($nombreCampo, $nombresCampos)) {
                $nombresCampos[] = $nombreCampo;
            }

            $valoresPorCampo[$nombreCampo][] = $incidencia->valor;
        }

        // dd([
        //     'camposIncidencias' => $this->camposIncidencias,
        //     'nombresCampos' => $nombresCampos,
        //     'valoresPorCampo' => $valoresPorCampo,
        // ]);

        return view('Formatos.reporte_export', [
            'nombresCampos' => $nombresCampos,
            'valoresPorCampo' => $valoresPorCampo,
            'formato' => $this->formato
        ]);
    }


    public function title(): string
    {
        return 'Reporte Vigilancia PRT ' . $this->formato->Tipo;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $columnCount = max(count($this->camposIncidencias), 1);
                $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);
                $lastRow = max(count($this->camposIncidencias) + 5, 10);

                // encabezado principal
                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->getCell('A1')->setValue('Reporte Vigilancia PRT - ' . $this->formato->Tipo);
                $sheet->getStyle('A1')->applyFromArray($this->getHeaderStyle());
                $sheet->getRowDimension(1)->setRowHeight(70);

                
                $sheet->getColumnDimension('A')->setWidth(70);
                $sheet->getColumnDimension($lastColumn)->setWidth(70);

                // encabezado de los campos
                $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray($this->getColumnHeaderStyle());
                $sheet->getRowDimension(2)->setRowHeight(30);

                // ancho
                foreach (range('A', $lastColumn) as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }

                //diseño de celdas dinamicos
                for ($row = 3; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(25);  // alto de la fila
                    if ($row % 2 == 0) {  
                        $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['argb' => 'FFF9F9F9'],
                            ],
                        ]);
                    }
                }

                //bordes
                $dataRange = "A3:{$lastColumn}{$lastRow}";
                $sheet->getStyle($dataRange)->applyFromArray($this->getDataCellStyle());

                $sheet->getStyle("A2:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FFD1D1D1'],
                        ],
                    ],
                ]);
            },
        ];
    }

    /**
     * Estilo para el encabezado principal.
     */
    private function getHeaderStyle(): array
    {
        return [
            'font' => [
                'bold' => true,
                'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE],
                'size' => 22,
                'name' => 'Trebuchet MS',
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF102E42'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    }

    /**
     * Estilo para el encabezado de columnas.
     */
    private function getColumnHeaderStyle(): array
    {
        return [
            'font' => [
                'size' => 14,
                'bold' => true,
                'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF2F2F2'],
            ],
        ];
    }

    /**
     * Estilo para celdas de datos.
     */
    private function getDataCellStyle(): array
    {
        return [
            'font' => [
                'size' => 12,
                'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true, 
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFFFFF'],
            ],
        ];
    }
}
