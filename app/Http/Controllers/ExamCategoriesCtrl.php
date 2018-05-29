<?php

namespace App\Http\Controllers;

use App\Handlers\ErrorHandler;
use App\Helpers\Utility;
use App\Models\ExamCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamCategoriesCtrl extends Controller
{
    public $createValidate = [
        'cat_name' => 'bail|required|unique:exam_categories,cat_name',
    ];

    //CRUD
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),$this->createValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return response()->json($error);
        }

        $e_cat = new ExamCategories();
        $e_cat->cat_name = trim($request->cat_name);
        if (isset($request->cat_desc)){
            $e_cat->cat_desc = $request->cat_desc;
        }else{
            $e_cat->cat_desc = null;
        }

        $e_cat->save();
        $e_cat->id = $e_cat->_id;
        $e_cat->save();

        return response()->json($e_cat);
    }

    public function read($id)
    {
        $e_cat = (new ExamCategories())->find($id);
        if(!$e_cat){
            return (new ErrorHandler('UNKNOWN_ERROR'))->response();
        }
        return response()->json($e_cat);
    }

    public function readAll()
    {
        $e_cat = ExamCategories::all();
        if(!$e_cat){
            return (new ErrorHandler('UNKNOWN_ERROR'))->response();
        }
        return response()->json($e_cat);
    }
}
