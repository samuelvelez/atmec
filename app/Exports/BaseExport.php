<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BaseExport implements Responsable, ShouldAutoSize, ShouldQueue, WithCustomStartCell, WithEvents
{
    use Exportable;

    protected $fileName;
    protected $writerType = Excel::XLSX;

    public function startCell(): string
    {
        return 'A4';
    }

    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->freezePane('A5');
                $event->sheet->getDelegate()->getStyle('A4:Z4')->getFont()->setBold(true);
                $event->sheet->getPageSetup()->setFitToWidth(1);

                $drawing = new Drawing();
                $drawing->setName('ATM Logo');
                $drawing->setDescription('ATM');
                $drawing->setPath(public_path('/images/atm.png'));
                $drawing->setHeight(40);
                $drawing->setCoordinates('A1');

                $event->sheet->addDrawings($drawing);

                $event->sheet->mergeCells('A1:A3');
                $event->sheet->mergeCells('B1:D1');
                $event->sheet->mergeCells('B2:D2');

                $event->sheet->setCellValue('B1', 'Generado por: ' . \Auth::user()->full_name());
                $event->sheet->setCellValue('B2', 'Fecha: ' . Carbon::now()->format('d/m/Y h:i:s a'));

                $event->sheet->getHeaderFooter()
                    ->setOddHeader('&C&HAutoridad de Tránsito Municipal');
                $event->sheet->getHeaderFooter()
                    ->setOddFooter('&LGenerado por:' . \Auth::user()->full_name() . '&RFecha: ' . Carbon::now());
            }
        ];
    }
}