@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">
                            اضافة مرفق
                            @if($type==0)
                                بيانات الطلاب
                            @elseif($type==1)
                                بيانات المدرسين

                            @elseif($type==2)
                                جداول الطلاب
                            @elseif($type==3)
                                الجدول الشامل
                            @endif
                        </h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div style="text-align: center">
            <br>
            <br>
            <p style="font-size: 30px">
                استبانات المتدربين كليه الاتصالات والالكترونيات بجده
            </p>
{{--                <img alt="user-img" width="150px;" height="100px" src="{{URL::asset('dist/img/logo.webp')}}">--}}
            <img alt="user-img" width="150px;" height="100px" src="{{URL::asset('dist/img/rtx.png')}}">



        </div><!-- /.col -->
    <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form method="post" action="{{route('add_main_table',$type)}}" enctype="multipart/form-data">
                    @csrf
                <div class="row" style="text-align: center; justify-content: center">
                    <div class="col" >
                        <div class="form-group col-md-6" >
                            <label for="input1">  اسم المرفق</label>
                            <input type="file" class="form-control" name="file" id="input1">
                            <input type="text" hidden value="{{$type}}" class="form-control" name="type" id="input1">
                        </div>
                    </div>



                </div>
                    <div class="row" style="margin-right: 20px; color: red">
                        <div class="col" >
                           <p>*برجاء الالتزام بترتيب الاعمدة الموجود في الصورة التالية</p>
                        </div>

                    </div>
                    <div class="row" style="margin-right: 20px; color: red">
                        <div class="col">
                            <a href="{{route('dowload_empty',$type)}}" class="btn btn-outline-info">تحميل ملف اكسيل فارغ</a>
                        </div>

                    </div>
                    <br>
                    <br>

                    <div class="row" style="text-align: center">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                        </div>
                    </div>
                </form>
                <br>


                @if($type==0)
                    <img alt="user-img" width="100%" height="100%" src="{{URL::asset('dist/img/stu.png')}}">

                @elseif($type==1)
                    <img alt="user-img" width="100%" height="100%" src="{{URL::asset('dist/img/eng.png')}}">

                @elseif($type==2)
                    <img alt="user-img" width="100%" height="100%" src="{{URL::asset('dist/img/stu_tab.png')}}">

                @elseif($type==3)
                    <img alt="user-img" width="100%" height="100%" src="{{URL::asset('dist/img/main.png')}}">

                @endif



            </div>
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">





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
