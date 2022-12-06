<?php

namespace App\Http\Controllers\Traits;

use App\Models\Setting;

trait MediaTrait
{
    public function storeMedia($file, $type = null, $exercise_topic = null)
    {
        if ($type) {
            $path = storage_path('app/public/java/' . $type);

            $path_save = null;
            $path_save_java = null;

            $report = null;

            $name = null;
            $original_name = null;

            try {
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
            } catch (\Exception $e) {
            }

            if ($type == 'exercise_files_user' && $exercise_topic) {
                $setting = Setting::first();

                if ($setting) {
                    $name = $exercise_topic->java_class_name;

                    $save_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'java' .
                        DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . auth()->id() . DIRECTORY_SEPARATOR . $exercise_topic->id);

                    try {
                        if (!file_exists($save_path)) {
                            mkdir($save_path, 0755, true);
                        }
                    } catch (\Exception $e) {

                    }

                    $save_java_path = $save_path . DIRECTORY_SEPARATOR . $name . '.java';
                    $save_java = fopen($save_java_path, "wb");

                    fwrite($save_java, $file);
                    fclose($save_java);

                    $path_save_java = $save_path . DIRECTORY_SEPARATOR;
                    $path_save_all = $save_path . DIRECTORY_SEPARATOR . '*.java';

                    try {
                        copy($exercise_topic->test_path, $save_path . DIRECTORY_SEPARATOR . $exercise_topic->java_class_name . "Test.java");
                        exec(escapeshellarg($setting->java_path . DIRECTORY_SEPARATOR . "javac.exe") .
                            " -cp " . $setting->java_junit_path . " " . $path_save_all . " 2>&1", $report);

                        array_map('unlink', glob("$path_save_java*.java"));
                    } catch (\Exception $e) {
                        $path_save_java = null;
                    }
                }
            } else {
                $original_name = $file->getClientOriginalName();
                $name = uniqid() . '_' . trim($file->getClientOriginalName());

                $save_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'java' .
                    DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR);

                try {
                    if (!file_exists($save_path)) {
                        mkdir($save_path, 0755, true);
                    }
                } catch (\Exception $e) {

                }

                $path_save = $save_path . $name;
                $file->move($save_path, $name);
            }

            return [
                'name' => $name,
                'raw' => $file . '',
                'original_name' => $original_name,
                'report' => $report,
                'file_path' => $path_save,
                'path_save_java' => $path_save_java,
            ];
        }

        return false;
    }
}
