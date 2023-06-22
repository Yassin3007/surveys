<?php

namespace App\Http\Controllers\Surveys;

use App\Exports\StudentSubjectSurveyExport;
use App\Exports\StudentTeacherSurveyExport;
use App\Exports\TeacherSurveyExport;
use App\Exports\VisitorSurveyExport;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentSurvey;
use App\Models\Subject;
use App\Models\Survey;
use App\Models\Table;
use App\Models\Teacher;
use App\Models\TeacherSurvey;
use App\Models\Visitor;
use App\Models\VisitorSurvey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SurveyController extends Controller
{
    public $page =10 ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surveys = Survey::query()->paginate(10);
        $today = Carbon::now()->toDateString();

        return view('admin.surveys.index',compact('surveys','today'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'for'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);
        Survey::query()->create([
            'name'=>$request->name,
            'type'=>$request->type,
            'for'=>$request->for,
            'start'=>$request->start,
            'end'=>$request->end,
            'status'=>$request->status,
        ]);
        toastr()->success('تم تخزين البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'for'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);
        $survey->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'for'=>$request->for,
            'start'=>$request->start,
            'end'=>$request->end,
            'status'=>$request->status,
        ]);
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        toastr()->error('تم الحذف بنجاح');
        return redirect()->back();
    }

    public function archieve_surveys(){
        $surveys = Survey::query()->where('deleted_at',null)->get();
        foreach ($surveys as $survey){
            $survey->delete();
        }
        toastr()->warning('تم ارشفة كل الاستبيانات بنجاح');
        return redirect()->back();
    }
    public function archeive(){
        $surveys = Survey::onlyTrashed()->get();
        $today = Carbon::now()->toDateString();

        return view('admin.surveys.archeive',compact('surveys','today'));
    }


    public function restore($id){

//        $survey = Survey::query()->where('id',$id)->first();
        $survey = Survey::onlyTrashed()->where('id',$id)->first();

        $survey->restore();
        toastr()->success('تم استعادة الاستبيان بنجاح');
        return redirect()->back();
    }

    public function final_delete_survey($id){
        $survey = Survey::onlyTrashed()->where('id',$id)->first();
        $survey->forceDelete();

        toastr()->error('تم حذف الاستبيان بنجاح');
        return redirect()->back();
    }

    public function survey_archeive_details($id){
        $survey = Survey::onlyTrashed()->where('id',$id)->first();
        if ($survey->type == 0 &&$survey->for == 0){
            $subjects_ids = StudentSurvey::query()->where('survey_id',$survey->id)->distinct()->pluck('subject_id');
            $subjects =Subject::query()->whereIn('id',$subjects_ids)->paginate($this->page);
            return view('admin.surveys.subjects',compact('subjects','survey'));

        }
        elseif ($survey->type == 1 &&$survey->for == 0){
            $teachers_ids = StudentSurvey::query()->where('survey_id',$survey->id)->distinct()->pluck('teacher_id');
            $teachers = Teacher::query()->whereIn('id',$teachers_ids)->paginate($this->page);
            return view('admin.surveys.teachers',compact('teachers','survey'));


        }

        elseif($survey->for == 1){
            $teachers_ids  =TeacherSurvey::query()->where('survey_id',$survey->id)->distinct()->pluck('teacher_id');
            $teachers = Teacher::query()->whereIn('id',$teachers_ids)->paginate($this->page);

            return view('admin.surveys.engineers',compact('teachers','survey'));

        }elseif ($survey->for == 2){
            $visitor_ids  =VisitorSurvey::query()->where('survey_id',$survey->id)->distinct()->pluck('visitor_id');
            $visitors  = Visitor::query()->whereIn('id',$visitor_ids)->paginate($this->page);
            return view('admin.surveys.visitor_name',compact('visitor_ids','survey'));

        }
        else {
            return redirect()->back() ;
        }


    }

    public function archeive_subject_survey($subject_id,$survey_id){
        $subject  = Subject::query()->findOrFail($subject_id);
        $students_numbers = Table::query()->where('subject_number',$subject->number)
            ->where('trainer_name',$subject->teachers[0]->name)->distinct()->pluck('trainee_number');
        $students = Student::query()->whereIn('number',$students_numbers)->paginate($this->page);
        //
//        $students = Student::query()->where('grade_id',$subject->grade_id)->where('section_id',$subject->section_id)->paginate($this->page);
        $today = Carbon::now()->toDateString();

        $subject_survey = Survey::onlyTrashed()->where('id',$survey_id)->first();


        return view('admin.surveys.students',compact('students','subject','subject_survey'));

    }

    public function archeive_teacher_survey($teacher_id ,$survey_id){
        $teacher = Teacher::query()->findOrFail($teacher_id);
        $subjects = $teacher->subjects ;
        $survey = Survey::onlyTrashed()->where('id',$survey_id)->first();
        return view('admin.surveys.teacher_subjects',compact('subjects','survey','teacher'));
    }

    public function surveys_export(){
        $data = StudentSurvey::all();
        return Excel::download(new StudentSubjectSurveyExport($data), 'استبيان الطلاب - مقررات.xlsx');
    }

    public function survey_export($type){
        if ($type == 0){

            $surveys  = Survey::query()->where('type',0)
                ->where('for',0)->where('status',1)
                ->pluck('id');
            $data = StudentSurvey::query()->whereIn('survey_id',$surveys)->get();
            return Excel::download(new StudentSubjectSurveyExport($data), 'استبيان الطلاب - مقررات.xlsx');



        }elseif ($type == 1){

            $surveys  = Survey::query()->where('type',1)
                ->where('for',0)->where('status',1)
                ->pluck('id');
            $data = StudentSurvey::query()->whereIn('survey_id',$surveys)->get();
            return Excel::download(new StudentTeacherSurveyExport($data), 'استبيان الطلاب - مدربين.xlsx');


        }elseif ($type == 2){

            $surveys  = Survey::query()
                ->where('for',1)->where('status',1)
                ->pluck('id');
            $data = TeacherSurvey::query()->whereIn('survey_id',$surveys)->get();
            return Excel::download(new TeacherSurveyExport($data), 'استبيان المهندسين.xlsx');

        }elseif ($type == 3){

            $surveys  = Survey::query()
                ->where('for',2)->where('status',1)
                ->pluck('id');
            $data = VisitorSurvey::query()->whereIn('survey_id',$surveys)->get();
            return Excel::download(new VisitorSurveyExport($data), 'استبيان الزوار.xlsx');

        }
    }

}
