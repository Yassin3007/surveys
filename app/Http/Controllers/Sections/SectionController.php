<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public $page = 10 ;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::query()->paginate($this->page);
        return view('admin.sections.index',compact('sections'));
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
            'name'=>'required|unique:sections,name',

        ]);

        Section::query()->create([
            'name'=>$request->name,

        ]);
        toastr()->success('تم تخزين البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name'=>'required|unique:sections,name,'.$section->id,
        ]);
        $section->update([
            'name'=>$request->name,
        ]);
        toastr()->success('تم تعديل البيانات بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        toastr()->error('تم حذف القسم بنجاح');
        return redirect()->back();
    }

    public function export(){

        $sections = DB::table('tables')->distinct()->pluck('section');
        foreach ($sections as $section){
              Section::query()->create([
                'name'=>$section
               ]);
            }

        toastr()->success('تم استيراد الاقسام بنجاح');
        return back();

    }
}
