@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">استبيانات الزوار   </h1>
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



                        <div class="card">

                            <div class="card-header" >

                                {{--                            <h3 class="card-title">نماذج التقييم </h3>--}}
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">



                            <table id="example3" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th>م </th>
                                    <th>اسم النموذج</th>
                                    <th> نوع النموذج</th>
                                    <th>موجه الى  </th>
                                    <th>يبدا في   </th>
                                    <th>ينتهي في  </th>
                                    <th>نشط  </th>
                                    <th>خيارات</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($surveys as $survey)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$survey->name}}</td>
                                        <td>
                                            @if($survey->type==0)
                                                تقييم مقرر
                                            @elseif($survey->type==1)
                                                تقييم مدرب
                                            @elseif($survey->type==2)
                                                غير ذلك
                                            @endif

                                        </td>
                                        <td>
                                            @if($survey->for==0)
                                                طلاب
                                            @elseif($survey->for==1)
                                                مهندسين
                                            @elseif($survey->for==2)
                                                زوار

                                            @endif
                                        </td>
                                        <td>{{$survey->start}}</td>
                                        <td>{{$survey->end}}</td>

                                        <td>
                                            @if($survey->end < $today ||$survey->start >$today)
                                                <span class="badge badge-warning">منتهي الصلاحية</span></td>


                                           @elseif($survey->status == 1)
                                                <span class="badge badge-success">نعم</span></td>

                                            @elseif($survey->status == 0)
                                            <span class="badge badge-danger">لا</span></td>

                                            @endif

                                        <td>

                                            <a href="{{route('show_visitors_survey',$survey->id)}}" class="btn  btn-outline-primary">عرض التقييمات</a>

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
                {{ $surveys->onEachSide(0)->links() }}
            </div>
    </section>
    <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">



    </footer>



@endsection
