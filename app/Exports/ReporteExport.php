<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Color;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ReporteExport implements FromView, WithTitle, WithEvents
{
    private const HEADER_BG_COLOR = '2C3E50'; // gris oscuro
    private const HEADER_FONT_COLOR = 'FFFFFF'; // blanco del texto
    private const COLUMN_HEADER_BG_COLOR = '34495E'; // gris metálico
    private const ROW_ALT_COLOR = 'ECF0F1'; // gris de las filas
    private const FONT_NAME = 'Calibri'; // tipo de letra
    private const FONT_BOLD = true;
    private const FONT_SIZE_HEADER = 18;
    private const FONT_SIZE_DATA = 12;
    private const BORDER_COLOR = 'BDC3C7'; // bordes

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
        $vigilantesYFechas = [];

        foreach ($this->camposIncidencias as $incidencia) {
            $nombreCampo = $incidencia->campo->campo;

            if (!in_array($nombreCampo, $nombresCampos)) {
                $nombresCampos[] = $nombreCampo;
            }

            $valoresPorCampo[$nombreCampo][] = $incidencia->valor ?? '';

            // obtengo Nombre_vigilante y fecha_hora directamente desde la incidencia
            $vigilantesYFechas[] = [
                'nombre_vigilante' => nl2br($incidencia->incidencia->Nombre_vigilante ?? 'No asignado'),
                'fecha_hora' => nl2br($incidencia->incidencia->fecha_hora ?? 'Sin fecha'),
            ];
        }

        return view('Formatos.reporte_export', [
            'nombresCampos' => $nombresCampos,
            'valoresPorCampo' => $valoresPorCampo,
            'formato' => $this->formato,
            'vigilantesYFechas' => $vigilantesYFechas
        ]);
    }

    public function title(): string
    {
        return 'Reporte Vigilancia PRT - ' . $this->formato->Tipo;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $nombresCampos = array_filter($this->view()->getData()['nombresCampos'], fn($campo) => !empty($campo));
                $columnCount = count($nombresCampos) + 2;
                $lastColumn = Coordinate::stringFromColumnIndex($columnCount);
                $lastRow = max(count($this->camposIncidencias), 1);
                foreach (range('A', $lastColumn) as $columna) {
                    $caracteresMaximos = 0;
                    foreach ($sheet->getRowIterator() as $fila) {
                        $direccionCelda = $columna . $fila->getRowIndex();
                        $celda = $sheet->getCell($direccionCelda);

                        if (!is_null($celda->getValue())) {
                            $lineas = explode("\n", $celda->getValue());
                            foreach ($lineas as $linea) {
                                $caracteresMaximos = max($caracteresMaximos, mb_strlen($linea));
                            }
                        }
                    }
                    if ($caracteresMaximos > 50) {
                        $sheet->getColumnDimension($columna)->setWidth(60);
                    } elseif ($caracteresMaximos > 30) {
                        $sheet->getColumnDimension($columna)->setWidth(30);
                    } elseif ($caracteresMaximos > 20) {
                        $sheet->getColumnDimension($columna)->setWidth(19);
                    } elseif ($caracteresMaximos > 15) {
                        $sheet->getColumnDimension($columna)->setWidth(13);
                    } else {
                        $sheet->getColumnDimension($columna)->setWidth(12);
                    }
                    $sheet->getStyle($columna)->getAlignment()->setWrapText(true);
                }

                for ($row = 3; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }
                $sheet->getStyle("A2:{$lastColumn}{$lastRow}")
                    ->getAlignment()->setWrapText(true);

                //estilos
                $this->mergeAndStyleHeader($sheet, "A1:{$lastColumn}1", 'Reporte Vigilancia PRT - ' . $this->formato->Tipo);
                $this->setColumnHeaderStyle($sheet, $lastColumn);
                $this->applyBorders($sheet, $lastColumn, $lastRow);
                $this->applyRowAlternatingStyle($sheet, $lastColumn, $lastRow);
                $this->applyVigilanteAndFechaStyle($sheet, $lastColumn, $lastRow);
            },
        ];
    }


    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 100,
    //     ];
    // }

    private function mergeAndStyleHeader($sheet, $range, $title)
    {
        $sheet->mergeCells($range);
        $sheet->getCell(substr($range, 0, strpos($range, ':')))->setValue($title);
        $sheet->getStyle($range)->applyFromArray($this->getHeaderStyle());
        $sheet->getRowDimension(1)->setRowHeight(55);

        $sheet->getStyle($range)->getAlignment()->setWrapText(true);
    }

    private function setColumnHeaderStyle($sheet, $lastColumn)
    {
        $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray($this->getColumnHeaderStyle());
        $sheet->getRowDimension(2)->setRowHeight(35);
    }

    private function applyBorders($sheet, $lastColumn, $lastRow)
    {
        $dataRange = "A2:{$lastColumn}{$lastRow}";
        $sheet->getStyle($dataRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => self::BORDER_COLOR],
                ],
            ],
        ]);
    }

    private function applyRowAlternatingStyle($sheet, $lastColumn, $lastRow)
    {
        for ($row = 3; $row <= $lastRow; $row++) {
            $rowStyle = ($row % 2 == 0) ? self::ROW_ALT_COLOR : 'FFFFFF';
            $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => $rowStyle],
                ],
            ]);
        }
    }

    private function applyVigilanteAndFechaStyle($sheet, $lastColumn, $lastRow)
    {
        $vigilantesYFechas = $this->view()->getData()['vigilantesYFechas'];

        foreach ($vigilantesYFechas as $index => $vigilanteFecha) {
            $row = $index + 3; // Las filas de datos empiezan desde la fila 3
            $sheet->getStyle("A{$row}:B{$row}")->applyFromArray($this->getVigilanteFechaStyle());
        }
    }

    private function getVigilanteFechaStyle()
    {
        return [
            'font' => [
                'name' => self::FONT_NAME,
                'size' => self::FONT_SIZE_DATA,
                'color' => ['argb' => '2C3E50'], // Gris oscuro
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    }

    private function getHeaderStyle()
    {
        return [
            'font' => [
                'name' => self::FONT_NAME,
                'bold' => self::FONT_BOLD,
                'size' => self::FONT_SIZE_HEADER,
                'color' => ['argb' => self::HEADER_FONT_COLOR],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => self::HEADER_BG_COLOR],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    }

    private function getColumnHeaderStyle()
    {
        return [
            'font' => [
                'name' => self::FONT_NAME,
                'bold' => self::FONT_BOLD,
                'size' => self::FONT_SIZE_DATA,
                'color' => ['argb' => self::HEADER_FONT_COLOR],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => self::COLUMN_HEADER_BG_COLOR],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
    }
}
