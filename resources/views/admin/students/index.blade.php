@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">شاشة المتدربين </h1>
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
{{--                                    اضافة متدرب--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#excel">--}}
{{--                                    استيراد--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id">--}}
{{--                                    استيراد ارقام الهوية--}}
{{--                                </button>--}}
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
                                        <th>رقم الهوية </th>
                                        <th>رقم المتدرب</th>
                                        <th>رقم الجوال</th>
{{--                                        <th>حالة المتدرب</th>--}}
                                        <th>التخصص</th>
                                        <th>المرحلة</th>
{{--                                        <th>الفصل الدراسي</th>--}}
                                        <th>خيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->id_num}}</td>
                                            <td>{{$student->number}}</td>
                                            <td>{{$student->phone}}</td>
{{--                                            <td>--}}
{{--                                                @if($student->status==1)--}}
{{--                                                    <span class="badge badge-success">مستمر</span>--}}
{{--                                                @else--}}
{{--                                                    <span class="badge badge-danger">معاد قيده</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td>{{\App\Models\StudentTable::query()->where('trainee_number',$student->number)->first()->section}}</td>
                                            <td>
                                                @if($student->stage == 1)
                                                    دبلوم
                                                @elseif($student->stage == 2)
                                                    بكالوريوس
                                                @endif
                                            </td>
{{--                                            <td>--}}
{{--                                                @if($student->grade_id == 1)--}}
{{--                                                    الترم الاول--}}
{{--                                                @elseif($student->grade_id == 2)--}}
{{--                                                    الترم الثانى--}}
{{--                                                @elseif($student->grade_id == 3)--}}
{{--                                                    الترم الثالث--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td>
{{--                                                <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-default{{$student->id}}">--}}
{{--                                                    تعديل--}}
{{--                                                </a>--}}
                                                <a href="{{route('student_subjects',$student->id)}}" class="btn  btn-outline-primary">تفاصيل</a>

                                                <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$student->id}}">
                                                    حذف
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-default{{$student->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">تعديل بيانات {{$student->name}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <form method="post" action="{{route('students.update',$student)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  الاسم  </label>
                                                                            <input type="text" name="name" value="{{$student->name}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  رقم الهوية  </label>
                                                                            <input type="text" name="id_num" value="{{$student->id_num}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  رقم المتدرب   </label>
                                                                            <input type="text" name="number" value="{{$student->number}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  رقم الجوال  </label>
                                                                            <input type="text" name="phone" value="{{$student->phone}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>

                                                                </div>
{{--                                                                <div class="row">--}}
{{--                                                                    <div class="col">--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label for="select1">حالة المتدرب </label>--}}
{{--                                                                            <select name="status" class="form-control" id="select1">--}}

{{--                                                                                <option @if($student->status==1)selected @endif value="1" > مستمر </option>--}}
{{--                                                                                <option @if($student->status==0)selected @endif value="0"> معاد قيده </option>--}}
{{--                                                                            </select>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="select1"> المرحلة</label>
                                                                            <select name="stage" class="form-control" id="select1">

                                                                                    <option @if($student->stage==1)selected @endif value="1"> دبلوم </option>
                                                                                    <option @if($student->stage==2)selected @endif value="2"> بكالوريوس </option>


                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="select1"> التخصص</label>
                                                                            <select name="section_id" class="form-control" id="select1">
                                                                                @foreach($sections as $section)
                                                                                    <option @if($student->section_id==$section->id)selected @endif value="{{$section->id}}">  {{$section->name}}</option>

                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="select1"> الفصل الدراسي</label>
                                                                            <select name="grade_id" class="form-control" id="select1">

                                                                                    <option @if($student->grade_id==1)selected @endif value="1"> الترم الاول </option>
                                                                                    <option @if($student->grade_id==2)selected @endif value="2"> الترم الثانى </option>
                                                                                    <option @if($student->grade_id==3)selected @endif value="3">  الترم الثالث </option>



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

                                        <div class="modal fade" id="delete{{$student->id}}">
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
                                                            <form method="post" action="{{route('students.destroy',$student)}}">
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
                    {{ $students->onEachSide(0)->links() }}
                </div>
            @endif

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-all">
            حذف جميع المتدربين
        </button>
    </footer>
    <div class="modal fade" id="delete-all">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">هل انت متاكد من حذف جميع المتدربين ؟</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">


                        <div class="row">
                            <div class="col">
                                <a href="{{route('delete_all_students')}}" class="btn  btn-warning ">تاكيد</a>                                </div>
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
                    <h4 class="modal-title">اضافة متدرب</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('students.store')}}">
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
                                        <label for="input1">  رقم الهوية  </label>
                                        <input type="text" name="id_num" class="form-control" id="input1">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  رقم المتدرب   </label>
                                        <input type="text" name="number" class="form-control" id="input1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  رقم الجوال  </label>
                                        <input type="text" name="phone" class="form-control" id="input1">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1">حالة المتدرب </label>
                                        <select name="status" class="form-control" id="select1">
                                            <option disabled selected hidden="">----اختر----</option>
                                            <option value="1" > مستمر </option>
                                            <option value="0"> معاد قيده </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1"> المرحلة</label>
                                        <select name="stage" class="form-control" id="select1">

                                                <option disabled selected hidden="">----اختر----</option>
                                                <option value="1"> دبلوم  </option>
                                                <option value="2"> بكالوريوس </option>


                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1"> التخصص</label>
                                        <select name="section_id" class="form-control" id="select1">
                                            @foreach($sections as $section)
                                                <option disabled selected hidden="">----اختر----</option>
                                                <option value="{{$section->id}}">  {{$section->name}}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1"> الفصل الدراسي </label>
                                        <select name="grade_id" class="form-control" id="select1">


                                                <option disabled selected hidden="">----اختر----</option>
                                                <option value="1"> الترم الاول </option>
                                                <option value="2"> الترم الثانى </option>
                                                <option value="3"> الترم الثالث </option>




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



    <div class="modal fade" id="id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">استيراد ارقام الهوية </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('students_id_export')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col">

                                        <div class="form-group">
                                            <label for="input1">  الملف  </label>
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
                        <form method="get" action="{{route('students_search')}}">
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
                                        <label for="input1">  رقم المتدرب  </label>
                                        <input type="text" name="number" class="form-control" id="input1">
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

@endsection
