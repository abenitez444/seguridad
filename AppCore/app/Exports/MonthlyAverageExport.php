<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthlyAverageExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [];
    }

     public function headings(): array
    {
        return [
            'Código de la Estación',
            'Media',
            'Fecha (Ej: 2019-11)',
            'Sumatoría de Precipitación',
            'Norma Anual',
        ];
    }
}