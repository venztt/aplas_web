<?php

namespace App\Http\Controllers\Java\Student;

use App\Http\Controllers\Controller;
use App\Models\JavaExercise;
use App\Models\JavaExerciseTopic;
use App\Models\JavaExerciseTopicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentJavaExerciseController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = JavaExercise::query()->select(sprintf('%s.*', (new JavaExercise())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $enabledCruds = ['show'];
                $crudRoutePart = 'student.java.exercise';

                return view('partials.datatableActions', compact(
                    'row',
                    'enabledCruds',
                    'crudRoutePart'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('grade', function ($row) {
                return $row->grade ? $row->grade : '';
            });

            $table->editColumn('module_path', function ($row) {
                return $row->module_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->module_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->rawColumns(['actions', 'placeholder', 'module_path']);

            return $table->make(true);
        }

        return view('student.java.exercises.index');
    }

    public function show(JavaExercise $javaExercise)
    {
        return view('student.java.exercises.show', compact('javaExercise'));
    }

    public function topicAdapter(Request $request, JavaExercise $javaExercise)
    {
        if ($request->ajax()) {
            $query = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $javaExercise->id)->orderBy('id')
                ->select(sprintf('%s.*', (new JavaExerciseTopic())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) use ($javaExercise) {
                if ($row->test_path) {
                    $validationHistoryPass = JavaExerciseTopicUser::with('user')->where([
                        'java_exercise_topic_id' => $javaExercise->id,
                        'user_id' => Auth::id(),
                        'status' => 'OK'
                    ])->first();

                    if ($validationHistoryPass) {
                        $doActions = '<a href="' . route('student.java.learning-result.show',
                                ['javaExercise' => $javaExercise->id]) . '" class="btn btn-primary">Lihat Hasil</a>';
                    } else {
                        $doActions = '<a href="' . route('student.java.exercise.doTask',
                                ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $row->id]) . '" class="btn btn-primary">Kerjakan</a>';
                    }
                } else {
                    $doActions = '';
                }

                return $doActions;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->editColumn('file_path', function ($row) {
                return $row->file_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->file_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->editColumn('test_path', function ($row) {
                return $row->test_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->test_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->editColumn('java_exercise_id', function ($row) {
                return $row->javaExercise ? $row->javaExercise->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'file_path', 'test_path']);

            return $table->make(true);
        }

        return redirect()->route('student.java.exercise.index');
    }
}
