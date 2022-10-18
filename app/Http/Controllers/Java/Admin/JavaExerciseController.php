<?php

namespace App\Http\Controllers\Java\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaTrait;
use App\Http\Requests\StoreJavaExerciseRequest;
use App\Http\Requests\UpdateJavaExerciseRequest;
use App\Models\JavaExercise;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JavaExerciseController extends Controller
{
    use MediaTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = JavaExercise::query()->select(sprintf('%s.*', (new JavaExercise())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $enabledCruds = ['show', 'edit', 'delete'];
                $crudRoutePart = 'admin.java.exercise';

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

        return view('admin.java.exercises.index');
    }

    public function create()
    {
        return view('admin.java.exercises.create');
    }

    public function store(StoreJavaExerciseRequest $storeJavaExerciseRequest)
    {
        $javaExercises = JavaExercise::create($storeJavaExerciseRequest->except('module_path'));

        if ($storeJavaExerciseRequest->hasFile('module_path')) {
            $media = $this->storeMedia($storeJavaExerciseRequest->file('module_path'), 'java_module');

            $javaExercises->update(['module_path' => $media['file_path']]);
        }

        return redirect()->route('admin.java.exercise.index');
    }

    public function edit(JavaExercise $exercise)
    {
        return view('admin.java.exercises.edit', compact('exercise'));
    }

    public function update(UpdateJavaExerciseRequest $updateJavaExerciseRequest, JavaExercise $exercise)
    {
        $exercise->update($updateJavaExerciseRequest->except('module_path'));

        if ($updateJavaExerciseRequest->hasFile('module_path')) {
            $media = $this->storeMedia($updateJavaExerciseRequest->file('module_path'), 'java_module');

            $exercise->update(['module_path' => $media['file_path']]);
        }

        return redirect()->route('admin.java.exercise.index');
    }

    public function show(JavaExercise $exercise)
    {
        return view('admin.java.exercises.show', compact('exercise'));
    }

    public function destroy(JavaExercise $exercise)
    {
        $exercise->delete();

        return back();
    }
}
