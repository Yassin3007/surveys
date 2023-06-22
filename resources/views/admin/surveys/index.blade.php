@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">نماذج التقييم  </h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                    اضافة نموذج استبيان جديد
                                </button>
{{--                                <a href="{{route('archeive')}}" class="btn  btn-outline-warning">الارشيف</a>--}}

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

                                            <button type="button" class="btn  btn-outline-warning" data-toggle="modal" data-target="#modal-default{{$survey->id}}">تعديل</button>
                                            <a href="{{route('questions.show',$survey->id)}}" class="btn  btn-outline-primary">تفاصيل</a>
                                            <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$survey->id}}">
                                                حذف
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-default{{$survey->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> تعديل نموذج التقييم</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form method="post" action="{{route('surveys.update',$survey)}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="input1">  اسم النموذج </label>
                                                                        <input type="text" name="name" value="{{$survey->name}}" class="form-control" id="input1">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="select1">نوع النموذج</label>
                                                                        <select name="type" class="form-control" id="select1">
                                                                            <option @if($survey->type==0)selected @endif value="0"> تقييم مقرر</option>
                                                                            <option @if($survey->type==1)selected @endif value="1"> تقييم مدرب</option>
                                                                            <option @if($survey->type==2)selected @endif value="2"> غيرذلك </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">

                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="input1">التقييم موجه الى </label>
                                                                        <select name="for" class="form-control" id="select1">
                                                                            <option @if($survey->for==0)selected @endif value="0"> الطلاب </option>
                                                                            <option @if($survey->for==1)selected @endif value="1">  المهندسين</option>
                                                                            <option @if($survey->for==2)selected @endif value="2">  الزوار</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label  for="input1">    يبدا في</label>
                                                                        <input name="start" value="{{$survey->start}}"  type="date" class="form-control" id="input1">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="input1">ينتهي في</label>
                                                                        <input name="end" value="{{$survey->end}}" type="date" class="form-control" id="input1">
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div class="col">
                                                                <div class="form-group form-check">
                                                                    <input @if($survey->status==1)checked @endif type="checkbox" name="status" value="1" class="form-check-input" id="checkbox1">
                                                                    <label class="form-check-label" for="checkbox1">نشط/لا</label>
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

                                    <div class="modal fade" id="delete{{$survey->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">هل انت متاكد من عملية الحذف ؟</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form method="post" action="{{route('surveys.destroy',$survey)}}">
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
            <div class="pagination-wrapper">
                {{ $surveys->onEachSide(0)->links() }}
            </div>
    </section>
    <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delete">
            حذف الكل
        </a>
{{--        <a href="{{route('surveys_export')}}" class="btn btn-success" >--}}
{{--            تصدير كافة الاستبيانات--}}
{{--        </a>--}}

        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              تصدير الاستبيانات
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{route('survey_export',0)}}">استبيانات الطلاب - مقررات </a>
            <a class="dropdown-item" href="{{route('survey_export',1)}}">استبيانات الطلاب - مدربين </a>
            <a class="dropdown-item" href="{{route('survey_export',2)}}"> استبيانات المهندسين </a>
            <a class="dropdown-item" href="{{route('survey_export',3)}}">  استبيانات الزوار</a>


        </div>

    </footer>

    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">هل انت متاكد من  حذف  كل الاستبيانات </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('archieve_surveys')}}">
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> اضافة نموذج التقييم</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('surveys.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  اسم النموذج </label>
                                        <input type="text" name="name" class="form-control" id="input1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1">نوع النموذج</label>
                                        <select name="type" class="form-control" id="select1">
                                            <option hidden selected disabled>----اختر----</option>
                                            <option value="0"> تقييم مقرر</option>
                                            <option value="1"> تقييم مدرب</option>
                                            <option value="2">  غيرذلك</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">التقييم موجه الى </label>
                                        <select name="for" class="form-control" id="select1">
                                            <option hidden selected disabled>----اختر----</option>

                                            <option value="0"> الطلاب </option>
                                            <option value="1">  المهندسين</option>
                                            <option value="2">  الزوار</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label  for="input1">    يبدا في</label>
                                        <input name="start" type="date" class="form-control" id="input1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">ينتهي في</label>
                                        <input name="end" type="date" class="form-control" id="input1">
                                    </div>
                                </div>


                            </div>

                            <div class="col">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="status" value="1" class="form-check-input" id="checkbox1">
                                    <label class="form-check-label"  for="checkbox1">نشط/لا</label>
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
