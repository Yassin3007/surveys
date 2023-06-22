@extends('layouts.teachers')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper teacher" >
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">الرئيسية  </h1>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#info">
                            تعديل البيانات الشخصية
                        </button>

                        <br>
                        <br>
                        <div class="card">
                            <div class="card-header " >


                                <a style="float: left" href="{{route('teacher_mode')}}" class="btn btn-primary" >
                                    @if(auth('teachers')->user()->mode == 0)
                                        Dark Mode

                                    @else
                                        Light Mode
                                    @endif
                                </a>

                                <h3 style="float: right" class="card-title  font-weight-bold">البيانات الرئيسية</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>الاسم </th>
                                        <th>رقم الحاسب</th>
                                        <th>البريد الالكتروني</th>
                                        <th>رقم الهاتف </th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>

                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->comp_num}}</td>
                                            <td>{{$teacher->email}}</td>
                                            <td>{{$teacher->phone}}</td>




                                        </tr>









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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <br>
                        <div class="card">
                            <div class="card-header d-flex " >
                                {{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">--}}
                                {{--                                    تحديد المقررات--}}
                                {{--                                </button>--}}

                                <h3 class="card-title  font-weight-bold">الاستبيانات </h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>اسم الاستبيان </th>
                                        <th>الحالة </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($surveys as  $survey)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$survey->name}}</td>
                                            <td>
                                                @if($survey->Teacher_answers->where('teacher_id',auth('teachers')->user()->id)->first())
                                                    <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                    <br>
                                                    تم التقييم
                                                @else
                                                    <span style="color: #9b1010;font-size: 30px" class="fa fa-link"></span>
                                                    <br>
                                                <a style="color: green" href="{{route('teacher_survey',$survey->id)}}">
                                                    اكمل الاستبيان الان

                                                </a>
                                                @endif

                                            </td>

                                        </tr>





                                    @endforeach



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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <br>
                        <div class="card">
                            <div class="card-header d-flex " >
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">--}}
{{--                                    تحديد المقررات--}}
{{--                                </button>--}}

                                                                <h3 class="card-title  font-weight-bold">مقررات المدرب</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>اسم المادة</th>
                                        <th> نوع الشعبة</th>

                                        <th> الرقم المرجعي</th>
                                        <th>القسم</th>
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
                                            <td>{{\App\Models\StudentTable::query()->where('reference_number',$subject->reference_number)->first()->section}}</td>

                                            <td>
                                                {{\App\Models\StudentTable::query()->where('reference_number',$subject->reference_number)
                                                  ->distinct()->count()}}
                                            </td>

{{--                                            <td>--}}
{{--                                                {{\App\Models\Student::query()->where('section_id',$subject->section_id)--}}
{{--                                                   ->where('grade_id',$subject->grade_id)->count()}}--}}
{{--                                            </td>--}}
                                            <td>
                                                @if($subject_survey!=null  )
                                                    {{\App\Models\StudentSurvey::query()->where('survey_id',$subject_survey->id)->where('reference_number',$subject->reference_number)->where('type',0)->distinct()->pluck('student_id')->count()}}

                                                @else
                                                    <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                    <br>
                                                    لايوجد استبيانات في الوقت الحالي

                                                @endif
                                            </td>
                                            <td>
                                                @if($teacher_survey !=null)
                                                    {{\App\Models\StudentSurvey::query()->where('survey_id',$teacher_survey->id)->where('reference_number',$subject->reference_number)->where('type',1)->distinct()->pluck('student_id')->count()}}
                                                @else
                                                    <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                    <br>
                                                    لايوجد استبيانات في الوقت الحالي
                                                @endif

                                            </td>
                                            <td>

                                                <a href="{{route('students_subject_survey',$subject->reference_number)}}" class="btn  btn-outline-primary">عرض التقييمات</a>


                                            </td>
                                        </tr>





                                    @endforeach



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
    <footer class="main-footer teacher" >

    </footer>


    <div class="modal fade" id="info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">البيانات الشخصية  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('update_teacher_info')}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاسم </label>
                                        <input type="text" class="form-control" name="name" value="{{$teacher->name}}" id="input1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  البريد الالكتروني </label>
                                        <input type="text" class="form-control" name="email" value="{{$teacher->email}}" id="input1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  رقم الهاتف  </label>
                                        <input type="text" class="form-control" name="phone" value="{{$teacher->phone}}" id="input1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  تعيين كلمة سر جديدة </label>
                                        <input type="text" class="form-control" name="password" id="input1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">تأكيد</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>

@endsection
