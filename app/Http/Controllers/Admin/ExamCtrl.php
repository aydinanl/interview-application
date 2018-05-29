<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utility;
use App\Models\ExamQuestions;
use App\Models\ExamSubCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExamCtrl extends Controller
{
    public $createQuestionValidate = [
        'sub_cat_id' => 'bail|required|exists:exam_sub_categories,id',
        'question' => 'bail|required',
        'answer' => 'bail|required',
    ];

    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $exams = ExamSubCategories::all();
            return view('admin.examIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'exams' => $exams
            ]);
        }else{
            return redirect("/login" );
        }
    }

    public function editIndex(Request $request,$id)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            $exam = ExamSubCategories::find($id);
            $questions = (new ExamQuestions)->where('sub_cat_id',$id)->get();
            return view('admin.examEditIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'exam' => $exam,
                'sub_cat_id' => $id,
                'questions' => $questions
            ]);
        }else{
            return redirect("/login" );
        }
    }

    public function addQueastion(Request $request,$sub_cat_id)
    {
        $exam = ExamSubCategories::find($sub_cat_id);
        $questions = (new ExamQuestions)->where('sub_cat_id',$sub_cat_id)->get();

        $req = array_merge($request->all(), ['sub_cat_id' => $sub_cat_id]);
        $validator = Validator::make($req,$this->createQuestionValidate,Utility::validatorMessages());
        if ($validator->fails()) {
            $error = Utility::formatErrorsArray($validator);
            return view('admin.examEditIndex', [
                'user' => $request->user,
                'token' => $request->session()->get('token'),
                'exam' => $exam,
                'sub_cat_id' => $sub_cat_id,
                'questions' => $questions,
                'exam_add_error' => 'Tüm alanları doldurunuz'
            ]);
        }

        $q = new ExamQuestions();
        $q->sub_cat_id = trim($sub_cat_id);
        $q->question = trim($request->question);
        $q->answer = trim($request->answer);

        //Fake answer has to be array or json!
        $fake = [$request->fake_answer1,$request->fake_answer2,$request->fake_answer3];
        $q->fake_answers = $fake;
        $q->question_value = (int) trim($request->question_value);

        $q->save();
        $q->id = $q->_id;
        $q->save();

        return redirect()->back();
    }
}
