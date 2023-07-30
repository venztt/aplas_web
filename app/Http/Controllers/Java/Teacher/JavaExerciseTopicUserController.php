<?php

namespace App\Http\Controllers\Java\Teacher;

use App\Http\Controllers\Controller;
use App\Models\JavaExercise;
use App\Models\JavaExerciseTopic;
use App\Models\JavaExerciseTopicUser;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JavaExerciseTopicUserController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $query = JavaExercise::query()->select(sprintf('%s.*', (new JavaExercise())->table));
        //     $table = Datatables::of($query);

        //     $table->addColumn('placeholder', '&nbsp;');
        //     $table->addColumn('actions', '&nbsp;');

        //     $table->editColumn('actions', function ($row) {
        //         $enabledCruds = ['show'];
        //         $crudRoutePart = 'teacher.java.exerciseTopicUsers';

        //         return view('partials.datatableActions', compact(
        //             'row',
        //             'enabledCruds',
        //             'crudRoutePart'
        //         ));
        //     });

        //     $table->editColumn('id', function ($row) {
        //         return $row->id ? $row->id : '';
        //     });

        //     $table->addColumn('name', function ($row) {
        //         return $row->name ? $row->name : '';
        //     });

        //     $table->editColumn('grade', function ($row) {
        //         return $row->grade ? $row->grade : '';
        //     });

        //     $table->editColumn('module_path', function ($row) {
        //         return $row->module_path ? '<a class="btn btn-success" href="' .
        //             url('storage' . DIRECTORY_SEPARATOR . strstr($row->module_path, 'java')) . '">Download</a>' : 'No file found';
        //     });

        //     $table->rawColumns(['actions', 'placeholder', 'module_path']);

        //     return $table->make(true);
        // }

        // return view('teacher.java.exerciseTopicUser.index');

        if ($request->ajax()) {
            $query = User::where([['roleid', 'student']])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $button = '<a class="btn btn-warning mr-1" href="'.route('teacher.java.learning-result.index', ["id_student"=>$row->id ]).'"><i class="fa fa-eye"></i> </a>';

                return $button;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('teacher.java.exerciseTopicUser.mahasiswa');
    }

    public function show(JavaExercise $javaExercise)
    {
        return view('teacher.java.exerciseTopicUser.show', compact('javaExercise'));
    }

    public function topicAdapter(Request $request, JavaExercise $javaExercise)
    {
        if ($request->ajax()) {
            $query = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $javaExercise->id)
                ->select(sprintf('%s.*', (new JavaExerciseTopic())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $enabledCruds = ['show'];
                $crudRoutePart = 'teacher.java.exerciseTopicResult';

                return view('partials.datatableActions', compact(
                    'row',
                    'enabledCruds',
                    'crudRoutePart'
                ));
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
                return $row->javaExercise->name ? $row->javaExercise->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'file_path', 'test_path']);

            return $table->make(true);
        }

        return redirect()->route('teacher.java.exerciseTopicUser.index');
    }

    public function resultShow(JavaExerciseTopic $javaExerciseTopic){
        $user = User::where('roleid', 'student')->get();
        $userTopics = [];

        foreach ($user as $item) {
            $javaExerciseTopicUser = JavaExerciseTopicUser::with('user')
                ->where('java_exercise_topic_id', $javaExerciseTopic->id)
                ->where('user_id', $item->id)->orderByDesc('created_at')
                ->get();

            $userTopics[$item->id] = [
                'user' => $item,
                'itemOk' => [],
                'itemFail' => [],
                'itemLast' => $javaExerciseTopicUser->first()
            ];

            foreach ($javaExerciseTopicUser as $it) {
                if ($it->status == 'OK') {
                    $userTopics[$item->id]['itemOk'][] = $it;
                } elseif ($it->status == 'FAILURE') {
                    $userTopics[$item->id]['itemFail'][] = $it;
                }
            }
        }

        return view('teacher.java.exerciseTopicResult.show', compact('javaExerciseTopic', 'userTopics'));
    }
}
