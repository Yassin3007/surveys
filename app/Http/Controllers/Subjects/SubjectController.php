<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public $page = 10 ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::query()->orderBy('name')->paginate($this->page);
        $grades =Grade::all();
        $sections =Section::all();
        return view('admin.subjects.index',compact('subjects','grades','sections'));
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
        return $request ;
        $request->validate([
            'name'=>'required',
            'number'=>'required',
            'grade_id'=>'required',
            'section_id'=>'required',
            'stage'=>'required',
        ]);

        Subject::query()->create([
            'name'=>$request->name,
            'number'=>$request->number,
            'grade_id'=>$request->grade_id,
            'section_id'=>$request->section_id,
            'stage'=>$request->stage,
        ]);
        toastr()->success('تم تخزين البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'=>'required',
            'number'=>'required',
            'grade_id'=>'required',
            'section_id'=>'required',
            'stage'=>'required',
        ]);

        $subject->update([
            'name'=>$request->name,
            'number'=>$request->number,
            'grade_id'=>$request->grade_id,
            'section_id'=>$request->section_id,
            'stage'=>$request->stage,
        ]);
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        toastr()->error('تم الحذف بنجاح');
        return redirect()->back();
    }

    public function export(Request $request){
        $subjects = DB::table('tables')->distinct()->select('subject_name','subject_number','section','stage')->get();

        foreach ($subjects as $subject){

            Subject::query()->create([
                'name'=>$subject->subject_name,
                'number'=>$subject->subject_number,
                'section_id'=>Section::query()->where('name',$subject->section)->first()->id,
                'stage'=>$subject->stage,
                'grade_id'=>$request->grade_id

            ]);
        }



        toastr()->success('تم استيراد المواد بنجاح');
        return back();
    }

    public function x(Request $request){

        $attachments= Attachment::where('event_id',$id) ;

        if ( $request->first !=null){
            $attachments->where('first', 'like', '%' . $request->first . '%');
        }
        if ( $request->second !=null){
            $attachments->where('second', 'like', '%' . $request->second . '%');
        }
        if ( $request->third !=null){
            $attachments->where('third', 'like', '%' . $request->third . '%');
        }
        if ( $request->forth !=null){
            $attachments->where('forth', 'like', '%' . $request->forth . '%');
        }
        if ( $request->family !=null){
            $attachments ->where('family', 'like', '%' . $request->family . '%');
        }
        if ( $request->region !=null){
            $attachments->where('region', 'like', '%' . $request->region . '%');
        }


           $attachments->orderBy('name','ASC')->paginate($this->page);




    }
}
