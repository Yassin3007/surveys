<?php

namespace App\Imports;

use App\Models\StudentTable;
use App\Models\Table;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentTableImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        if ($row[5]=='دبلوم'){
            $stage = 1 ;
        }else{
            $stage = 2 ;
        }
        return new StudentTable([
            'trainee_name'=>$row[6],
            'trainee_number'=>$row[7],
            'reference_number'=>$row[9],
            'trainer_name'=>$row[8],
            'subject_name'=>$row[10],
            'subject_number'=>$row[11],
            'section'=>$row[12],
            'stage'=>$stage,
        ]);
    }
}
