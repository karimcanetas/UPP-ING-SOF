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
        $vigilantesYFechas = [];

        // recorre todas las incidencias y extrae los datos
        foreach ($this->camposIncidencias as $incidencia) {
            $nombreCampo = $incidencia->campo->campo;

            // agrega el campo a la lista si no esta
            if (!in_array($nombreCampo, $nombresCampos)) {
                $nombresCampos[] = $nombreCampo;
            }

            // guarda los valores por cada campo
            $valoresPorCampo[$nombreCampo][] = $incidencia->valor ?? '';

            // guarda los datos del vigilante y la fecha
            $vigilantesYFechas[] = [
                'nombre_vigilante' => $incidencia->incidencia->Nombre_vigilante ?? 'No asignado',
                'fecha_hora' => $incidencia->incidencia->fecha_hora ?? 'Sin fecha',
            ];
        }

        // devuelve la vista con los datos procesados
        return view('Formatos.reporte_export', [
            'nombresCampos' => $nombresCampos,
            'valoresPorCampo' => $valoresPorCampo,
            'formatoNombre' => $this->formatoNombre,
            'vigilantesYFechas' => $vigilantesYFechas,
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
                $sheet->mergeCells('A2:B2');
                // obtengo los datos procesados
                $data = $this->view()->getData();
                $vigilantesYFechas = $data['vigilantesYFechas'];

                // obtengo el primer valor de Nombre_vigilante y fecha_hora
                $primerNombreVigilante = $vigilantesYFechas[0]['nombre_vigilante'] ?? 'No asignado';
                $primerFechaHora = $vigilantesYFechas[0]['fecha_hora'] ?? 'Sin fecha';

                //etiquetas
                $nombreConEtiqueta = "Nombre Vigilante: $primerNombreVigilante";
                $fechaConEtiqueta = "Fecha: $primerFechaHora";

                $nombresCampos = $data['nombresCampos'];
                $columnCount = count($nombresCampos) + 1;
                $lastColumn = Coordinate::stringFromColumnIndex($columnCount);
                $lastRow = max(count($this->camposIncidencias) + 3, 10);

                // muevo los datos una fila hacia abajo
                $sheet->insertNewRowBefore(2);

                // agrego los encabezados personalizados en la primera fila
                $sheet->setCellValue('A1', $nombreConEtiqueta);
                $sheet->setCellValue($lastColumn . '1', $fechaConEtiqueta);


                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'underline' => Font::UNDERLINE_SINGLE,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ]);

                $sheet->getStyle($lastColumn . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'underline' => Font::UNDERLINE_SINGLE,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);

                $lastRow = $sheet->getHighestRow();

                for ($row = 3; $row <= $lastRow; $row++) {
                    $sheet->mergeCells("A{$row}:B{$row}");
                }

                // une y aplica estilo al encabezado general
                $this->mergeAndStyleHeader($sheet, "A2:{$lastColumn}2", "Reporte Vigilancia PRT - {$this->formatoNombre}");

                // une estilo al encabezado de las columnas
                $sheet->getStyle("A3:{$lastColumn}3")->applyFromArray($this->getColumnHeaderStyle());

                // une bordes a todas las celdas
                $this->applyBorders($sheet, $lastColumn, $lastRow);

                // une color alterno a las filas
                $this->applyRowAlternatingStyle($sheet, $lastColumn, $lastRow);

                // une el tamaño de las columnas
                foreach (range('A', $lastColumn) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // ajusto el texto en todas las celdas
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
