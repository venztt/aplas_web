<?php

namespace App\Http\Controllers\Java\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaTrait;
use App\Http\Requests\StoreJavaExerciseTopicRequest;
use App\Http\Requests\UpdateJavaExerciseTopicRequest;
use App\Models\JavaExercise;
use App\Models\JavaExerciseTopic;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JavaExerciseTopicController extends Controller
{

    use MediaTrait;

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
                return $row->file_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->file_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->editColumn('test_path', function ($row) {
                return $row->test_path ? '<a class="btn btn-success" href="' .
                    url('storage' . DIRECTORY_SEPARATOR . strstr($row->test_path, 'java')) . '">Download</a>' : 'No file found';
            });

            $table->editColumn('java_exercise_id', function ($row) {
                return $row->javaExercise->name ? $row->javaExercise->name  : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'file_path', 'test_path']);

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
        $javaExerciseTopics = JavaExerciseTopic::create($storeJavaExerciseTopicRequest->except('file_path', 'test_path'));

        if ($storeJavaExerciseTopicRequest->hasFile('file_path')) {
            $media = $this->storeMedia($storeJavaExerciseTopicRequest->file('file_path'), 'java_file');

            $javaExerciseTopics->update(['file_path' => $media['file_path']]);
        }

        if ($storeJavaExerciseTopicRequest->hasFile('test_path')) {
            $media = $this->storeMedia($storeJavaExerciseTopicRequest->file('test_path'), 'junit_file');

            $javaExerciseTopics->update(['test_path' => $media['file_path']]);
        }

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
        $topic->update($updateJavaExerciseTopicRequest->except('file_path', 'test_path'));

        if ($updateJavaExerciseTopicRequest->hasFile('file_path')) {
            $media = $this->storeMedia($updateJavaExerciseTopicRequest->file('file_path'), 'java_file');

            $topic->update(['file_path' => $media['file_path']]);
        }

        if ($updateJavaExerciseTopicRequest->hasFile('test_path')) {
            $media = $this->storeMedia($updateJavaExerciseTopicRequest->file('test_path'), 'junit_file');

            $topic->update(['test_path' => $media['file_path']]);
        }

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
