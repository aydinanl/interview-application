<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ExamCategories extends Model
{
    use SoftDeletes;

    protected $table = 'exam_categories';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'U';

    protected $fillable = [
        'id', 'cat_name', 'cat_desc'
    ];
}
