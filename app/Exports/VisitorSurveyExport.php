<?php

namespace App\Exports;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Survey;
use App\Models\Teacher;
use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VisitorSurveyExport implements FromCollection, WithHeadings, WithMapping
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

            'اسم الزائر',

            'السؤال',
            'الاجابة',

        ];
    }
    public function map($row): array
    {

        $visitor = Visitor::query()->findOrFail($row->visitor_id);

        if ($row->answer_id !=null){
            $answer = Answer::query()->findOrFail($row->answer_id)->answer ;
        }else{
            $answer = $row->answer ;
        }

        return [
          Survey::query()->findOrFail($row->survey_id)->name ,

            $visitor->name,


            Question::query()->findOrFail($row->question_id)->question ,
            $answer


        ];
    }
    public function collection()
    {
        return $this->data;
    }



}
