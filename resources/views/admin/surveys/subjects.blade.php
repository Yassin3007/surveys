@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">مقررات الاستبيان  </h1>
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
                                        <th>اسم المادة</th>
                                        <th>رقم المقرر</th>
                                        <th>عدد الطلاب المسجلين للمقرر</th>
                                        <th>عدد المقيمين للمقرر</th>
                                        <th>الخيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->number}}</td>
                                            <td>
                                                {{\App\Models\Table::query()->where('subject_number',$subject->number)
                                                  ->where('trainer_name',$subject->teachers[0]->name)->pluck('trainee_number')->count()}}
                                            </td>
                                            <td>
{{--                                                @if($survey  != null)--}}
                                                    {{\App\Models\StudentSurvey::query()->where('survey_id',$survey->id)->where('subject_id',$subject->id)->distinct()->pluck('student_id')->count()}}

{{--                                                @else--}}
{{--                                                    لا يوجد تقييمات في الوقت الحالي--}}
{{--                                                @endif--}}
                                            </td>

                                            <td>

                                                <a href="{{route('archeive_subject_survey',['subject_id'=>$subject->id,'survey_id'=>$survey->id])}}" class="btn  btn-outline-primary">عرض التقييمات</a>


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
            <div class="pagination-wrapper">
                {{ $subjects->onEachSide(0)->links() }}
            </div>
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

    </footer>

@endsection
