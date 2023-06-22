<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Imports\TeachersImport;
use App\Models\Grade;
use App\Models\MainTable;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Subject;
use App\Models\Survey;
use App\Models\Table;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public $page = 10 ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students= Student::query()->paginate($this->page);
        $grades =Grade::all();
        $sections =Section::all();
        $type ='index';

        return view('admin.students.index',compact('students','grades','sections','type'));

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
            'id_num'=>'required|unique:students,id_num',
            'number'=>'required',
            'phone'=>'required',
            'grade_id'=>'required',
            'section_id'=>'required',
            'status'=>'required',
            'stage'=>'required',
        ]);
        Student::query()->create([
            'name'=>$request->name,
            'id_num'=>$request->id_num,
            'password'=>bcrypt($request->id_num),
            'number'=>$request->number,
            'phone'=>$request->phone,
            'grade_id'=>$request->grade_id,
            'section_id'=>$request->section_id,
            'status'=>$request->status,
            'stage'=>$request->stage,
        ]);
        toastr()->success('تم تخزين البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'=>'required',
            'id_num'=>'required|unique:students,id_num,'.$student->id,
            'number'=>'required',
            'grade_id'=>'required',
            'section_id'=>'required',
            'status'=>'required',
            'stage'=>'required',
        ]);
        $student->update([
            'name'=>$request->name,
            'id_num'=>$request->id_num,
            'number'=>$request->number,
            'phone'=>$request->phone,
            'grade_id'=>$request->grade_id,
            'section_id'=>$request->section_id,
            'status'=>$request->status,
            'stage'=>$request->stage,
        ]);
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        toastr()->success('تم حذف الطالب بنجاح');
        return redirect()->back();
    }


    public function export(Request $request){


        $students = DB::table('tables')->distinct()->select('trainee_name','trainee_number','stage','section')->get();
        foreach ($students as $student){

            Student::query()->create([
                'name'=>$student->trainee_name,
                'number'=>$student->trainee_number,
                'stage'=>$student->stage ,
                'section_id'=>Section::query()->where('name',$student->section)->first()->id,
                'grade_id'=>$request->grade_id

            ]);
        }
        toastr()->success('تم استيراد البيانات بنجاح');
        return back();

    }

    public function students_id_export(Request $request){
        $request->validate([
            'file'=>'required'
        ]);

        $file =$request->file ;
        $file->storeAs('' ,$file->getClientOriginalName(),'attach');


        Excel::import(new StudentsImport(),request()->file('file'));

        Student::query()->where('id_num','رقم السجل المدني')->delete();

        $students_data = StudentTable::query()->get();
        foreach ($students_data as $data) {
            Student::query()->where('number',$data->number)->update([
                'id_num'=>$data->id_num
            ]);



        }

        toastr()->success('تم استيراد البيانات بنجاح');
        return back();
    }


    public function student_subjects($id){
        $student = Student::query()->findOrFail($id);
        $reference_numbers= StudentTable::query()->where('trainee_number',$student->number)->pluck('reference_number');


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



        return view('admin.students.subjects',compact('subjects','student','subject_survey','teacher_survey','today'));
    }

    public function students_search(Request $request ){

        $students = Student::query()
            ->where('name','like','%'.$request->name .'%')
            ->where('number','like','%'.$request->number .'%')->get();

        $grades =Grade::all();
        $sections =Section::all();
        $type = 'search';
        return view('admin.students.index',compact('students','grades','sections','type'));

    }

    public function delete_all_students(){
        $students = Student::all();
        foreach ($students as $student){
            $student->delete();
        }
        toastr()->warning('تم حذف جميع المتدربين بنجاح');
        return redirect()->back();
    }



}
