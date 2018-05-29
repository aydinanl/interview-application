<?php

namespace App\Http\Controllers;

use App\Handlers\ErrorHandler;
use App\Helpers\Utility;
use App\Models\ExamSubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamSubCategoriesCtrl extends Controller
{
    public $createValidate = [
        'cat_id' => 'bail|required|exists:exam_categories,id',
        'sub_cat_name' => 'bail|required|unique:exam_sub_categories,sub_cat_name',
    ];

    //CRUD
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),$this->createValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return response()->json($error);
        }

        $e_sub_cat = new ExamSubCategories();
        $e_sub_cat->cat_id = trim($request->cat_id);
        $e_sub_cat->sub_cat_name = trim($request->sub_cat_name);

        if (isset($request->sub_cat_desc)){
            $e_sub_cat->sub_cat_desc = $request->sub_cat_desc;
        }else{
            $e_sub_cat->sub_cat_desc = null;
        }

        $e_sub_cat->save();
        $e_sub_cat->id = $e_sub_cat->_id;
        $e_sub_cat->save();

        return response()->json($e_sub_cat);
    }

    public function read($id)
    {
        $e_sub_cat = (new ExamSubCategories)->find($id);
        if(!$id){
            return (new ErrorHandler('UNKNOWN_ERROR'))->response();
        }
        return response()->json($e_sub_cat);
    }

    public function readAll()
    {
        $e_sub_cat = ExamSubCategories::all();
        if(!$e_sub_cat){
            return (new ErrorHandler('UNKNOWN_ERROR'))->response();
        }
        return response()->json($e_sub_cat);
    }
}
