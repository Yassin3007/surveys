@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">شاشة المواد </h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                    اضافة مادة
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#export">
                                    استيراد
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
                                        <th>رقم المقرر</th>
                                        <th>اسم المدرب </th>
                                        <th>التخصص</th>
                                        <th>المرحلة</th>
                                        <th>الفصل الدراسي</th>
                                        <th>خيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td style="padding-right: 40px;">{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->number}}</td>
                                            <td>
                                                @if($subject->teachers->count()>0)
                                                    {{$subject->teachers[0]->name}}
                                                @else
                                                    <span style="color: #9b1010;font-size: 30px" class="fa fa-file-excel"></span>
                                                    <br>
                                                    لم يتم اختيار مدرب بعد
                                                @endif
                                            </td>
                                            <td>{{$subject->section->name}}</td>
                                            <td>
                                                @if($subject->stage == 1)
                                                    دبلوم
                                                @elseif($subject->stage == 2)
                                                    بكالوريوس
                                                @endif
                                            </td>
                                            <td>
                                                @if($subject->grade_id == 1)
                                                    الترم الاول
                                                @elseif($subject->grade_id == 2)
                                                    الترم الثانى
                                                @elseif($subject->grade_id == 3)
                                                    الترم الثالث
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-default{{$subject->id}}">
                                                    تعديل
                                                </a>
{{--                                                <a href="trainer_details.html" class="btn  btn-outline-primary">تفاصيل</a>--}}

                                                <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$subject->id}}">
                                                    حذف
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-default{{$subject->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">تعديل بيانات {{$subject->name}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <form method="post" action="{{route('subjects.update',$subject)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  الاسم  </label>
                                                                            <input type="text" name="name" value="{{$subject->name}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  رقم المقرر  </label>
                                                                            <input type="text" name="number" value="{{$subject->number}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="select1"> الفصل الدراسي</label>
                                                                            <select name="grade_id" class="form-control" id="select1">

                                                                                <option @if($subject->grade_id==1)selected @endif value="1"> الترم الاول </option>
                                                                                <option @if($subject->grade_id==2)selected @endif value="2"> الترم الثانى </option>
                                                                                <option @if($subject->grade_id==3)selected @endif value="3">  الترم الثالث </option>



                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="select1"> التخصص</label>
                                                                            <select name="section_id" class="form-control" id="select1">
                                                                                @foreach($sections as $section)
                                                                                    <option @if($subject->section_id==$section->id)selected @endif value="{{$section->id}}">  {{$section->name}}</option>

                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">

                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="select1"> المرحلة</label>
                                                                            <select name="stage" class="form-control" id="select1">

                                                                                <option @if($subject->stage==1)selected @endif value="1"> دبلوم </option>
                                                                                <option @if($subject->stage==2)selected @endif value="2"> بكالوريوس </option>


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

                                        <div class="modal fade" id="delete{{$subject->id}}">
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
                                                            <form method="post" action="{{route('subjects.destroy',$subject)}}">
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
                {{ $subjects->onEachSide(0)->links() }}
            </div>
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
{{--        <button type="button" class="btn  btn-danger ">حذف جميع المدربين</button>--}}

    </footer>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">اضافة مادة</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('subjects.store')}}">
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
                                        <label for="input1">  رقم المقرر  </label>
                                        <input type="text" name="number" class="form-control" id="input1">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

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

                            </div>
                            <div class="row">

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






    <div class="modal fade" id="export">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> استيراد</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('subjects_export')}}">
                            @csrf


                            <div class="row">

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

@endsection
