<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;

class TeachersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Teacher([


            'name' => $row[0],
            'comp_num' => $row[1],
            'email' => $row[3],
            'password' => bcrypt($row[1]),
        ]);
    }
}
