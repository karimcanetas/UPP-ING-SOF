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
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class VigilanteExport implements FromView, WithTitle, WithEvents, ShouldAutoSize
{
    private const HEADER_BG_COLOR = '2C3E50';
    private const HEADER_FONT_COLOR = 'FFFFFF';
    private const COLUMN_HEADER_BG_COLOR = '34495E';
    private const ROW_ALT_COLOR = 'ECF0F1';
    private const FONT_NAME = 'Calibri';
    private const FONT_BOLD = true;
    private const FONT_SIZE_HEADER = 18;
    private const FONT_SIZE_DATA = 12;
    private const BORDER_COLOR = 'BDC3C7';

    protected $formatosCoincidentes;
    protected $camposIncidencias;
    protected $formatoNombre;

    public function __construct($formatosCoincidentes, $camposIncidencias, $formatoNombre)
    {
        $this->formatosCoincidentes = $formatosCoincidentes;
        $this->camposIncidencias = $camposIncidencias;
        $this->formatoNombre = $formatoNombre;
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

            // guarda los valores por cada campo
            $valoresPorCampo[$nombreCampo][] = $incidencia->valor ?? '';
        }

        return view('Formatos.reporte_export', [
            'nombresCampos' => $nombresCampos,
            'valoresPorCampo' => $valoresPorCampo,
            'formatoNombre' => $this->formatoNombre,
        ]);
    }

    // devuelve el titulo del reporte
    public function title(): string
    {
        return "Reporte Vigilancia PRT - {$this->formatoNombre}";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Obtengo los primeros valores de nombre_vigilante y fecha_hora
                $primerNombreVigilante = $this->camposIncidencias[0]->incidencia->Nombre_vigilante ?? 'No asignado';
                $primerFechaHora = $this->camposIncidencias[0]->incidencia->fecha_hora ?? 'Sin fecha';

                // Formato para la celda A1: Nombre Vigilante a la izquierda y Fecha a la derecha
                $nombreConEtiqueta = "Nombre Vigilante: $primerNombreVigilante";
                $fechaConEtiqueta = "Fecha: $primerFechaHora";

                // Concatenar ambos valores en la misma celda, separados por suficiente espacio
                $celdaContenido = $nombreConEtiqueta . str_repeat(" ", 50) . $fechaConEtiqueta;

                $sheet->setCellValue('A1', $celdaContenido);

                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'underline' => Font::UNDERLINE_SINGLE,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->insertNewRowBefore(2);

                $nombresCampos = $this->view()->getData()['nombresCampos'];
                $columnCount = count($nombresCampos);
                $lastColumn = Coordinate::stringFromColumnIndex($columnCount);
                $lastRow = max(count($this->camposIncidencias) + 3, 10);

                if ($columnCount === 1) {
                    $sheet->getColumnDimension('A')->setWidth(104);
                } else {
                    foreach (range('A', $lastColumn) as $column) {
                        $sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

                // Une 
                $this->mergeAndStyleHeader($sheet, "A2:{$lastColumn}2", "Reporte Vigilancia PRT - {$this->formatoNombre}");

                // Estilo para las cabeceras
                $sheet->getStyle("A3:{$lastColumn}3")->applyFromArray($this->getColumnHeaderStyle());

                // Aplica bordes a todas las celdas
                $this->applyBorders($sheet, $lastColumn, $lastRow);

                // Aplica color alterno a las filas
                $this->applyRowAlternatingStyle($sheet, $lastColumn, $lastRow);

                // Ajusta el texto en todas las celdas
                $sheet->getStyle("A3:{$lastColumn}{$lastRow}")->getAlignment()->setWrapText(true);
            },
        ];
    }

    // une y aplica estilo al encabezado
    private function mergeAndStyleHeader($sheet, $range, $title)
    {
        $sheet->mergeCells($range);
        $sheet->getCell(substr($range, 0, strpos($range, ':')))->setValue($title);
        $sheet->getStyle($range)->applyFromArray($this->getHeaderStyle());
    }

    // aplica estilo a las cabeceras de las columnas
    private function setColumnHeaderStyle($sheet, $lastColumn)
    {
        $sheet->getStyle("A3:{$lastColumn}3")->applyFromArray($this->getColumnHeaderStyle());
    }

    // aplica bordes a todas las celdas
    private function applyBorders($sheet, $lastColumn, $lastRow)
    {
        $sheet->getStyle("A2:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => self::BORDER_COLOR],
                ],
            ],
        ]);
    }

    // aplica color alterno a las filas
    private function applyRowAlternatingStyle($sheet, $lastColumn, $lastRow)
    {
        for ($row = 4; $row <= $lastRow; $row++) {
            $color = ($row % 2 == 0) ? self::ROW_ALT_COLOR : 'FFFFFF';
            $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => $color],
                ],
            ]);
        }
    }

    // devuelve el estilo del encabezado
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

    // devuelve el estilo de las cabeceras de las columnas
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
            ],
        ];
    }
}
