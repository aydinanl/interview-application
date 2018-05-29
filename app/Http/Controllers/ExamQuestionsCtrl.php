<?php

namespace App\Http\Controllers;

use App\Handlers\ErrorHandler;
use App\Helpers\Utility;
use App\Models\ExamQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamQuestionsCtrl extends Controller
{
    public $createValidate = [
        'sub_cat_id' => 'bail|required|exists:exam_sub_categories,id',
        'question' => 'bail|required',
        'answer' => 'bail|required',
        'fake_answers' => 'bail|required|array',
    ];

    //CRUD
    public function create(Request $request,$sub_cat_id)
    {
        $req = array_merge($request->all(), ['sub_cat_id' => $sub_cat_id]);
        $validator = Validator::make($req,$this->createValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return response()->json($error);
        }

        $q = new ExamQuestions();
        $q->sub_cat_id = trim($sub_cat_id);
        $q->question = trim($request->question);
        $q->answer = trim($request->answer);

        //Fake answer has to be array or json!
        $fake = [];

        $q->fake_answers = $request->fake_answers;
        $q->question_value = (int) trim($request->question_value);

        $q->save();
        $q->id = $q->_id;
        $q->save();

        return response()->json($q);
    }

    public function delete($id)
    {
        $question = (new ExamQuestions)->find($id);
        $question->delete();

        return response()->json($question);
    }

}
