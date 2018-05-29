@extends('admin.layouts.app')
@section('content')
    <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <style>
        .tooltip-inner {
            max-width: 350px;
            /* If max-width does not work, try using width instead */
            width: 350px;
        }
    </style>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">User Report</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">User Report</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            @php($done_exam = false)
            @php($results = (new \App\Models\Results())->where('user_id',$userS['id'])->get())
            @foreach($results as $result)
                @if(isset($result['user_id'])) @php($done_exam = true) @endif
            @endforeach
            @php($total_value = 0)
            @php($total_value_s = 0)
            @php($total_question = 0)
            @php($total_true_question = 0)
            @php($result = (new \App\Models\Results)->where('user_id', $userS['id'])->first())
            @if($done_exam)
                @foreach($result['answers'] as $key => $value)
                    @php($question = (new \App\Models\ExamQuestions)->find($key))
                    @php($total_value_s += $question['question_value'])
                    @php(++$total_question)
                    @if($value)
                        @php($total_value += $question['question_value'])
                        @php(++$total_true_question)
                    @endif
                @endforeach
            @endif
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">User Informations</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <strong>Username: </strong> {{$userS['username']}} <br>
                                    <strong>Name: </strong> {{$userS['name']}} <br>
                                    <strong>Surname: </strong> {{$userS['name']}} <br>
                                    <strong>Email: </strong> {{$userS['email']}} <br>
                                    <strong>Exam Status: </strong> @if($done_exam) Done Exam @else Not Done Exam @endif
                                </div>
                                @if($done_exam)
                                    <div class="col-lg-6">
                                        <strong>Success Information</strong> <br>
                                        Quality : {{$total_value}}/{{$total_value_s}} <br>
                                        Gives <strong>{{$total_true_question}}</strong> true answer from <strong>{{$total_question}} questions</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if($done_exam)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Answered Questions</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                @foreach($result['answers'] as $key => $value)
                                    @php($question = (new \App\Models\ExamQuestions)->find($key))
                                    <div class="@if($value) bg-success @else bg-danger  @endif panel-body m-b-10">
                                        <strong>Question</strong> : {{$question['question']}} <br>
                                        <strong>Answer</strong>  : {{$question['answer']}} <br>
                                        <strong>Value</strong> : {{$question['question_value']}}
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('scripts')
    <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script>
        var token = "{{$token}}";
    </script>
@endsection