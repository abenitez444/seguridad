<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Data;
use App\Station;

class DataImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {

    	$code_station = $row['codigo_de_la_estacion'];
    	$station = Station::where('code', $code_station)->first();
    	if (is_null($station)) {
    		return null;
    	}

        $d = new Data;
        $d->sample_number = $row['numero_de_muestra'];
        $d->sample_date = $row['fecha_de_muestra_ej_2019_10_31'];
        $d->concentrations = $row['consentraciones'];
        $d->rule_24 = $row['norma_24'];
        $d->annual_standards = $row['normas_anuales'];
        $d->temperatures = $row['temperatura'];
        $d->humidities = $row['humedad'];
        $d->pressures = $row['presion'];
        $d->rainfall = $row['precipitaciones'];
        $d->quality_index = $row['indice_de_calidad'];
        $d->filter_numbers = $row['numeros_de_filtros'];
        $d->sunshine = $row['brillo_solar'];
        $d->station_id = $station->id;
        $d->save();

        return $d;
    }
}
