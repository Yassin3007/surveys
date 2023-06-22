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
                                    <th>الاسم </th>

                                    <th>خيارات</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visitor_ids as $id)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{\App\Models\Visitor::query()->findOrFail($id)->name}}</td>

                                        <td>

                                            <a href="{{route('visitor_answer_final',['visitor_id'=>$id,'survey_id'=>$survey->id])}}" class="btn  btn-success">اجابات الاستبيان </a>

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
    <footer class="main-footer">



    </footer>



@endsection
