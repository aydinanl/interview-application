<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ExamSubCategories extends Model
{
    use SoftDeletes;

    protected $table = 'exam_sub_categories';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'U';

    protected $fillable = [
        'id', 'cat_id', 'sub_cat_name','sub_cat_desc'
    ];
}
