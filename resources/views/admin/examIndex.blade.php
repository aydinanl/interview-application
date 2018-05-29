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
                    <h4 class="page-title">Exam Control</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">Exam Control</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Exam</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <p class="text-muted">You have to first create <code>Exam Category</code>like Software and <code>Exam Sub Category</code>like Jr. Android Developer</p>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#addCategory" data-whatever="@mdo">Add Category</button>
                                        <!-- Kategori Ekle Modal -->
                                        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="addCategoryLabel">Add Category</h4> </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="row process-error">
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                                                        <!-- Start an Alert -->
                                                                        <div style="padding: 10px" id="error-message" class="alert-danger"> <i class="fa fa-exclamation"></i> <span class="error-message"></span> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row process-success">
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                                                        <!-- Start an Alert -->
                                                                        <div style="padding: 10px" id="error-message" class="alert-success"> <i class="fa fa-exclamation"></i>  <span class="success-message"></span> </div>
                                                                    </div>
                                                                </div>
                                                                <label for="recipient-name" class="control-label">Category Name:</label>
                                                                <input type="text" class="form-control" name="cat_name" id="category_name"> </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button class="btn btn-success" id="cat-add-button">Add</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.kategori ekle modal -->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <button type="button" id="addSubCategoryModal" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#addSubCategory" data-whatever="@mdo">Add Sub Category</button>
                                        <!-- Sub Kategori Ekle Modal -->
                                        <div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="addSubCategoryLabel">Add Sub Category</h4> </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="row process-error">
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                                                    <!-- Start an Alert -->
                                                                    <div style="padding: 10px" id="error-message" class="alert-danger"> <i class="fa fa-exclamation"></i> <span class="error-message"></span> </div>
                                                                </div>
                                                            </div>
                                                            <div class="row process-success">
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                                                    <!-- Start an Alert -->
                                                                    <div style="padding: 10px" id="error-message" class="alert-success"> <i class="fa fa-exclamation"></i>  <span class="success-message"></span> </div>
                                                                </div>
                                                            </div>
                                                            <label for="recipient-name" class="control-label">Select Category:</label>

                                                            <div id="draw-sub-categories">
                                                            </div>

                                                            <label for="recipient-name" class="control-label">Sub Category Name:</label>
                                                            <input type="text" class="form-control" id="sub_category_name"> </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-success" id="sub-cat-add-button">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.sub kategori ekle modal -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Insert Question To Exam</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <ul style="width: 100%">
                                    @foreach($exams as $exam)
                                        <li style="width: calc(50% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc">
                                            {{$exam['sub_cat_name']}} -
                                            <a href="/admin/exam/edit/{{$exam['id']}}">Edit Exam</a>
                                        </li>
                                    @endforeach
                                </ul>

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
    <script src="/js/examPage.js"></script>
@endsection