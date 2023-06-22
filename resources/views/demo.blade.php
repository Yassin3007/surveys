@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">شاشة المدربين </h1>
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


                        <br>
                        <div class="card">
                            <div class="card-header " >
                                <a  href="add_trainer.html" class="btn  btn-outline-primary ">اضافة مدرب</a>
                                <h3 class="card-title font-weight-bold">شاشة المدربين</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>رقم الجوال</th>
                                        <th>رقم الحاسب</th>
                                        <th>الخيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr>
                                        <td style="padding-right: 40px;">Presto</td>
                                        <td>Nokia N800</td>
                                        <td>N800</td>
                                        <td>-</td>
                                        <td>
                                            <a href="add_trainer.html" class="btn  btn-outline-warning">تعديل</a>
                                            <a href="trainer_details.html" class="btn  btn-outline-primary">تفاصيل</a>
                                            <button type="button" class="btn  btn-outline-danger">حذف</button>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 40px;">Presto</td>
                                        <td>Nokia N800</td>
                                        <td>N800</td>
                                        <td>-</td>
                                        <td>
                                            <a href="add_trainer.html" class="btn  btn-outline-warning">تعديل</a>
                                            <a href="trainer_details.html" class="btn  btn-outline-primary">تفاصيل</a>
                                            <button type="button" class="btn  btn-outline-danger">حذف</button>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 40px;">Presto</td>
                                        <td>Nokia N800</td>
                                        <td>N800</td>
                                        <td>-</td>
                                        <td>
                                            <a href="add_trainer.html" class="btn  btn-outline-warning">تعديل</a>
                                            <a href="trainer_details.html" class="btn  btn-outline-primary">تفاصيل</a>
                                            <button type="button" class="btn  btn-outline-danger">حذف</button>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 40px;">Presto</td>
                                        <td>Nokia N800</td>
                                        <td>N800</td>
                                        <td>-</td>
                                        <td>
                                            <a href="add_trainer.html" class="btn  btn-outline-warning">تعديل</a>
                                            <a href="trainer_details.html" class="btn  btn-outline-primary">تفاصيل</a>
                                            <button type="button" class="btn  btn-outline-danger">حذف</button>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 40px;">Presto</td>
                                        <td>Nokia N800</td>
                                        <td>N800</td>
                                        <td>-</td>
                                        <td>
                                            <a href="add_trainer.html" class="btn  btn-outline-warning">تعديل</a>
                                            <a href="trainer_details.html" class="btn  btn-outline-primary">تفاصيل</a>
                                            <button type="button" class="btn  btn-outline-danger">حذف</button>

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
        <button type="button" class="btn  btn-danger ">حذف جميع المدربين</button>

    </footer>
@endsection
