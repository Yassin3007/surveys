@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">مقررات الطالب :  {{$student->name}}  </h1>
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

                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>اسم المقرر</th>
                                        <th>نوع الشعبة </th>

                                        <th>الرقم المرجعي </th>
                                        <th>حالة تقييم المادة</th>
                                        <th>حالة تقييم المدرب</th>
                                        <th> اسم المدرب</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$subject->subject_name}}</td>
                                            <td>{{$subject->type}}</td>

                                            <td>{{$subject->reference_number}}</td>
                                            <td >
                                                @if($subject_survey ==null)
                                                    لا يوجد استبيانات للمقررات في الوقت الحالي
                                                @else
                                                    @if(\App\Models\StudentSurvey::query()->where('student_id',$student->id)
                                                          ->where('survey_id',$subject_survey->id)->where('reference_number',$subject->reference_number)->where('type',0)->first())
                                                        <a href="{{route('student_survey_answer',['student_id'=>$student->id,'reference_number'=>$subject->reference_number,'type'=>0,'survey_id'=>$subject_survey])}}">
                                                            <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                            <br>
                                                            تم التقييم
                                                        </a>

                                                    @else
                                                        <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                        <br>
                                                        لم يتم التقييم
                                                    @endif
                                                @endif
                                            </td>


                                            <td>
                                                @if($teacher_survey ==null)

                                                    لا يوجد استبيانات للمدربين في الوقت الحالي
                                                @else
                                                    @if(\App\Models\StudentSurvey::query()->where('student_id',$student->id)
                                                          ->where('survey_id',$teacher_survey->id)->where('reference_number',$subject->reference_number)->where('type',1)->first())
                                                        <a href="{{route('student_survey_answer',['student_id'=>$student->id,'reference_number'=>$subject->reference_number,'type'=>1,'survey_id'=>$teacher_survey])}}">
                                                            <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                            <br>
                                                            تم التقييم
                                                        </a>
                                                    @else
                                                        <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                        <br>
                                                        لم يتم التقييم
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{\App\Models\Teacher::query()->where('comp_num',$subject->comp_num)->first()->name  }}</td>

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
    <footer class="main-footer">
{{--        <button type="button" class="btn  btn-danger ">حذف جميع المدربين</button>--}}

    </footer>



@endsection
