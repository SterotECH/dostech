<?php

namespace App\Imports;

use App\Models\House;
use Maatwebsite\Excel\Concerns\ToModel;

class HouseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new House([
            //
        ]);
    }
}
