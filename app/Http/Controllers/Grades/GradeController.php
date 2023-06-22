<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public $page = 10 ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::query()->paginate($this->page);
        return view('admin.grades.index',compact('grades'));
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
            'name'=>'required'
        ]);
        Grade::query()->create([
            'name'=>$request->name
        ]);
        toastr()->success('تم اضافة الصف بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $grade->update([
            'name'=>$request->name
        ]);
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {

        $grade->delete();
        toastr()->error('تم الحذف بنجاح');
        return redirect()->back();
    }
}
