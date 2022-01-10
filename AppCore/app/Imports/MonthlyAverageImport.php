<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\MonthlyAverage;
use App\Station;

class MonthlyAverageImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
    	/*$code_station = $row['codigo_de_la_estacion'];
    	$station = Station::where('code', $code_station)->first();
    	if (is_null($station)) {
    		return null;
    	}

        return new MonthlyAverage([
        	'average' => $row[1], 
        	'date' => $row[2],
        	'precipitation_sumatory' => $row[3],
        	'annual_standard' => $row[4],
        	'station_id' => $station->id,
        ]);*/
    }
}
