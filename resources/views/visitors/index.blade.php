@extends('layouts.visitors')
@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">شاشة الزوار </h1>
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

                                <h3 class="card-title  font-weight-bold">استبيانات الزوار </h3>
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

                                                    <span style="color: #9b1010;font-size: 30px" class="fa fa-link"></span>
                                                    <br>
                                                    <a href="{{route('visitor_survey',$survey->id)}}">
                                                        اكمل الاستبيان الان

                                                    </a>


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

    </div>
    <!-- /.content-wrapper -->
    <footer class="footer">

    </footer>
@endsection
