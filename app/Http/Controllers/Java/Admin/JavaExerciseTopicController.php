<?php

namespace App\Http\Controllers\Java\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJavaExerciseTopicRequest;
use App\Http\Requests\UpdateJavaExerciseTopicRequest;
use App\Models\JavaExercise;
use App\Models\JavaExerciseTopic;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JavaExerciseTopicController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = JavaExerciseTopic::with('javaExercise')->select(sprintf('%s.*', (new JavaExerciseTopic())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $enabledCruds = ['show', 'edit', 'delete'];
                $crudRoutePart = 'admin.java.topic';

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
                return $row->file_path ? $row->file_path  : '';
            });

            $table->editColumn('test_path', function ($row) {
                return $row->test_path ? $row->test_path  : '';
            });

            $table->editColumn('java_exercise_id', function ($row) {
                return $row->javaExercise->name ? $row->javaExercise->name  : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.java.exerciseTopics.index');
    }

    public function create()
    {
        $javaExercise = JavaExercise::all()->pluck('name', 'id')->prepend('Please Select', '');

        return view('admin.java.exerciseTopics.create', compact('javaExercise'));
    }

    public function store(StoreJavaExerciseTopicRequest $storeJavaExerciseTopicRequest)
    {
        $javaExerciseTopics = JavaExerciseTopic::create($storeJavaExerciseTopicRequest->all());

        return redirect()->route('admin.java.topic.index');
    }

    public function edit(JavaExerciseTopic $topic)
    {
        $exerciseTopic = $topic;

        $javaExercise = JavaExercise::all()->pluck('name', 'id')->prepend('Please Select', '');

        return view('admin.java.exerciseTopics.edit', compact('exerciseTopic', 'javaExercise'));
    }

    public function update(UpdateJavaExerciseTopicRequest $updateJavaExerciseTopicRequest, JavaExerciseTopic $topic)
    {
        $topic->update($updateJavaExerciseTopicRequest->all());

        return redirect()->route('admin.java.topic.index');
    }

    public function show(JavaExerciseTopic $topic)
    {
        $exerciseTopic = $topic;

        return view('admin.java.exerciseTopics.show', compact('exerciseTopic'));
    }

    public function destroy(JavaExerciseTopic $topic)
    {
        $topic->delete();

        return back();
    }
}
