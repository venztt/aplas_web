<?php

namespace App\Http\Controllers\Java\Student;

use App\Http\Controllers\Controller;
use App\Models\JavaExercise;
use App\Models\JavaExerciseFeedback;
use App\Models\JavaExerciseTopic;
use App\Models\JavaExerciseTopicUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentJavaLearningResultController extends Controller
{
    public function index(Request $request)
    {
        if($request->id_student){
            $username = User::find($request->id_student)->name;
        } else {
            $username = User::find(Auth::user()->id)->name;
        }

        if ($request->ajax()) {
            $query = JavaExercise::query()->select(sprintf('%s.*', (new JavaExercise())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('hasil', function ($row) {
                return $row->topicGrading();
            });
            $table->editColumn('actions', function ($row) {
                $enabledCruds = ['show'];
                $crudRoutePart = 'student.java.learning-result';

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

            $table->addColumn('topic_worked_on', function ($row) {
                return $row->topicWorkedOn();
            });
            
            
            $table->addColumn('topic_passed', function ($row) {
                return $row->topicPassed();
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('student.java.learningResult.index', compact('username'));
    }

    public function show(JavaExercise $javaExercise, Request $request)
    {
        if($request->id_student){
            $user = User::find($request->id_student);
        } else {
            $user = Auth::user();
        }

        $feedback = JavaExerciseFeedback::where('java_exercise_id', $javaExercise->id)
            ->where('user_id', $user->id)->first();

        return view('student.java.learningResult.show', compact('javaExercise', 'feedback', 'user'));
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
                        'java_exercise_topic_id' => $row->id,
                        'user_id' => Auth::id(),
                        'status' => 'OK'
                    ])->first();

                    if ($validationHistoryPass) {
                        $doActions = 'Passed';
                    } else {
                        $doActions = 'Not Passed';
                        // $doActions = '<a href="' . route('student.java.exercise.doTask',
                        //         ['javaExercise' => $javaExercise->id, 'javaExerciseTopic' => $row->id]) . '" class="btn btn-primary">Kerjakan</a>';
                    }
                } else {
                    $doActions = '';
                }

                return $doActions;
            });
            // dd($query);
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('file_path', function ($row) {
                return $row->file_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->file_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->editColumn('test_path', function ($row) {
                return $row->test_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->test_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->editColumn('trying_times', function ($row) {
                return $row->tryingNumber();
            });

            $table->addColumn('results', function ($row){
                $totalScore = 0;
                $pattern = '/Total Score: (\d+)/';
                $report = JavaExerciseTopicUser::with('user')->where([
                    'java_exercise_topic_id' => $row->id,
                    'user_id' => Auth::id(),
                ])->orderBy('created_at', 'desc')->first();
                if ($report && preg_match($pattern, $report->report, $matches)) {
                    $totalScore = intval($matches[1]);
                } 
                return $totalScore;
            });

            $table->rawColumns(['actions', 'placeholder', 'file_path', 'test_path']);

            return $table->make(true);
        }

        return redirect()->route('student.java.learning-result.index');
    }

    public function feedback(Request $request, JavaExercise $javaExercise)
    {
        return view('student.java.learningResult.feedback', compact('javaExercise'));
    }

    public function feedbackHandler(Request $request, JavaExercise $javaExercise)
    {
        $feedback = JavaExerciseFeedback::create(array_merge($request->all(), ['user_id' => auth()->id(), 'java_exercise_id' => $javaExercise->id]));

        return redirect()->route('student.java.learning-result.index');
    }
}
