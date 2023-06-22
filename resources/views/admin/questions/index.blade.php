@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">{{$survey->name}}   </h1>
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
                                    اضافة سؤال
                                </button>
{{--                            <h3 class="card-title">نماذج التقييم </h3>--}}
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">



                            <table id="example3" class="table table-bordered table-striped">

                                <thead>
                                <tr>

                                    <th>م  </th>
                                    <th>السؤال  </th>
                                    <th>نوع السؤال  </th>
                                    <th>الاجابات  </th>
                                    <th>خيارات</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{$loop->iteration}} </td>

                                        <td>{{$question->question}}</td>
                                        <td>
                                            @if($question->type==0)
                                                نص
                                            @elseif($question->type==1)
                                                اختيار واحد
                                            @elseif($question->type==2)
                                                اختيار متعدد
                                            @endif

                                        </td>
                                        <td>
                                            @foreach($question->answers as $answer)
                                                {{$answer->answer}}<br>
                                            @endforeach



                                        </td>


                                        <td>

                                            <button type="button" class="btn  btn-outline-warning" data-toggle="modal" data-target="#modal-default{{$question->id}}">تعديل</button>
                                            <button type="button" class="btn  btn-outline-success" data-toggle="modal" data-target="#answer{{$question->id}}">اضافة اجابة</button>

                                            <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$question->id}}">
                                                حذف
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-default{{$question->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> تعديل السؤال </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form method="post" action="{{route('questions.update',$question)}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="input1">  السؤال  </label>
                                                                        <input type="text" name="question" value="{{$question->question}}" class="form-control" id="input1">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="row">

                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="select1">نوع السؤال</label>
                                                                        <select name="type" class="form-control" id="select1">
                                                                            <option hidden selected disabled>----اختر----</option>
                                                                            <option @if($question->type==0)selected @endif value="0"> نص </option>
                                                                            <option @if($question->type==1)selected @endif value="1"> اختيار واحد </option>
                                                                            <option @if($question->type==2)selected @endif value="2"> اختيار متعدد </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            @foreach($question->answers as $answer)
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  الاجابة
                                                                                {{$loop->iteration}}(اختيارى)  </label>
                                                                            <input type="text" name="answers[]" value="{{$answer->answer}}" class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                            @for($i = $question->answers->count() ; $i<4 ; $i++)
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="input1">  الاجابة
                                                                                {{$i +1}}(اختيارى)  </label>
                                                                            <input type="text" name="answers[]"  class="form-control" id="input1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endfor






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

                                    <div class="modal fade" id="answer{{$question->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">  اضافة اجابة </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form method="post" action="{{route('add_answer',$question->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="input1">  الاجابة  </label>
                                                                        <input type="text" name="answer"  class="form-control" id="input1">
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


                                    <div class="modal fade" id="delete{{$question->id}}">
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
                                                        <form method="post" action="{{route('questions.destroy',$question)}}">
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
    </section>
    <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> اضافة  سؤال</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{route('questions.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  السؤال  </label>
                                        <input type="text" name="question" class="form-control" id="input1">
                                        <input type="text" name="survey_id" value="{{$survey->id}}" hidden class="form-control" id="input1">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="select1">نوع السؤال</label>
                                        <select name="type" class="form-control" id="select1">
                                            <option hidden selected disabled>----اختر----</option>
                                            <option value="0"> نص </option>
                                            <option value="1"> اختيار واحد </option>
                                            <option value="2"> اختيار متعدد </option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاجابة الاولي(اختيارى)  </label>
                                        <input type="text" name="answers[]" class="form-control" id="input1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاجابة الثانية(اختيارى)  </label>
                                        <input type="text" name="answers[]" class="form-control" id="input1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاجابة الثالثة(اختيارى)  </label>
                                        <input type="text" name="answers[]" class="form-control" id="input1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="input1">  الاجابة الرابعة(اختيارى)  </label>
                                        <input type="text" name="answers[]" class="form-control" id="input1">
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
