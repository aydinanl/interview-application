<?php

use Illuminate\Http\Request;


/*=======================================
=            LOGIN ENDPOINT             =
=======================================*/

Route::post('/login', 'LoginCtrl@login');

/*=====  END OF LOGIN ENDPOINTS  ======*/


/*=======================================
=            ADMIN ENDPOINT              =
========================================*/

Route::middleware(['AllowedUserTypes:admin'])->group(function (){
    //Exam Categories
    Route::post('/exam/categories', 'ExamCategoriesCtrl@create');
    Route::get('/exam/categories/all', 'ExamCategoriesCtrl@readAll');
    Route::get('/exam/categories/{id}', 'ExamCategoriesCtrl@read');

    //Exam Sub Categories
    Route::post('/exam/categories/sub', 'ExamSubCategoriesCtrl@create');
    Route::get('/exam/categories/sub/all', 'ExamSubCategoriesCtrl@readAll');

    //Exam Questions
    Route::post('/exam/categories/{sub_cat_id}/questions', 'ExamQuestionsCtrl@create');

    //Assign Exam to User
    Route::post('/user/{user_id}/assign-exam', 'UserCtrl@assignExamToUser');

});

/*=====  END OF ADMIN ENDPOINTS  =======*/

/*=======================================
=            USER ENDPOINT              =
========================================*/

Route::middleware(['AllowedUserTypes:admin,user'])->group(function (){
    Route::post('/user', 'UserCtrl@create');
    Route::get('/user/{id}', 'UserCtrl@read');

    //Start Exam
    Route::get('/exam/user/{user_id}/{sub_cat_id}', 'ExamCtrl@start');
    //End Exam
    Route::post('/exam/user/{user_id}/result', 'ExamCtrl@createResult');

});

/*=====  END OF USER ENDPOINTS  =======*/
