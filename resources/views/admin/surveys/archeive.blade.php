@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">الارشيف   </h1>
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

                                            <a href="{{route('restore',$survey->id)}}" class="btn  btn-outline-success" >استعادة</a>
                                            <a href="{{route('survey_archeive_details',$survey->id)}}" class="btn  btn-outline-primary">تفاصيل</a>
                                            <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$survey->id}}">
                                                حذف
                                            </a>
                                        </td>
                                    </tr>


                                    <div class="modal fade" id="delete{{$survey->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">هل انت متاكد من عملية الحذف</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form method="post" action="{{route('final_delete_survey',$survey)}}">
                                                            @csrf


                                                            <div class="row">
                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-danger">تأكيد</button>
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
