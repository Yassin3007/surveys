<?php

namespace App\Imports;

use App\Models\MainTable;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Table;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class MainTableImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function __construct()
    {

    }
    public function model(array $row)
    {

        return new MainTable([

            'reference_number'=>$row[6],
            'trainer_name'=>$row[16],
            'comp_num'=>$row[17],
            'subject_name'=>$row[5],
            'subject_number'=>$row[4],
            'type'=>$row[8],



        ]);
    }
}
