<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Imports\TeachersImport;
use App\Models\MainTable;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentSurvey;
use App\Models\StudentTable;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Survey;
use App\Models\Table;
use App\Models\Teacher;
use App\Models\TeacherSurvey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Cell;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;


class TeacherController extends Controller
{
    public $page = 20 ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::query()->paginate($this->page);
        $today = Carbon::now()->toDateString();

        $eng_survey = Survey::query()
            ->where('status',1)
            ->where('for',1)
            ->where('deleted_at',null)
            ->where('start','<=',$today)
            ->where('end','>',$today)->first();

        $type ='index';


        return view('admin.teachers.index',compact('teachers','eng_survey','type'));

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
            'email'=>'required|unique:teachers,email',
            'comp_num'=>'required',
        ]);

        Teacher::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'comp_num'=>$request->comp_num,
        ]);
        toastr()->success('تم اضافة المدرب بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:teachers,email,'.$teacher->id,
            'comp_num'=>'required',
        ]);
        $teacher->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'comp_num'=>$request->comp_num,
        ]);
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        toastr()->error('تم حذف المدرب بنجاح');
        return redirect()->back();
    }

    public function teacher_subjects($id){
        $teacher = Teacher::query()->findOrFail($id);

        $subjects = MainTable::query()->where('comp_num',$teacher->comp_num)->distinct()
            ->select('subject_name','subject_number','reference_number','type')->get();

//        $x = StudentTable::query()->where('trainer_name',$teacher->name)->distinct()->select(['subject_name','subject_number','section','stage'])->get();
//        foreach ($x as $data){
//            $section_id = Section::query()->where('name',$data->section)->first()->id ;
//            $sub = Subject::query()->where('number',$data->subject_number)
//                ->where('section_id',$section_id)
//                ->where('stage',$data->stage)->first();
//
//            SubjectTeacher::query()->updateOrCreate([
//                'teacher_id'=>$teacher->id ,
//                'subject_id'=>$sub->id
//            ]);
//        }




//        $subject_ids = SubjectTeacher::query()->where('teacher_id',$id)->pluck('subject_id')->toArray();
//        $subjects = $teacher->subjects ;
//        $all_subjects = Subject::all();

        $today = Carbon::now()->toDateString();

        $subject_survey = Survey::query()
            ->where('status',1)
            ->where('type',0)
            ->where('deleted_at',null)
            ->where('start','<=',$today)
            ->where('end','>',$today)->first();

        $teacher_survey = Survey::query()
            ->where('status',1)
            ->where('type',1)
            ->where('deleted_at',null)
            ->where('start','<=',$today)
            ->where('end','>',$today)->first();
        return view('admin.teachers.subjects',compact('subjects','teacher','subject_survey','teacher_survey'));

    }

    public function teacher_subjects_store(Request $request,$id){
        $teacher = Teacher::query()->findOrFail($id);
        $teacher->subjects()->detach();
        if ($request->subjects !=null){
            foreach ($request->subjects as $subject_id)
                SubjectTeacher::query()->create([
                    'teacher_id'=>$id,
                    'subject_id'=>$subject_id
                ]);
        }



        toastr()->success('تم تحديد المقررات بنجاح');
        return redirect()->back();

    }

    public function export(Request $request){
        $request->validate([
            'file'=>'required'
        ]);

        $file =$request->file ;
        $file->storeAs('' ,$file->getClientOriginalName(),'attach');


        Excel::import(new TeachersImport(),request()->file('file'));

        Teacher::query()->where('name','اسم المدرب')->delete();


        toastr()->success('تم رفع الملف بنجاح');
        return back();

    }

    public function subject_survey($reference_number){

        $students = StudentTable::query()->where('reference_number',$reference_number)->paginate($this->page);


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
        return view('admin.teachers.students',compact('students','subject_survey','teacher_survey'));
    }

    public function student_survey_answer($student_id ,$reference_number ,$type,$survey_id){

            $survey = Survey::query()->findOrFail($survey_id);



        $questions = $survey->questions;
        $student_survey_answers = StudentSurvey::query()->where('student_id',$student_id)
            ->where('reference_number',$reference_number)
            ->where('survey_id',$survey_id)->where('type',$type)->pluck('answer_id')->toArray();

        return view('admin.teachers.answers',compact('survey','questions','student_id','reference_number','type','student_survey_answers'));
    }

    public function delete_all_teachers(){
        $teachers = Teacher::all();
        foreach ($teachers as $teacher){
            $teacher->delete();
        }
        toastr()->error('تم حذف جميع المدربين بنجاح');
        return redirect()->back();
    }

    public function teacher_master_survey_answer($teacher_id  ,$survey_id){
        if (Survey::query()->find($survey_id)){
            $survey = Survey::query()->findOrFail($survey_id);

        }else{
            $survey = Survey::onlyTrashed()->where('id',$survey_id)->first();

        }

        $questions = $survey->questions;
        $teacher_survey_answers = TeacherSurvey::query()->where('teacher_id',$teacher_id)

            ->where('survey_id',$survey_id)->pluck('answer_id')->toArray();
        return view('admin.teachers.teacher_answers',compact('survey','questions','teacher_id','teacher_survey_answers'));
    }

    public function teachers_search(Request $request){
        $teachers = Teacher::query()
            ->where('name','like','%'.$request->name .'%')
            ->where('comp_num','like','%'.$request->comp_num .'%')->get();
        $today = Carbon::now()->toDateString();

        $eng_survey = Survey::query()
            ->where('status',1)
            ->where('for',1)
            ->where('deleted_at',null)
            ->where('start','<=',$today)
            ->where('end','>',$today)->first();

        $type = 'search';


        return view('admin.teachers.index',compact('teachers','eng_survey','type'));



    }

    public function teacher_resit($id){

        $teacher = Teacher::query()->findOrFail($id);
        $teacher->password = Hash::make($teacher->comp_num) ;
        $teacher->save();

        toastr()->success('تم اعادة تعيين كلمة السر بنجاح');
        return redirect()->back();

    }

    public function teachers_table_export(){

        $teachers = Teacher::query()->get();
        foreach ($teachers as $teacher){

            $x = Table::query()->where('trainer_name',$teacher->name)->distinct()->select(['subject_name','subject_number','section','stage'])->get();



            foreach ($x as $data){
                $section_id = Section::query()->where('name',$data->section)->first()->id ;
                $sub = Subject::query()->where('number',$data->subject_number)
                    ->where('section_id',$section_id)
                    ->where('stage',$data->stage)->first();

                SubjectTeacher::query()->updateOrCreate([
                    'teacher_id'=>$teacher->id ,
                    'subject_id'=>$sub->id
                ]);





            }

        }
        toastr()->success('تم استيراد البيانات بنجاح');

        return redirect()-> back();
    }
}
