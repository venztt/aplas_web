<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{

    public function index()
    {
        //
        $entities = Classroom::where('classrooms.owner', '=', Auth::user()->id)
            ->leftJoin('class_members_group', 'classrooms.id', '=', 'class_members_group.classid')
            ->select('classrooms.id', 'classrooms.name', 'classrooms.status', 'classrooms.desc', 'class_members_group.count')
            ->orderBy('classrooms.name', 'asc')
            ->get();

        $data = ['entities' => $entities];

        return view('teacher/crooms/index')->with($data);
    }

    public function create()
    {
        //
        return view('teacher/crooms/create');
    }

    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required'
        ];

        $msg = [
            'name.required' => 'Class name must not empty'
        ];

        $validator = Validator::make($request->all(), $rules, $msg);

        //jika data ada yang kosong
        if ($validator->fails()) {

            //refresh halaman
            return Redirect::to('teacher/crooms/create')
                ->withErrors($validator);

        } else {

            $entity = new Classroom;
            $desc = ($request->get('desc') == null) ? '-' : $request->get('desc');
            $entity->name = $request->get('name');
            $entity->owner = Auth::user()->id;
            $entity->desc = $desc;
            $entity->save();

            session()->flash('message', 'A New Classroom Stored');

            //return "Add new topic is success";
            return Redirect::to('teacher/crooms');
        }
    }

    public function show($id)
    {
        $entity = \App\ClassMember::where('class_members.classid', '=', $id)
            ->join('users', 'users.id', '=', 'class_members.student')
            ->select('users.id', 'users.name', 'users.email')
            ->orderBy('users.name', 'asc')->get();
        $x = ['entities' => $entity];

        return view('teacher/crooms/show')->with($x);
    }

    public function edit($id)
    {
        //
        $entity = Classroom::find($id);
        $x = ['classroom' => $entity];
        return view('teacher/crooms/edit')->with($x);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
        $rules = [
            'name' => 'required'
        ];

        $msg = [
            'name.required' => 'Class name must not empty'
        ];


        $validator = Validator::make($request->all(), $rules, $msg);

        if ($validator->fails()) {
            return Redirect::to('teacher/crooms/' . $id . '/edit')
                ->withErrors($validator);

        } else {
            $entity = Classroom::find($id);
            $desc = ($request->get('desc') == null) ? '-' : $request->get('desc');

            $entity->name = $request->get('name');
            $entity->desc = $desc;
            $entity->save();

            session()->flash('message', 'Class with Id=' . $id . ' is changed');
            return Redirect::to('teacher/crooms');
        }
    }

    public function destroy($id): RedirectResponse
    {
        //
        $entity = Classroom::find($id);
        $entity->delete();

        session()->flash('message', 'Class with Id=' . $id . ' is deleted');
        return Redirect::to('teacher/crooms');
    }
}
