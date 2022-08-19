<?php

namespace App\Http\Controllers\Traits;

use App\Models\Setting;

trait MediaTrait
{
    public function storeMedia($file, $type = null, $exercise_topic = null)
    {
        if ($type) {
            $path = storage_path('app/public/java/' . $type);
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
                    $name = uniqid() . '_' . 'HelloWorld';
//                    $name = uniqid() . '_' . $exercise_topic->class_name;

//                    $save_path = storage_path('app/public/java/' . $type . DIRECTORY_SEPARATOR  . auth()->id() . DIRECTORY_SEPARATOR  . $exercise_topic->id);
                    $save_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'java' .
                        DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . auth()->id() . DIRECTORY_SEPARATOR . '1');

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
                    exec(escapeshellarg($setting->java_path . DIRECTORY_SEPARATOR . "javac.exe") . " "
                        . $save_java_path . " 2>&1", $report);

                    unlink($save_java_path);
                }
            } else {
                $original_name = $file->getClientOriginalName();
                $name = uniqid() . '_' . trim($original_name);

                $file->move($path, $name);
            }

            return [
                'name' => $name,
                'original_name' => $original_name,
                'report' => $report,
                'path_save_java' => $path_save_java,
            ];
        }

        return false;
    }
}
