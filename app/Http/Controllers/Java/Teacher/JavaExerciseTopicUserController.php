<?php

namespace App\Http\Controllers\Java\Teacher;

use App\Http\Controllers\Controller;
use App\Models\JavaExercise;
use App\Models\JavaExerciseTopicUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JavaExerciseTopicUserController extends Controller
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
                $crudRoutePart = 'teacher.java.exerciseTopicUsers';

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

        return view('teacher.java.exerciseTopicUser.index');
    }

    public function show(JavaExercise $exerciseTopicUser)
    {
        return view('teacher.java.exerciseTopicUser.show', compact('exerciseTopicUser'));
    }
}
