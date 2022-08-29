<?php

namespace App\Http\Controllers\Java\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaTrait;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StudentJavaTaskController extends Controller
{
    use MediaTrait;

    private $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function index()
    {
        return view('admin/main');
    }

    public function doTask()
    {
        return view('student.java.task.index');
    }

    public function execute(Request $request): JsonResponse
    {
        $results = [];
        $execute = $this->storeMedia($request->code, 'exercise_files_user', 'test');
        $className = 'HelloWorld';

        if (isset($execute['path_save_java']))
            if ($execute['path_save_java'] != null)
                $results = $this->runJava($execute['path_save_java'], $className);

        return response()->json(['status' => auth()->id(), 'data' => $results]);
    }

    public function runJava($path, $classname)
    {
        $report = null;

        if ($this->settings) {
            exec(escapeshellarg($this->settings->java_path . DIRECTORY_SEPARATOR . "java.exe") . " -cp "
                . $path . " " . $classname . " 2>&1", $report);
        }

        return $report;
    }

    public function runTest()
    {

    }
}
