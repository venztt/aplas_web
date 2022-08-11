<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::resource('/admin/resetpassword', 'ResetPasswordController');
});

Route::group(['middleware' => ['auth', 'teacher']], function () {
    Route::get('/teacher', 'TeacherController@index');

    Route::resource('/teacher/assignstudent', 'AssignStudentController');
    Route::resource('/teacher/member', 'StudentMemberController');

    Route::resource('/teacher/crooms', 'ClassroomController');
});

Route::group(['middleware' => ['auth', 'student']], function () {
    Route::get('/student', 'StudentController@index');
});

Route::middleware(['auth'])->group(function () {

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
