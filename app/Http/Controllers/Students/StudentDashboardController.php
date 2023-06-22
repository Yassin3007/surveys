<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\MainTable;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentSurvey;
use App\Models\StudentTable;
use App\Models\Subject;
use App\Models\Survey;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentDashboardController extends Controller
{
    public function login(Request $request){
        if (Student::query()->where('number',$request->input("email"))->first()){
            $student =Student::query()->where('number',$request->input("email"))->first()  ;
            if ($student->password==null){
                $student->password =bcrypt($student->id_num) ;
                $student->save();
            }

            if (auth()->guard('students')->attempt(['number' => $request->input("email"), 'password' => $request->input("password")])){
                toastr()->success('تم تسجيل الدخول بنجاح ');
                return redirect()->route('students_home');
            } else{
                toastr()->error('هناك خطا في بيانات الدخول ');
                return redirect()->back();
            }
        }



    else{
            toastr()->error('هناك خطا في بيانات الدخول ');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        \auth()->guard('students')->logout();
        return redirect()->route('selection');

    }




        public function index(){
        $user = \auth('students')->user();

            $reference_numbers= StudentTable::query()->where('trainee_number',$user->number)->pluck('reference_number');

            $subjects = MainTable::query()
                ->whereIn('reference_number',$reference_numbers)->distinct()
                ->select('reference_number','trainer_name','comp_num','subject_name','type','subject_number')->get();


            $today = Carbon::now()->toDateString();

       $subject_survey = Survey::query()
           ->where('status',1)
           ->where('type',0)
           ->where('for',0)
           ->where('start','<=',$today)


           ->where('end','>',$today)->first();

       $teacher_survey = Survey::query()
           ->where('status',1)
           ->where('type',1)
           ->where('for',0)

           ->where('start','<=',$today)
           ->where('end','>',$today)->first();


        return view('students.index',compact('user','subjects','subject_survey','teacher_survey'));
    }

    public function student_survey($id,$reference_number,$type){

        $survey= Survey::query()->findOrFail($id);
//        $subject_id = Subject::query()->findOrFail($subject_id)->id;
        $questions  = $survey->questions ;
        return view('students.survey',compact('questions','survey','reference_number','type'));
    }
    public function student_answer(Request $request,$survey_id,$reference_number,$type){



        $survey= Survey::query()->findOrFail($survey_id);
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
                    StudentSurvey::query()->create([
                        'question_id'=> $q_id,
                        'answer_id'=>$x,
                        'student_id'=>\auth('students')->user()->id,
                        'survey_id'=>$survey_id,
                        'reference_number'=>$reference_number,
                        'type'=>$type

                    ]);
                }
            }
            elseif($question->type == 1){
                StudentSurvey::query()->create([
                    'question_id'=> $q_id,
                    'answer_id'=>$choice,
                    'student_id'=>\auth('students')->user()->id,
                    'survey_id'=>$survey_id,
                    'reference_number'=>$reference_number,
                    'type'=>$type

                ]);
            }
            else{
                StudentSurvey::query()->create([
                    'question_id'=> $q_id,
                    'answer'=>$choice,
                    'student_id'=>\auth('students')->user()->id,
                    'survey_id'=>$survey_id,
                    'reference_number'=>$reference_number,
                    'type'=>$type

                ]);
            }


        }
        toastr()->success('تم رفع الاجابات بنجاح');
        return redirect()->route('students_home');
    }
}
