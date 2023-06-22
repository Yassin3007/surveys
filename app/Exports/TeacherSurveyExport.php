<?php

namespace App\Exports;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Survey;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherSurveyExport implements FromCollection, WithHeadings, WithMapping
{


    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function headings(): array
    {
        return [
            'اسم الاستبيان',

            'اسم المدرب',
            'رقم الحاسب',
            'السؤال',
            'الاجابة',

        ];
    }
    public function map($row): array
    {

        $teacher = Teacher::query()->findOrFail($row->teacher_id);

        if ($row->answer_id !=null){
            $answer = Answer::query()->findOrFail($row->answer_id)->answer ;
        }else{
            $answer = $row->answer ;
        }

        return [
          Survey::query()->findOrFail($row->survey_id)->name ,

            $teacher->name,
            $teacher->comp_num ,

            Question::query()->findOrFail($row->question_id)->question ,
            $answer


        ];
    }
    public function collection()
    {
        return $this->data;
    }



}
