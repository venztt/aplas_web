<?php

namespace App\Http\Controllers\Java\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaTrait;
use App\Models\JavaExercise;
use App\Models\JavaExerciseTopic;
use App\Models\JavaExerciseTopicUser;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StudentJavaTaskController extends Controller
{
    use MediaTrait;

    private $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function doTask(JavaExercise $javaExercise, JavaExerciseTopic $javaExerciseTopic)
    {
        $codeTemplate = 'class ' . $javaExerciseTopic->java_class_name . ' {
    public static void main(String args[]){
        System.out.println("Hello Java");
    }
}
';

        $validationHistory = JavaExerciseTopicUser::with('user')->where([
            'java_exercise_topic_id' => $javaExerciseTopic->id,
            'user_id' => Auth::id()
        ])->get();

        $validationHistoryPass = JavaExerciseTopicUser::with('user')->where([
            'java_exercise_topic_id' => $javaExerciseTopic->id,
            'user_id' => Auth::id(),
            'status' => 'OK'
        ])->first();

        $previousTopic = $javaExerciseTopic->previous($javaExercise->id);
        $nextTopic = $javaExerciseTopic->next($javaExercise->id);

        return view('student.java.task.index', compact(
                'javaExercise',
                'javaExerciseTopic',
                'validationHistoryPass',
                'codeTemplate',
                'validationHistory',
                'nextTopic',
                'previousTopic'
            )
        );
    }

    public function execute(Request $request, JavaExercise $javaExercise, JavaExerciseTopic $javaExerciseTopic): JsonResponse
    {
        $result = [];
        if ($javaExerciseTopic->java_class_name) {
            $execute = $this->storeMedia($request->code, 'exercise_files_user', $javaExerciseTopic);
            // return response()->json($execute);
            $result['data']['xecute'] = $execute;

            if (isset($execute['path_save_java']) && $execute['path_save_java'] != null) {
                $runTest = $this->runTest($execute['path_save_java'], $javaExerciseTopic->java_class_name);
                $result['data']['history_appends'] = $this->saveHistory($execute, $runTest, $javaExerciseTopic);
            } else {
                $result['status'] = false;
                $result['data']['messages'] = 'Failed to store your code.';
            }
        } else {
            $result['status'] = false;
        }
        // dd($result);
        return response()->json($result);
    }

    public function saveHistory($execute, $runTest, $javaExerciseTopic): array
    {
        $status = null;
        $report = "";

        foreach ($runTest as $it) {
            if (strpos($it, 'FAILURES!!!') !== false) {
                $status = 'FAILURE';
            } elseif (strpos($it, 'OK') !== false) {
                $status = 'OK';
            }

            $report .= $it . ' ';
        }

        $validationHistory = [
            'file_path' => json_encode($execute['path_save_java']),
            'raw' => $execute['raw'] . '',
            'status' => $status,
            'report' => $report,
            'java_exercise_topic_id' => $javaExerciseTopic->id,
            'user_id' => Auth::id(),
        ];

        $createdId = JavaExerciseTopicUser::create($validationHistory);
        $validationHistory['created_id'] = $createdId->id;

        return $validationHistory;
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

    public function runTest($path, $classname)
    {
    
        if ($this->settings) {
            
            exec(escapeshellarg($this->settings->java_path . DIRECTORY_SEPARATOR . "java.exe") . " -cp " .
                $path . ";" . $this->settings->java_junit_path . ";" . $this->settings->java_hamcrest_path . " org.junit.runner.JUnitCore " .
                $classname . "Test" . " 2>&1", $report);
            
        }


        return $report;
    }
}
