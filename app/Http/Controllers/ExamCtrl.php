<?php

namespace App\Http\Controllers;

use App\Handlers\ErrorHandler;
use App\Models\ExamQuestions;
use App\Models\Results;
use Illuminate\Http\Request;

class ExamCtrl extends Controller
{
    public function start($user_id,$sub_cat_id){
        if (!$user_id){
            return response()->json(['error'=>['message' => 'user id gerekli!']]);
        }
        $questions = (new ExamQuestions)->where('sub_cat_id',$sub_cat_id)->get();

        return response()->json($questions);
    }

    public function createResult(Request $request,$user_id)
    {
        $check = (new Results)->where('user_id', $user_id)->first();
        if($check){
            return (new ErrorHandler('USER_DONE_EXAM'))->response();
        }

        $result = new Results;
        $result->user_id = $user_id;
        $result->sub_cat_id = trim($request->sub_cat_id);
        //Answers must be an object!
        $result->answers = $request->answers;

        $result->save();
        return response()->json($result);
    }
}
