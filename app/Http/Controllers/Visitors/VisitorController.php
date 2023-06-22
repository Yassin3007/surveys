<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\StudentSurvey;
use App\Models\Survey;
use App\Models\Visitor;
use App\Models\VisitorSurvey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public $page= 10;
    public function index(){
        $surveys = Survey::query()->where('for',2)->get();
        return view('visitors.index',compact('surveys'));
    }

    public function visitor_survey($survey_id){
        $survey = Survey::query()->findOrFail($survey_id);
        $questions= $survey->questions;
        return view('visitors.survey',compact('survey','questions'));
    }
    public function visitor_answer(Request $request ,$survey_id){

        DB::beginTransaction();
        $survey= Survey::query()->findOrFail($survey_id);

        $questions  = $survey->questions ;
        foreach ($questions  as $question){
            $request->validate([
                'name'=>'required',
                'question_'.$question->id => 'required'
            ],[
                'required'=>'برجاء الاجابة علي كافة الاسئلة',
                'name.required'=>'برجاء ادخال الاسم '
            ]);
        }

        $visitor = Visitor::query()->create([
            'name'=>$request->name
        ]);

        $answers = $request->except('_token','name');
        foreach ($answers as $questionId => $choice) {
            $q_id = str_replace('question_', "", $questionId);

            $question = Question::query()->findOrFail($q_id);

            if ($question->type == 2){
                foreach ($choice as $x){
                    VisitorSurvey::query()->create([
                        'question_id'=> $q_id,
                        'answer_id'=>$x,
                        'visitor_id'=>$visitor->id ,
                        'survey_id'=>$survey_id,


                    ]);
                }
            }
            elseif($question->type == 1){
                VisitorSurvey::query()->create([
                    'question_id'=> $q_id,
                    'answer_id'=>$choice,
                    'visitor_id'=>$visitor->id,
                    'survey_id'=>$survey_id,


                ]);
            }
            else{
                VisitorSurvey::query()->create([
                    'question_id'=> $q_id,
                    'answer'=>$choice,
                    'visitor_id'=>$visitor->id,
                    'survey_id'=>$survey_id,


                ]);
            }


        }
        DB::commit();
        toastr()->success('تم رفع الاجابات بنجاح');
        return redirect()->route('selection');
    }

    public function surveys_visitor_index(){
        $surveys = Survey::query()->where('for',2)->paginate($this->page);
        $today = Carbon::now()->toDateString();

        return view('admin.surveys.visitors',compact('surveys','today'));
    }

    public function show_visitors_survey($id){
        $survey = Survey::query()->findOrFail($id);
        $visitor_ids = VisitorSurvey::query()->where('survey_id',$survey->id)->distinct()->pluck('visitor_id');
        return view('admin.surveys.visitor_name',compact('visitor_ids','survey'));

    }

    public function visitor_answer_final($visitor_id ,$survey_id){

//        $survey = Survey::query()->findOrFail($survey_id);

        if (Survey::query()->find($survey_id)){
            $survey = Survey::query()->findOrFail($survey_id);

        }else{
            $survey = Survey::onlyTrashed()->where('id',$survey_id)->first();

        }
        $questions = $survey->questions;
        $visitor_survey_answer = VisitorSurvey::query()->where('survey_id',$survey_id)
            ->where('visitor_id',$visitor_id)
            ->pluck('answer_id')->toArray();

        return view('admin.surveys.answers',compact('survey','visitor_id','questions','visitor_survey_answer'));


    }
}
