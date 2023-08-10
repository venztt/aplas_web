<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJavaExerciseTopicRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'java_class_name' => [
                'string',
                'required',
            ],
            'java_exercise_id' => [
                'string',
                'required',
            ],
            'tingkatan' => [
                'string',
                'required',
            ],
        ];
    }
}
