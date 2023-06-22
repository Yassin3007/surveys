<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\MainTable;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentSurvey;
use App\Models\StudentTable;
use App\Models\Subject;
use App\Models\Survey;
use App\Models\TeacherSurvey;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public $page = 20 ;
    public function login(Request $request){

        if (auth()->guard('teachers')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])
        ||auth()->guard('teachers')->attempt(['comp_num' => $request->input("email"), 'password' => $request->input("password")])
        ){
            toastr()->success('تم تسجيل الدخول بنجاح ');
            return redirect()->route('teachers_home');
        } else{
            toastr()->error('هناك خطا في بيانات الدخول ');
            return redirect()->back();
        }

    }
    public function index(){
        $teacher  = auth('teachers')->user();
        $subjects = MainTable::query()->where('comp_num',$teacher->comp_num)->distinct()
            ->select('subject_name','subject_number','reference_number','type')->get();

        $today = Carbon::now()->toDateString();
        $surveys = Survey::query()
            ->where('type',2)
            ->where('status',1)
            ->where('for',1)
//            ->where('deleted_at',null)

            ->where('start','<=',$today)
            ->where('end','>',$today)->get();

        $subject_survey = Survey::query()
            ->where('for',0)
            ->where('status',1)
//            ->where('deleted_at',null)

            ->where('type',0)
            ->where('start','<=',$today)
            ->where('end','>',$today)->first();

        $teacher_survey = Survey::query()
            ->where('for',0)
            ->where('deleted_at',null)

            ->where('status',1)
            ->where('type',1)
            ->where('start','<=',$today)
            ->where('end','>',$today)->first();
        return view('teachers.index',compact('teacher','subjects','subject_survey','teacher_survey','surveys'));
    }


    public function students_subject_survey($reference_number){

        $students = StudentTable::query()->where('reference_number',$reference_number)->paginate($this->page);


        $today = Carbon::now()->toDateString();

        $subject_survey = Survey::query()
            ->where('status',1)
            ->where('type',0)
            ->where('start','<=',$today)
            ->where('deleted_at',null)

            ->where('end','>',$today)->first();

        $teacher_survey = Survey::query()
            ->where('status',1)
            ->where('type',1)
            ->where('deleted_at',null)

            ->where('start','<=',$today)
            ->where('end','>',$today)->first();
        return view('teachers.students',compact('students','subject_survey','teacher_survey'));
    }

    public function logout(Request $request)
    {
        \auth()->guard('teachers')->logout();
        return redirect()->route('selection');

    }

    public function update_teacher_info(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $teacher  = auth('teachers')->user();
        $teacher->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
        if ($request->has('password')){
            $teacher->password = bcrypt($request->password) ;
            $teacher->save();
        }
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    public function teacher_survey($survey_id){
        $survey = Survey::query()->findOrFail($survey_id);
        $questions= $survey->questions;
        return view('teachers.survey',compact('survey','questions'));
    }

    public function teacher_survey_answer(Request $request ,$id ){
        $survey= Survey::query()->findOrFail($id);
        $questions  = $survey->questions ;
        foreach ($questions  as $question){
            $request->validate([
                'question_'.$question->id => 'required'
            ],[
                'required'=>'برجاء الاجابة علي كافة الاسئلة'
            ]);
        }

        $answers = $request->except('_token');

        foreach ($answers as $questionId => $choice) {
            $q_id = str_replace('question_', "", $questionId);
            $question = Question::query()->findOrFail($q_id);
            if ($question->type == 2){
                foreach ($choice as $x){
                    TeacherSurvey::query()->create([
                        'question_id'=> $q_id,
                        'answer_id'=>$x,
                        'teacher_id'=>\auth('teachers')->user()->id,
                        'survey_id'=>$id,


                    ]);
                }
            }
            elseif($question->type == 1){
                TeacherSurvey::query()->create([
                    'question_id'=> $q_id,
                    'answer_id'=>$choice,
                    'teacher_id'=>\auth('teachers')->user()->id,
                    'survey_id'=>$id,


                ]);
            }
            else{
                TeacherSurvey::query()->create([
                    'question_id'=> $q_id,
                    'answer'=>$choice,
                    'teacher_id'=>\auth('teachers')->user()->id,
                    'survey_id'=>$id,

                ]);
            }


        }
        toastr()->success('تم رفع الاجابات بنجاح');
        return redirect()->route('teachers_home');
    }
}
