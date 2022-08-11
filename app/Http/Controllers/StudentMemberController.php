<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMemberController extends Controller
{
    public function index()
    {
        $entities = User::where('users.uplink', '=', Auth::user()->id)->where('users.status', '=', 'active')
            ->select('users.id', 'users.name', 'users.roleid', 'users.email', 'student_submits_count.count')
            ->leftJoin('student_submits_count', 'users.id', '=', 'student_submits_count.userid')
            ->orderBy('users.name', 'asc')
            ->get();

        $data = ['entities' => $entities];

        return view('teacher/member/index')->with($data);
    }

    public function edit($id): RedirectResponse
    {
        return response()->redirectTo('teacher/assignstudent/index');
    }

    public function show()
    {
        $entities = User::where('users.uplink', '=', Auth::user()->id)->where('users.status', '=', 'active')
            ->select('users.id', 'users.name', 'users.roleid', 'users.email', 'student_submits_count.count', 'student_submits_count.topicname')
            ->leftJoin('student_submits_count', 'users.id', '=', 'student_submits_count.userid')
            ->orderBy('users.name', 'asc')
            ->get();

        $data = ['entities' => $entities];

        return view('teacher/member/index')->with($data);
    }

    public function destroy(Request $request, $id)
    {
        $entity = User::find($id);
        $entity->status = 'deleted';
        $entity->save();
        //
        session()->flash('message', 'Student Member with Name=' . $entity->name . ' is deleted');
        return response()->redirectTo('/teacher/member');
    }
}
