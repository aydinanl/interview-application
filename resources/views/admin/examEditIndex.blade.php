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
                    <h4 class="page-title">Edit Exam</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">Exam</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Exam - {{$exam['sub_cat_name']}}</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <form action="#" method="post">
                                    @if(isset($exam_add_error))
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                                <!-- Start an Alert -->
                                                <div style="padding: 10px" id="error-message" class="alert-danger"> <i class="fa fa-exclamation"></i> <span class="error-message">{{$exam_add_error}}</span> </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-10 m-b-20">
                                            <input type="text" name="question" class="form-control input-lg" placeholder="Question">
                                        </div>
                                        <div class="col-lg-2 m-b-20">
                                            <input type="number" name="question_value" class="form-control input-lg" placeholder="Question Value">
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="text" name="fake_answer1" class="form-control input-lg" placeholder="Wrong Answer">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" name="fake_answer2" class="form-control input-lg" placeholder="Wrong Answer">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" name="fake_answer3" class="form-control input-lg" placeholder="Wrong Answer">
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="text" name="answer" class="form-control input-lg" placeholder="Answer">
                                        </div>
                                        <div class="col-lg-12 m-t-20">
                                            <button type="submit" class="btn btn-block btn-success waves-effect waves-light m-r-10 input-lg">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Exam's Questions</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <table id="questions-table" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Value</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($count=1)
                                    @foreach($questions as $question)
                                        <tr>
                                            <td>@if(isset($question) && $question['id']){{$count}}@endif</td>
                                            <td>@if(isset($question) && $question['question']){{$question['question']}}@endif</td>
                                            <td>@if(isset($question) && $question['answer']){{$question['answer']}}@endif</td>
                                            <td>@if(isset($question) && $question['question_value']){{$question['question_value']}}@endif</td>
                                            <td>
                                                <a href="/admin/cagrisim/questions/edit/{{$question['id']}}">Edit</a> -
                                                <a class="kart-sil-button" data="{{$question['id']}}" style="cursor: pointer">Delete</a>
                                                <input class="question-id" type="hidden" value="{{$question['id']}}" data="{{$question['id']}}">
                                            </td>
                                        </tr>
                                        @php($count++)
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script>
        $(document).ready(function() {
            $('#questions-table').DataTable({
                language: {
                    "sDecimal":        ",",
                    "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
                    "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                    "sInfoEmpty":      "Kayıt yok",
                    "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ".",
                    "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
                    "sLoadingRecords": "Yükleniyor...",
                    "sProcessing":     "İşleniyor...",
                    "sSearch":         "Ara:",
                    "sZeroRecords":    "Eşleşen kayıt bulunamadı",
                    "oPaginate": {
                        "sFirst":    "İlk",
                        "sLast":     "Son",
                        "sNext":     "Sonraki",
                        "sPrevious": "Önceki"
                    },
                    "oAria": {
                        "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                        "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                    }
                },
                order: [[ 0, "desc" ]]
            });

            var del_btn = $('.kart-sil-button');
            //Open confirm button when click on delete button.
            del_btn.on('click',function (event) {
                console.log("tıklandı");

                //Show confirm button for deleting.
                $(".kart-sil-onayla-button[data=" + $(event.target).attr('data') + "]").show();

                swal({
                    title: "Soru silmeyi onaylıyor musunuz?",
                    text: "Bu aşamadan sonra soru silinecektir.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Onayla",
                    cancelButtonText: "İptal",
                    closeOnConfirm: false
                }, function(){
                    var id = $(".question-id[data=" + $(event.target).attr('data') + "]").val();
                    console.log(id);

                    swal.close();
                    $.ajax({
                        "method": "delete",
                        "url": '/admin/exam/question/delete/' + id
                    }).done(function (data) {
                        location.reload();
                    }).fail();
                });
            });
        });
    </script>
@endsection