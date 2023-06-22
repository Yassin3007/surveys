@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">مقررات المدرب  </h1>
                    </div>

                    <!-- /.col -->
                    <!-- <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">شاشة المدربين</li>
                      </ol>
                    </div>/.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <br>
                        <div class="card">
                            <div class="card-header " >
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">--}}
{{--                                    تحديد المقررات--}}
{{--                                </button>--}}

{{--                                <h3 class="card-title font-weight-bold">شاشة المدربين</h3>--}}
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>اسم المادة</th>
                                        <th> نوع الشعبة</th>

                                        <th>الرقم المرجعي</th>
                                        <th>عدد الطلاب المسجلين للمقرر</th>
                                        <th>عدد المقيمين للمقرر</th>
                                        <th>عدد المقيمين للمدرب</th>
                                        <th>الخيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$subject->subject_name}}</td>
                                            <td>{{$subject->type}}</td>

                                            <td>{{$subject->reference_number}}</td>
                                            <td>
                                                {{\App\Models\StudentTable::query()->where('reference_number',$subject->reference_number)
                                                  ->distinct()->count()}}
                                            </td>
{{--                                            <td>--}}
{{--                                                {{\App\Models\Student::query()->where('section_id',$subject->section_id)--}}
{{--                                                   ->where('grade_id',$subject->grade_id)->count()}}--}}
{{--                                            </td>--}}
                                            <td>
                                                @if($subject_survey != null)
                                                    {{\App\Models\StudentSurvey::query()->where('survey_id',$subject_survey->id)->where('reference_number',$subject->reference_number)->where('type',0)->distinct()->pluck('student_id')->count()}}

                                                @else
                                                    لا يوجد تقييمات في الوقت الحالي
                                                @endif
                                            </td>
                                            <td>
                                                @if($teacher_survey != null)
                                                {{\App\Models\StudentSurvey::query()->where('survey_id',$teacher_survey->id)->where('reference_number',$subject->reference_number)->where('type',1)->distinct()->pluck('student_id')->count()}}
                                                @else
                                                    لا يوجد تقييمات في الوقت الحالي
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{route('subject_survey',$subject->reference_number)}}" class="btn  btn-outline-primary">عرض التقييمات</a>


                                            </td>
                                        </tr>

                                    @endforeach






{{--                                    @foreach($subjects as $subject)--}}
{{--                                        <tr>--}}
{{--                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>--}}
{{--                                            <td>{{$subject->name}}</td>--}}
{{--                                            <td>{{$subject->number}}</td>--}}
{{--                                            <td>--}}
{{--                                                {{\App\Models\Student::query()->where('section_id',$subject->section_id)--}}
{{--                                                   ->where('grade_id',$subject->grade_id)->count()}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($subject_survey != null)--}}
{{--                                                    {{\App\Models\StudentSurvey::query()->where('survey_id',$subject_survey->id)->where('subject_id',$subject->id)->distinct()->pluck('student_id')->count()}}--}}

{{--                                                @else--}}
{{--                                                    لا يوجد تقييمات في الوقت الحالي--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($teacher_survey != null)--}}
{{--                                                    {{\App\Models\StudentSurvey::query()->where('survey_id',$teacher_survey->id)->where('subject_id',$subject->id)->distinct()->pluck('student_id')->count()}}--}}
{{--                                                @else--}}
{{--                                                    لا يوجد تقييمات في الوقت الحالي--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>--}}

{{--                                                <a href="{{route('subject_survey',$subject->id)}}" class="btn  btn-outline-primary">عرض التقييمات</a>--}}


{{--                                            </td>--}}
{{--                                        </tr>--}}

{{--                                    @endforeach--}}




                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

    </footer>

{{--    <div class="modal fade" id="modal-default">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title">تحديد المقررات </h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="container">--}}
{{--                        <form method="post" action="{{route('teacher_subjects_store',$teacher->id)}}">--}}
{{--                            @csrf--}}
{{--                            @foreach($all_subjects as $subject)--}}
{{--                                <div--}}
{{--                                    @if(\App\Models\SubjectTeacher::query()->whereIn('subject_id',array($subject->id) )->first()--}}
{{--                                              && !\App\Models\SubjectTeacher::query()->where('subject_id',$subject->id )->where('teacher_id',$teacher->id)->first()--}}
{{--                                                   )--}}
{{--                                        hidden--}}
{{--                                    @endif--}}
{{--                                    class="row" style="padding: 10px">--}}
{{--                                    <div class="col">--}}
{{--                                        <div class="form-check" >--}}
{{--                                            <input class="form-check-input" name="subjects[]"--}}

{{--                                                   @if(in_array($subject->id,$subject_ids)) checked @endif--}}
{{--                                                   type="checkbox" value="{{$subject->id}}" id="checkbox1">--}}
{{--                                            <label class="form-check-label" for="checkbox1">--}}
{{--                                                {{$subject->name}} - {{$subject->section->name}}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

{{--                            <br>--}}



{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <button type="submit" class="btn btn-primary">تأكيد</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.modal-content -->--}}
{{--            </div>--}}
{{--            <!-- /.modal-dialog -->--}}
{{--        </div>--}}
{{--        <!-- /.modal -->--}}

{{--    </div>--}}
@endsection
