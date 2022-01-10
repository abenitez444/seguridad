<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [];
    }

     public function headings(): array
    {
        return [
            'Código de la Estación',
            'Número de Muestra',
            'Fecha de Muestra (ej: 2019-10-31)',
            'Consentraciones',
            'Norma 24',
            'Normas Anuales',
            'Temperatura',
            'Humedad',
            'Presion',
            'Precipitaciones',
            'Índice de Calidad',
            'Números de Filtros',
            'Brillo Solar',
        ];
    }
}