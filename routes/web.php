<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::resource('/admin/topics', 'TopicController');
    Route::resource('/admin/admintasks', 'TaskController');
    Route::resource('/admin/learning', 'LearningFileController');
    Route::resource('/admin/resources', 'ResourcesController');
    Route::resource('/admin/testfiles', 'TestFilesController');
    Route::get('/admin/testfiles/create/{topic}', 'TestFilesController@create');
    Route::resource('/admin/assignteacher', 'AssignTeacherController');
    Route::resource('/admin/assignteacher/index', 'AssignTeacherController@index');
    Route::resource('/admin/tmember', 'TeacherClassMemberController');
    Route::resource('/admin/studentres', 'StudentValidController');
    Route::get('/admin/studentres/{student}/{id}', 'StudentValidController@showteacher');
    Route::get('/admin/uploadsrc/{student}/{id}', 'StudentValidController@showsource');

    Route::resource('/admin/resview', 'StudentResultViewController');
    Route::resource('/admin/rankview', 'StudentResultRankController');
    Route::resource('/admin/completeness', 'StudentCompletenessController');

    Route::get('/admin/uistudentdetail/{student}/{id}', 'UiDetailController@showadmin');
    Route::get('/admin/uiuploadsrc/{student}/{topicid}/{id}', 'UiDetailController@showsource');
    Route::get('/admin/uiresview/{student}/{topicid}', 'UiResultViewController@showhistory');

    Route::resource('/admin/uitopic', 'UiTopicController');
    Route::resource('/admin/uitestfiles', 'UiTestFilesController');
    Route::resource('/admin/uiresview', 'UiResultViewController');
    Route::resource('/admin/uisummaryres', 'UiResultController');
    Route::resource('/admin/exerciseconf', 'ExerciseTopicController');
    Route::resource('/admin/exercisefiles', 'ExerciseFilesController');
    Route::resource('/admin/exerciseresources', 'ExerciseResourcesController');
    Route::resource('/admin/exerciseresview', 'ExerciseResultViewController');
    Route::get('/admin/exercisestudentres/{student}/{id}', 'ExerciseValidController@showadmin');
    Route::get('/admin/exercisestudentres/{student}/{topicid}/{id}', 'ExerciseValidController@showsource');

    Route::resource('/admin/resetpassword', 'ResetPasswordController');
});

Route::group(['middleware' => ['auth', 'teacher']], function () {
    Route::get('/teacher', 'TeacherController@index');
    Route::resource('/teacher/assignstudent', 'AssignStudentController');
    Route::resource('/teacher/member', 'StudentMemberController');
    Route::resource('/teacher/studentclasssummary', 'StudentResultClassController');
    Route::resource('/teacher/studentpassedresult', 'StudentPassedResultClassController');
    Route::resource('/teacher/studentres', 'StudentValidController');
    Route::resource('/teacher/crooms', 'ClassroomController');
    Route::get('/teacher/studentres/{student}/{id}', 'StudentValidController@showteacher');
    Route::get('/teacher/uploadsrc/{student}/{id}', 'StudentValidController@showsource');
    Route::resource('/teacher/rankview', 'StudentResultRankController');
    Route::resource('/teacher/jplasdown', 'JplasDownloadController');

    // UI (BARU)
    Route::resource('/teacher/uiclasssummary', 'UiResultClassController');
    Route::resource('/teacher/uiresview', 'UiResultViewController');
    Route::get('/teacher/uiresview/{student}/{topicid}', 'UiResultViewController@showhistory');
    Route::resource('/teacher/uisummaryres', 'UiResultController');
    Route::get('/teacher/uistudentres/{student}/{id}', 'UiValidController@showadmin');
    Route::get('/teacher/uiuploadsrc/{student}/{topicid}/{id}', 'UiValidController@showsource');

    Route::resource('/teacher/completeness', 'StudentCompletenessController');

});

Route::group(['middleware' => ['auth', 'student']], function () {
    Route::get('/student', 'StudentController@index');
    Route::resource('/student/tasks', 'TaskStdController');
    Route::resource('/student/results', 'TaskResultController');
//  Route::get('/student/results/valsub', 'TaskResultController@valsub');
    Route::patch('/student/results/valsub', ['as' => 'results.valsub', 'uses' => 'TaskResultController@valsub']);
    Route::get('student/results/create/{topic}', 'TaskResultController@create');
    Route::resource('/student/lfiles', 'FileResultController');
    Route::get('student/lfiles/create/{topic}', 'FileResultController@create');
    Route::get('student/lfiles/valid/{topic}', 'FileResultController@submit');
    Route::get('student/lfiles/delete/{id}/{topic}', 'FileResultController@delete');
    Route::resource('/student/rankview', 'StudentResultRankController');
    Route::resource('/student/valid', 'StudentValidController');
    Route::resource('/student/rankview', 'StudentResultRankController');
    Route::resource('/student/jplasdown', 'JplasDownloadController');

    Route::resource('/student/uitasks', 'UiTopicStdController');
    Route::get('student/uifeedback/{topic}', 'UiFeedbackController@create');
    Route::resource('/student/uifeedback', 'UiFeedbackController');
    Route::resource('/student/uiresview', 'UiStudentResultViewController');
    Route::get('/student/uistudentres/{id}', 'UiStudentValidController@show');
    Route::get('/student/uiuploadsrc/{topicid}/{id}', 'UiStudentValidController@showsource');

    Route::resource('/student/exercise', 'ExerciseStdController');
    Route::resource('/student/exercisesubmission', 'ExerciseSubmissionController');
    Route::resource('/student/exercisevalid', 'ExerciseStdValidController');
});

Route::middleware(['auth'])->group(function () {
    Route::get('download/guide/{file}/{topic}', 'DownloadController@downGuide')->name('file-download');
    Route::get('download/test/{file}/{topic}', 'DownloadController@downTest')->name('file-download');
    Route::get('download/supp/{file}/{topic}', 'DownloadController@downSupplement')->name('file-download');
    Route::get('download/other/{file}/{topic}', 'DownloadController@downOther')->name('file-download');
    // exercise
    Route::get('download/exerciseguide/{file}/{topic}', 'DownloadController@downExerciseGuide')->name('file-download');
    Route::get('download/exercisetest/{file}/{topic}', 'DownloadController@downExerciseTest')->name('file-download');
    Route::get('download/exercisesupp/{file}/{topic}', 'DownloadController@downExerciseSupplement')->name('file-download');
    Route::get('download/exerciseother/{file}/{topic}', 'DownloadController@downExerciseOther')->name('file-download');
    // jplas
    Route::get('download/jpack/{file}/{topic}', 'DownloadController@downJplasPackage')->name('file-download');
    Route::get('download/jguide/{file}/{topic}', 'DownloadController@downJplasGuide')->name('file-download');
    Route::get('download/jresult/{file}/{topic}', 'DownloadController@downJplasResult')->name('file-download');


});

Auth::routes();
//Route::get('register', 'Auth\RegisterController@index')->name('register');
//Route::get('register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');
