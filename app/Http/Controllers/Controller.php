<?php

namespace App\Http\Controllers;

use App\Imports\MainTableImport;
use App\Imports\StudentsImport;
use App\Imports\StudentTableImport;
use App\Imports\TeachersImport;
use App\Models\MainTable;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentTable;
use App\Models\Subject;
use App\Models\Table;
use App\Models\Teacher;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function Symfony\Component\String\b;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function add_main_table(Request $request){

        try {

            DB::beginTransaction();

            $request->validate([
                'file'=>'required',
                'type'=>'required'
            ]);
            $file =$request->file ;
            $file->storeAs('' ,$file->getClientOriginalName(),'attach');

            if ($request->type == 0){

                Excel::import(new StudentsImport(),request()->file('file'));

                Student::query()->where('id_num','رقم السجل المدني')->delete();

            }elseif($request->type == 1){
                Excel::import(new TeachersImport(),request()->file('file'));

                Teacher::query()->where('name','اسم المدرب')->delete();

            }elseif($request->type == 2){
                Excel::import(new StudentTableImport(),request()->file('file'));
                StudentTable::query()->where('trainee_name','اسم المتدرب')->delete();
                $sections = DB::table('student_tables')->distinct()->pluck('section');
                foreach ($sections as $section){
                    Section::query()->create([
                        'name'=>$section
                    ]);
                }
            }elseif($request->type == 3){
                Excel::import(new MainTableImport(),request()->file('file'));
                MainTable::query()->where('trainer_name','المدرب')->delete();
            }



            DB::commit();

            toastr()->success('تم رفع الملف بنجاح');
            return redirect()->route('admin_home');

        }catch (\Exception $e){

            DB::rollBack();
            return redirect()->back();

        }


    }

    public function upload_file($type){
        return view('admin.attach',compact('type'));
    }

    public function delete_student_main_table(){
        $students = StudentTable::all();
        $sections = Section::all();
        foreach ($students as $student){
            $student->delete();
        }
        foreach ($sections as $section){
            $section->delete();
        }
        toastr()->warning('تم حذف جميع المتدربين بنجاح');
        return redirect()->back();
    }

    public function delete_main_table(){
        $data = MainTable::all();
        foreach ($data as $value){
            $value->delete();
        }
        toastr()->warning('تم حذف جميع المتدربين بنجاح');
        return redirect()->back();
    }

    public function admin_mode(){
        $user = auth()->user() ;
        if ($user->mode == 0){
            $user->mode = 1;
            $user->save();
        }else{
            $user->mode = 0;
            $user->save();
        }
        return back();
    }

    public function teacher_mode(){
        $user = auth('teachers')->user() ;
        if ($user->mode == 0){
            $user->mode = 1;
            $user->save();
        }else{
            $user->mode = 0;
            $user->save();
        }
        return back();
    }
    public function student_mode(){
        $user = auth('students')->user() ;
        if ($user->mode == 0){
            $user->mode = 1;
            $user->save();
        }else{
            $user->mode = 0;
            $user->save();
        }
        return back();
    }

    public function dowload_empty($type){

        if ($type==0){
            $filePath = public_path('excel/ملف فارغ بيانات الطلاب.xlsx');
        }elseif ($type==1){
            $filePath = public_path('excel/ملف فارغ بيانات المدرسين.xlsx');
        }elseif ($type==2){
            $filePath = public_path('excel/ملف فارغ جداول الطلاب.xlsx');
        }elseif ($type==3){
            $filePath = public_path('excel/ملف فارغ الجدول الشامل.xlsx');
        }



        return response()->download($filePath);
    }
}
