<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ExamQuestions extends Model
{
    use SoftDeletes;

    protected $table = 'exam_questions';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'U';

    protected $fillable = [
        'id', 'sub_cat_id', 'question', 'answer', 'fake_answers', 'question_value'
    ];
}
