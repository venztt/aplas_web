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


Route::group(['middleware' => ['auth', 'teacher']], function () {
    Route::get('/teacher', 'TeacherController@index');

    Route::resource('/teacher/assignstudent', 'AssignStudentController');

    Route::resource('/teacher/member', 'StudentMemberController');

    Route::resource('/teacher/crooms', 'ClassroomController');
});

Route::group(['prefix' => 'teacher/java', 'as' => 'teacher.java.', 'namespace' => 'Java\Teacher', 'middleware' => ['auth', 'teacher']], function () {
    Route::get('exercise-topic-users', 'JavaExerciseTopicUserController@index')->name('exerciseTopicUsers.index');

    Route::get('exercise-topic-users/{javaExercise}', 'JavaExerciseTopicUserController@show')->name('exerciseTopicUsers.show');

    Route::get('exercise-topic-users/{javaExercise}/topic-adapter', 'JavaExerciseTopicUserController@topicAdapter')->name('exerciseTopicUsers.topicAdapter');

    Route::get('exercise-topic-result/{javaExerciseTopic}', 'JavaExerciseTopicUserController@resultShow')->name('exerciseTopicResult.show');

    Route::get('learning-result', 'StudentJavaLearningResultController@index')->name('learning-result.index');

    Route::get('learning-result/{javaExercise}', 'StudentJavaLearningResultController@show')->name('learning-result.show');

    Route::get('learning-result/{javaExercise}/topic-adapter', 'StudentJavaLearningResultController@topicAdapter')->name('learning-result.topicAdapter');

    Route::get('learning-result/{javaExercise}/feedback', 'StudentJavaLearningResultController@feedback')->name('learning-result.feedback');

    Route::post('learning-result/{javaExercise}/feedback-handle', 'StudentJavaLearningResultController@feedbackHandler')->name('learning-result.feedbackPost');
});


Route::group(['middleware' => ['auth', 'student']], function () {
    Route::get('/student', 'StudentController@index');

    Route::get('/student/java', 'StudentController@index');
});

Route::group(['prefix' => 'student/java', 'as' => 'student.java.', 'namespace' => 'Java\Student', 'middleware' => ['auth', 'student']], function () {

    Route::get('exercise', 'StudentJavaExerciseController@index')->name('exercise.index');

    Route::get('exercise/{javaExercise}', 'StudentJavaExerciseController@show')->name('exercise.show');

    Route::get('exercise/{javaExercise}/topic-adapter', 'StudentJavaExerciseController@topicAdapter')->name('exercise.topicAdapter');

    Route::get('exercise/{javaExercise}/do-task/{javaExerciseTopic}', 'StudentJavaTaskController@doTask')->name('exercise.doTask');

    Route::post('exercise/{javaExercise}/do-task/{javaExerciseTopic}/execute', 'StudentJavaTaskController@execute')->name('exercise.execute');

    Route::get('learning-result', 'StudentJavaLearningResultController@index')->name('learning-result.index');

    Route::get('learning-result/{javaExercise}', 'StudentJavaLearningResultController@show')->name('learning-result.show');

    Route::get('learning-result/{javaExercise}/topic-adapter', 'StudentJavaLearningResultController@topicAdapter')->name('learning-result.topicAdapter');

    Route::get('learning-result/{javaExercise}/feedback', 'StudentJavaLearningResultController@feedback')->name('learning-result.feedback');

    Route::post('learning-result/{javaExercise}/feedback-handle', 'StudentJavaLearningResultController@feedbackHandler')->name('learning-result.feedbackPost');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
