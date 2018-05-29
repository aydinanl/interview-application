<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Results extends Model
{
    use SoftDeletes;

    protected $table = 'exam_results';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'U';

    protected $fillable = [
        'id', 'user_id', 'sub_cat_id','answers'
    ];
}
