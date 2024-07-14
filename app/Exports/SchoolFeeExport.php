<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class SchoolFeeExport implements FromArray, WithHeadings, ShouldAutoSize, WithTitle , WithColumnWidths
{
    use Exportable;

    protected $headers;

    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    public function ColumnWidths():array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 40,
            'E' => 20,
            'F' => 20,
            'G' => 50,
            'H' => 30,
            'I' => 30,
        ];
    }

    public function array(): array
    {
        return [];
    }

    public function headings(): array
    {
        return $this->headers;
    }

    public function title(): string
    {
        return 'Sheet 1';
    }
}
