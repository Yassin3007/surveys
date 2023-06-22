@extends('layouts.students')
@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">شاشة المتدربين </h1>
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-header " >
                                <h3 style="float: right" class="card-title"> البيانات الاساسية </h3>
                                <a style="float: left" href="{{route('student_mode')}}" class="btn btn-primary" >
                                    @if(auth('students')->user()->mode == 0)
                                        Dark Mode

                                    @else
                                        Light Mode
                                    @endif
                                </a>
                            </div>



                            <!-- /.card-header -->
                            <div class="card-body" style="overflow: hidden;">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>رقم الهوية </th>
                                        <th>رقم المتدرب</th>

                                        <th>التخصص</th>
                                        <th>المرحلة</th>
{{--                                        <th>الفصل الدراسي</th>--}}
{{--                                        <th>البرنامج</th>--}}

                                    </tr>
                                    </thead>
                                    <tbody>




                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->id_num}}</td>
                                        <td>{{$user->number}}</td>
                                        <td>{{\App\Models\StudentTable::query()->where('trainee_number',$user->number)->first()->section}}</td>
                                        <td>
                                            @if($user->stage == 1)
                                                دبلوم
                                            @elseif($user->stage == 2)
                                                بكالوريوس
                                            @endif
                                        </td>
{{--                                        <td>--}}
{{--                                            @if($user->grade_id == 1)--}}
{{--                                                الترم الاول--}}
{{--                                            @elseif($user->grade_id == 2)--}}
{{--                                                الترم الثانى--}}
{{--                                            @elseif($user->grade_id == 3)--}}
{{--                                                الترم الثالث--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td>{{$user->}}</td>--}}

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
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title"> المقررات المسجلة للطالب</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow: hidden;">
                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                    <tr >
                                        <th>اسم المقرر</th>
                                        <th>نوع الشعبة </th>

                                        <th>الرقم المرجعي </th>
                                        <th> اسم المدرب</th>
                                        <th>تقييم المقرر </th>
                                        <th>تقييم المدرب</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{$subject->subject_name}}</td>
                                            <td>{{$subject->type}}</td>

                                            <td>{{$subject->reference_number}}</td>
                                            <td>{{\App\Models\Teacher::query()->where('comp_num',$subject->comp_num)->first()->name  }}</td>

                                            <td>
                                                @if($subject_survey != null)
                                                    @if(\App\Models\StudentSurvey::query()->where('student_id',auth()->user()->id)->where('survey_id',$subject_survey->id)->where('reference_number',$subject->reference_number)->where('type',0)->first() )
                                                        <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                        <br>
                                                        تم التقييم
                                                    @else
                                                        <a style="color: green" href="{{route('student_survey',['id'=>$subject_survey->id,'reference_number'=>$subject->reference_number,'type'=>0])}}">
                                                            <span style="color: #9b1010;font-size: 30px" class="fa fa-link"></span>
                                                            <br>
                                                            اكمل الاستبيان الان

                                                        </a>

                                                    @endif
                                                @else
                                                    لا يوجد استبيانات ف الوقت الحالي
                                                @endif

                                            </td>

                                            <td>
                                                @if($teacher_survey != null)
                                                    @if(\App\Models\StudentSurvey::query()->where('student_id',auth()->user()->id)->where('survey_id',$teacher_survey->id)->where('reference_number',$subject->reference_number)->where('type',1)->first() )
                                                        <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                        <br>
                                                        تم التقييم
                                                    @else
                                                        <a style="color: green" href="{{route('student_survey',['id'=>$teacher_survey->id,'reference_number'=>$subject->reference_number,'type'=>1])}}">
                                                            <span style="color: #9b1010;font-size: 30px" class="fa fa-link"></span>
                                                            <br>
                                                            اكمل الاستبيان الان

                                                        </a>

                                                    @endif
                                                @else
                                                    لا يوجد استبيانات ف الوقت الحالي
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

    </div>
    <!-- /.content-wrapper -->
    <footer class="footer">

    </footer>
@endsection
