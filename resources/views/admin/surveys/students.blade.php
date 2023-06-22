@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">{{$subject->name}} </h1>
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


{{--                                <h3 class="card-title font-weight-bold">شاشة المدربين</h3>--}}
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>اسم الطالب</th>

                                        <th>حالة تقييم المادة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$student->name}}</td>

                                            <td >
                                                @if($subject_survey ==null)
                                                    لا يوجد استبيانات للمقررات في الوقت الحالي
                                                @else
                                                    @if(\App\Models\StudentSurvey::query()->where('student_id',$student->id)
                                                          ->where('survey_id',$subject_survey->id)->where('subject_id',$subject->id)->first())
                                                        <a href="{{route('student_survey_answer',['student_id'=>$student->id,'subject_id'=>$subject->id,'survey_id'=>$subject_survey->id])}}">
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
            <div class="pagination-wrapper">
                {{ $students->onEachSide(0)->links() }}
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

    </footer>

@endsection
