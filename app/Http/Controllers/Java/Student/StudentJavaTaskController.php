<?php

namespace App\Http\Controllers\Java\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StudentJavaTaskController extends Controller
{
    public function index()
    {
        return view('admin/main');
    }

    public function doTask()
    {
        return view('student.java.task.index');
    }

    public function execute(): JsonResponse
    {
        return response()->json(['status' => 'hoke']);
    }
}
