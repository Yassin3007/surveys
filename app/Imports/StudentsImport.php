<?php

namespace App\Imports;

use App\Models\Section;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Table;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
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
//        $section_name =Table::query()->where('trainee_number',$row[5])->first()->section;
//        $section_id = Section::query()->where('name',$section_name)->first()->id;

        if ($row[8]=='دبلوم'){
            $stage = 1 ;
        }else{
            $stage = 2 ;
        }
        return new Student([

            'email'=>$row[0],
            'name'=>$row[3],
            'id_num'=>$row[4],
            'number'=>$row[5],
            'phone'=>$row[1],

            'stage'=>$stage,


        ]);
    }
}
