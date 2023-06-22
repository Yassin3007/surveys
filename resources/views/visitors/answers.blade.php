@extends('layouts.dashboard')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 ">{{$survey->name}}  </h1>
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

                                {{--                                <h3 class="card-title font-weight-bold">شاشة المدربين</h3>--}}
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">


                                    @foreach($questions as $question)
                                        <div class="form-group">
                                            <label for="{{$question->id}}">{{$question->question}}:</label>
                                            @if($question->type == 0)

                                                <div class="form-group">
                                                    <textarea readonly class="form-control col-md-6 answer" id="message" name="question_{{$question->id}}" rows="3">{{\App\Models\TeacherSurvey::query()->where('teacher_id',$teacher_id)
                                                     ->where('survey_id',$survey->id)
                                                     ->where('question_id',$question->id)->first()->answer}}</textarea>
                                                </div>

                                            @endif

                                            @foreach($question->answers as $answer)
                                                <div  class="form-check">
                                                    <input class="form-check-input"
                                                           @if($question->type == 1)
                                                               type="radio"
                                                           name="question_{{$question->id}}"
                                                           @elseif($question->type == 2)
                                                               type="checkbox"
                                                           name="question_{{$question->id}}[]"
                                                           @else
                                                               type="text"
                                                           name="question_{{$question->id}}"
                                                           @endif
                                                               @if(in_array($answer->id,$teacher_survey_answers))checked @endif


                                                           {{ old("question_{$question['id']}") == $answer->id ? 'checked' : '' }}
                                                           id="question1_option1" value="{{$answer->id}}">
                                                    <label class="form-check-label" for="question1_option1">
                                                        {{$answer->answer}}
                                                    </label>
                                                </div>
                                            @endforeach






                                        </div>

                                    @endforeach


                                    {{--                                    <input class="form-check-input" hidden type="text" name="survey_id" value="{{$survey->id}}"  >--}}

                                    <!-- إضافة المزيد من الأسئلة هنا -->


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
@endsection
