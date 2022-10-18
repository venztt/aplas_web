<?php


use App\Http\Controllers\Java\Student\StudentJavaTaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::resource('/admin/resetpassword', 'ResetPasswordController');
});

Route::group(['prefix' => 'admin/java', 'as' => 'admin.java.', 'namespace' => 'Java\Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('exercise', 'JavaExerciseController');

    Route::resource('topic', 'JavaExerciseTopicController');
});

Route::group(['prefix' => 'teacher/java', 'as' => 'teacher.java.', 'namespace' => 'Java\Teacher', 'middleware' => ['auth', 'teacher']], function () {
    Route::get('exercise-topic-users', 'JavaExerciseTopicUserController@index')->name('exerciseTopicUsers.index');

    Route::get('exercise-topic-users/{javaExercise}', 'JavaExerciseTopicUserController@show')->name('exerciseTopicUsers.show');

    Route::get('exercise-topic-users/{javaExercise}/topic-adapter', 'JavaExerciseTopicUserController@topicAdapter')->name('exerciseTopicUsers.topicAdapter');
});

Route::group(['middleware' => ['auth', 'teacher']], function () {
    Route::get('/teacher', 'TeacherController@index');

    Route::resource('/teacher/assignstudent', 'AssignStudentController');

    Route::resource('/teacher/member', 'StudentMemberController');

    Route::resource('/teacher/crooms', 'ClassroomController');
});

Route::group(['middleware' => ['auth', 'student']], function () {
    Route::get('/student', 'StudentController@index');

    Route::get('/student/java', 'StudentController@index');
});

Route::group(['prefix' => 'student/java', 'as' => 'student.java.', 'middleware' => ['auth', 'student']], function () {
    Route::get('do-task', [StudentJavaTaskController::class, 'doTask'])->name('do-task');
    Route::post('execute', [StudentJavaTaskController::class, 'execute'])->name('execute');
});

Route::middleware(['auth'])->group(function () {

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
