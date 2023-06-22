<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'question'=>'required',
            'type'=>'required',

        ]);
        $question = Question::query()->create([
            'question'=>$request->question,
            'type'=>$request->type,
            'survey_id'=>$request->survey_id,
        ]);
        foreach ($request->answers as $answer){
            if ($answer !=null){
                Answer::query()->create([
                    'answer'=>$answer,

                    'question_id'=>$question->id
                ]);
            }
        }

        toastr()->success('تم اضافة السؤال بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $survey = Survey::findOrFail($id);
         $questions =$survey->questions;


         return view('admin.questions.index',compact('questions','survey'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $answers = $question->answers ;
        $request->validate([
            'question'=>'required',
            'type'=>'required',

        ]);
        $question->answers()->delete();
        $question->update([
            'question'=>$request->question,
            'type'=>$request->type,

        ]);
        foreach ($request->answers as $answer){
            if ($answer !=null){
                Answer::query()->create([
                    'answer'=>$answer,

                    'question_id'=>$question->id
                ]);
            }
        }
        toastr()->success('تم تعديل السؤال بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        toastr()->error('تم حذف السؤال بنجاح');
        return back();
    }

    public function add_answer(Request $request ,$id){
        $request->validate([
            'answer'=>'required'
        ]);
        Answer::query()->create([
            'answer'=>$request->answer,

            'question_id'=>$id
        ]);
        toastr()->success('تم اضافة الاجابة  بنجاح');
        return back();
    }


}
