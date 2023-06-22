@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">شاشة المدربين </h1>
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
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">--}}
{{--                                    اضافة مدرب--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#excel">--}}
{{--                                    استيراد--}}
{{--                                </button>--}}
{{--                                <a href="{{route('teachers_table_export')}}"  class="btn btn-primary" >--}}
{{--                                    رفع الجدول--}}
{{--                                </a>--}}
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#search">
                                    بحث<i class="fa fa-search"></i>
                                </button>
{{--                                <h3 class="card-title font-weight-bold">شاشة المدربين</h3>--}}
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>الاسم</th>
                                        <th>رقم الحاسب</th>
                                        <th>البريد الالكتروني</th>
                                        <th>رقم الجوال</th>
                                        <th>الاستبيان</th>
                                        <th>الخيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->comp_num}}</td>


                                            <td>{{$teacher->email}}</td>
                                            <td>{{$teacher->phone}}</td>
                                            <td>
                                                @if($eng_survey == null)
                                                    لا يوجد استبيانات للمهندسين في الوقت الحالي
                                                @else
                                                    @if(\App\Models\TeacherSurvey::query()
                                                       ->where('survey_id',$eng_survey->id)
                                                       ->where('teacher_id',$teacher->id)->first() )
                                                        <a href="{{route('teacher_master_survey_answer',['teacher_id'=>$teacher->id,'survey_id'=>$eng_survey->id])}}">
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
{{--                                                <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-default{{$teacher->id}}">--}}
{{--                                                    تعديل--}}
{{--                                                </a>--}}
                                                <a href="{{route('teacher_subjects',$teacher->id)}}" class="btn  btn-outline-primary">تفاصيل</a>

                                                <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$teacher->id}}">
                                                    حذف
                                                </a>
                                                <a href="{{route('teacher_resit',$teacher->id)}}" class="btn  btn-outline-warning">استعادة</a>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-default{{$teacher->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">تعديل بيانات {{$teacher->name}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <form method="post" action="{{route('teachers.update',$teacher)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  الاسم  </label>
                                                                            <input type="text" name="name" value="{{$teacher->name}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  رقم الهاتف  </label>
                                                                            <input type="text" name="phone" value="{{$teacher->phone}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  البريد الالكتروني  </label>
                                                                            <input type="text" name="email" value="{{$teacher->email}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  رقم الحاسب  </label>
                                                                            <input type="text" name="comp_num" value="{{$teacher->comp_num}}" class="form-control" id="input1">
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

                                        <div class="modal fade" id="delete{{$teacher->id}}">
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
                                                            <form method="post" action="{{route('teachers.destroy',$teacher)}}">
                                                                @csrf
                                                                @method('delete')


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
            @if($type!='search')
                <div class="pagination-wrapper">
                    {{ $teachers->onEachSide(0)->links() }}
                </div>
            @endif


        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-all">
            حذف جميع المدربين
        </button>
    </footer>

    <div class="modal fade" id="delete-all">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">هل انت متاكد من حذف جميع المدربين ؟</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">


                            <div class="row">
                                <div class="col">
                                    <a href="{{route('delete_all_teachers')}}" class="btn  btn-danger ">تاكيد</a>                                </div>
                            </div>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>



    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">اضافة مدرب</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('teachers.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاسم  </label>
                                        <input type="text" name="name" class="form-control" id="input1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  رقم الهاتف  </label>
                                        <input type="text" name="phone" class="form-control" id="input1">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  البريد الالكتروني  </label>
                                        <input type="text" name="email" class="form-control" id="input1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  رقم الحاسب  </label>
                                        <input type="text" name="comp_num" class="form-control" id="input1">
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

    <div class="modal fade" id="search">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">بحث </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="get" action="{{route('teachers_search')}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاسم  </label>
                                        <input type="text" name="name" class="form-control" id="input1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  رقم الحاسب  </label>
                                        <input type="text" name="comp_num" class="form-control" id="input1">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">بحث</button>
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



    <div class="modal fade" id="excel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">استيراد </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('teachers_export')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاسم  </label>
                                        <input type="file" name="file" class="form-control" id="input1">
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


    <div class="modal fade" id="table">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">رفع جدول المدربين </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('teachers_table_export')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  اسم الملف  </label>
                                        <input type="file" name="file" class="form-control" id="input1">
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
