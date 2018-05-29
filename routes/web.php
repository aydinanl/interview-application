<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*=======================================
=            LOGIN ENDPOINT             =
=======================================*/

Route::post('/login', 'LoginCtrl@loginWeb');
Route::get('/login', 'LoginCtrl@index')->name('login-index');
Route::get('/logout', 'LoginCtrl@logout');

/*=====  END OF LOGIN ENDPOINTS  ======*/

/*=======================================
=            ADMIN ENDPOINT             =
=======================================*/

Route::middleware(['CheckTokenWeb'])->group(function (){
    Route::get('/admin', 'Admin\DashboardCtrl@index');
    Route::get('/admin/dashboard', 'Admin\DashboardCtrl@index');

    //Edit Home
    Route::get('/admin/cons-edit/home', 'Admin\DashboardCtrl@editHome');

    //Exam
    Route::get('/admin/exam', 'Admin\ExamCtrl@index');
    Route::get('/admin/exam/edit/{id}', 'Admin\ExamCtrl@editIndex')->name('exam-edit-page');
    Route::post('/admin/exam/edit/{id}', 'Admin\ExamCtrl@addQueastion');
    Route::delete('/admin/exam/question/delete/{id}', 'ExamQuestionsCtrl@delete');

    //User
    Route::get('/admin/exams/users', 'Admin\UserCtrl@index');
    Route::post('/admin/exams/users', 'Admin\UserCtrl@create');
    Route::delete('/admin/exams/users/delete/{id}', 'UserCtrl@delete');


    //Report
    Route::get('/admin/exam/report/user/{id}', 'Admin\UserCtrl@reportIndex');




});

/*=====  END OF ADMIN ENDPOINTS  ======*/

/*=======================================
=            WEB ENDPOINT             =
=======================================*/
//Home
Route::get('/', function () {
    return view('welcome');
});

/*=====  END OF WEB ENDPOINTS  ======*/