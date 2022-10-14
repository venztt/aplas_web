<?php

namespace App\Http\Controllers\Java\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJavaExerciseRequest;
use App\Http\Requests\UpdateJavaExerciseRequest;
use App\Models\JavaExercise;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JavaExerciseController extends Controller
{
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
                return $row->grade ? $row->grade  : '';
            });

            $table->editColumn('module_path', function ($row) {
                return $row->module_path ? $row->module_path  : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

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
        $javaExercises = JavaExercise::create($storeJavaExerciseRequest->all());

        return redirect()->route('admin.java.exercise.index');
    }

    public function edit(JavaExercise $exercise)
    {
        return view('admin.java.exercises.edit', compact('exercise'));
    }

    public function update(UpdateJavaExerciseRequest $updateJavaExerciseRequest, JavaExercise $exercise)
    {
        $exercise->update($updateJavaExerciseRequest->all());

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
