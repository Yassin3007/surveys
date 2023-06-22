@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">الرئيسية</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div style="text-align: center">
            <br>
            <br>
{{--                <img alt="user-img" width="150px;" height="100px" src="{{URL::asset('dist/img/logo.webp')}}">--}}

            <p style="font-size: 30px">
                استبانات المتدربين كليه الاتصالات والالكترونيات بجده
            </p>

        </div><!-- /.col -->
    <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{\App\Models\Teacher::count()}}</h3>

                                <p>عدد المدربين</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{\App\Models\Student::count()}}</h3>

                                <p>عدد الطلاب </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{\App\Models\Section::count()}}</h3>

                                <p>عدد الاقسام </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{\App\Models\Survey::where('for',0)->count()}}</h3>

                                <p>عدد استبيانات الطلاب</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{\App\Models\Survey::where('for',1)->count()}}</h3>

                                <p>عدد استبيانات المدربين </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{\App\Models\Survey::where('for',2)->count()}}</h3>

                                <p>عدد استبيانات الزوار</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <br>
                        <div class="card">
                            <div class="card-header " >

                                <h3 style="float: right" class="card-title  font-weight-bold">المرفقات</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>بيانات الطلاب </th>
                                        <th>بيانات المدربين</th>
                                        <th>جداول الطلاب</th>
                                        <th style="border-right-width: 2px !important;">الجدول الشامل </th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>

                                        <td>
                                            @if(\App\Models\Student::query()->count()>10)
                                                <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                <br>
                                                تم الرفع
                                            @else
                                                <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                <br>
                                                لم يتم الرفع
                                            @endif
                                        </td>
                                        <td>
                                            @if(\App\Models\Teacher::query()->count()>10)
                                                <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                <br>
                                                تم الرفع
                                            @else
                                                <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                <br>
                                                لم يتم الرفع
                                            @endif
                                        </td>
                                        <td>
                                            @if(\App\Models\StudentTable::query()->count()>10)
                                                <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                <br>
                                                تم الرفع
                                            @else
                                                <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                <br>
                                                لم يتم الرفع
                                            @endif
                                        </td>
                                        <td style="border-right-width: 2px !important;">
                                            @if(\App\Models\MainTable::query()->count()>10)
                                                <span style="color: green;font-size: 30px" class="fa fa-check-circle"></span>
                                                <br>
                                                تم الرفع
                                            @else
                                                <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                <br>
                                                لم يتم الرفع
                                            @endif
                                        </td>





                                    </tr>


                                    <tr>

                                        <td>
                                            @if(\App\Models\Student::query()->count()>10)
                                                <a href="{{route('delete_all_students')}}" class="btn btn-outline-danger" >
                                                    حذف
                                                </a>
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if(\App\Models\Teacher::query()->count()>10)
                                                <a href="{{route('delete_all_teachers')}}" class="btn btn-outline-danger" >
                                                    حذف
                                                </a>
                                            @else
                                               --
                                            @endif
                                        </td>
                                        <td>
                                            @if(\App\Models\StudentTable::query()->count()>10)
                                                <a href="{{route('delete_student_main_table')}}" class="btn btn-outline-danger" >
                                                    حذف
                                                </a>
                                            @else
                                               --
                                            @endif
                                        </td>
                                        <td style="border-right-width: 2px !important;">
                                            @if(\App\Models\MainTable::query()->count()>10)
                                                <a href="{{route('delete_main_table')}}" class="btn btn-outline-danger" >
                                                    حذف
                                                </a>
                                            @else
                                               --
                                            @endif
                                        </td>





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

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
{{--        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">--}}
{{--            اضافة البيانات الاساسية--}}
{{--        </a>--}}


            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                اضافة البيانات الاساسية
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('upload_file',0)}}">بيانات الطلاب</a>
                <a class="dropdown-item" href="{{route('upload_file',1)}}">بيانات المدرسين</a>
                <a class="dropdown-item" href="{{route('upload_file',2)}}">جداول الطلاب</a>
                <a class="dropdown-item" href="{{route('upload_file',3)}}">الجدول الشامل</a>

            </div>

{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="input1">القيمة الأولى</label>--}}
{{--                    <select class="form-control" id="input1">--}}
{{--                        <option>خيار 1</option>--}}
{{--                        <option>خيار 2</option>--}}
{{--                        <option>خيار 3</option>--}}
{{--                    </select>        </div>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="input2">القيمة الثانية</label>--}}
{{--                    <input type="text" class="form-control" id="input2" placeholder="أدخل القيمة الثانية">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-auto d-flex align-items-end">--}}
{{--                <button type="submit" class="btn btn-primary mb-2">تأكيد</button>--}}
{{--            </div>--}}
{{--        </div>--}}
    </footer>




    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">اضافة مرفق</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('add_main_table')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  اسم المرفق</label>
                                        <input type="file" class="form-control" name="file" id="input1">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1"> نوع المرفق </label>
                                        <select name="type" class="form-control" id="select1">


                                            <option disabled selected hidden="">----اختر----</option>
                                            <option value="0"> بيانات الطلاب </option>
                                            <option value="1"> بيانات المدرسين </option>
                                            <option value="2"> جداول الطلاب </option>
                                            <option value="3"> الجدول الشامل </option>






                                        </select>
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
