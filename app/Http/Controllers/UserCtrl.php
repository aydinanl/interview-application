<?php

namespace App\Http\Controllers;

use App\Handlers\ErrorHandler;
use App\Helpers\Utility;
use App\Models\ExamCategories;
use App\Models\ExamSubCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCtrl extends Controller
{
    public $createValidate = [
        'type' => 'bail|required',
        'username' => 'bail|required|unique:users,username',
        'password' => 'bail|required|max:128',
        'email' => 'bail|required|max:255|unique:users,email',
        'name' => 'bail|required|max:64',
        'surname' => 'bail|required|max:55',
    ];

    public $assignValidate = [
        'cat_id' => 'bail|required|exists:exam_categories,id',
        'sub_cat_id' => 'bail|required|exists:exam_sub_categories,id',
    ];

    //CRUD
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),$this->createValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return response()->json($error);
        }

        $user = new User();
        $user->type = trim($request->type);
        $user->username = trim($request->username);
        $user->password = Hash::make($request->password);
        $user->email = trim($request->email);
        $user->name = trim($request->name);
        $user->surname = trim($request->surname);
        $user->exam_cat_id = null;
        $user->exam_sub_cat_id = null;

        $user->save();
        $user->id = $user->_id;
        $user->save();
        return response()->json($user);
    }

    public function read($id)
    {
        $user = (new User)->find($id);
        if(!$id){
            return (new ErrorHandler('UNKNOWN_ERROR'))->response();
        }
        return response()->json($user);
    }


    public function assignExamToUser(Request $request,$user_id)
    {
        $user = (new User)->find($user_id);
        if (!$user){
            return (new ErrorHandler('USER_NOT_FOUND'))->response();
        }

        $validator = Validator::make($request->all(),$this->assignValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return response()->json($error);
        }

        $user->exam_cat_id = trim($request->cat_id);
        $user->exam_sub_cat_id = trim($request->sub_cat_id);

        //Create information about exam.
        $cat = (new ExamCategories)->find($request->cat_id);
        $sub_cat = (new ExamSubCategories)->find($request->sub_cat_id);

        $user->exam_info = [
            'cat_name' => $cat['cat_name'],
            'sub_cat_name' => $sub_cat['sub_cat_name']
        ];

        $user->save();

        return response()->json($user);
    }

    public function delete($id)
    {
        $user = (new User)->find($id);
        $user->delete();

        return response()->json($user);
    }
}
