<?php

namespace App\Exports;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentSubjectSurveyExport implements FromCollection, WithHeadings, WithMapping
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
            'نوع التقييم',
            'اسم الطالب',
            'التخصص',
            'الرقم التدريبي',
            'الرقم المرجعي',
            'اسم المقرر',
            'اسم المدرب',
            'السؤال',
            'الاجابة',

        ];
    }
    public function map($row): array
    {
        if ($row->type == 0){
            $type = 'تقييم مقرر';
        }else{
            $type='تقييم مدرب';
        }
        $student = Student::query()->findOrFail($row->student_id);
        $ref = StudentTable::query()->where('reference_number',$row->reference_number)->first();

        if ($row->answer_id !=null){
            $answer = Answer::query()->findOrFail($row->answer_id)->answer ;
        }else{
            $answer = $row->answer ;
        }

        return [
          Survey::query()->findOrFail($row->survey_id)->name ,
            $type ,
            $student->name,
            $ref->section,
            $student->number ,
            $row->reference_number ,
            $ref->subject_name,
            $ref->trainer_name ,
            Question::query()->findOrFail($row->question_id)->question ,
            $answer


        ];
    }
    public function collection()
    {
        return $this->data;
    }



}
