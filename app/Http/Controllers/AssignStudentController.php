<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignStudentController extends Controller
{
    public function index()
    {
        $entities = User::where('uplink', '=', Auth::user()->id)->where('status', '=', 'pending')->where('roleid', '=', 'student')
            ->select('id', 'name', 'roleid', 'email')
            ->orderBy('name', 'asc')->get();

        $classroom = Classroom::where('owner', '=', Auth::user()->id)
            ->pluck('name', 'id');

        $data = ['entities' => $entities, 'classroom' => $classroom];

        return view('teacher/assignstudent/index')->with($data);
    }

    public function store(Request $request)
    {

        $students = $request->get('students');
        $x = 0;
        if (is_array($students)) {
            foreach ($students as $std) {
                $user = User::find($std);
                $user->status = 'active';
                $user->save();

                $member = new \App\ClassMember;
                $member->classid = $request->get('classroom');
                $member->student = $std;
                $member->save();
                $x++;
            }
        }


        session()->flash('message', 'Validation for ' . $x . ' student(s) was succeed');
        return response()->redirectTo('teacher/assignstudent/index');
    }

    public function show()
    {
        $entities = User::where('uplink', '=', Auth::user()->id)->where('status', '=', 'pending')->where('roleid', '=', 'student')
            ->select('id', 'name', 'roleid', 'email')
            ->orderBy('name', 'asc')->get();

        $classroom = Classroom::where('owner', '=', Auth::user()->id)
            ->pluck('name', 'id');

        $data = ['entities' => $entities, 'classroom' => $classroom];

        return view('teacher/assignstudent/index')->with($data);
    }
}
