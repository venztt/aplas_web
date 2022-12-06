<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JavaExercise extends Model
{
    use SoftDeletes;

    public $table = 'java_exercises';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'grade',
        'module_path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function topicWorkedOn(): int
    {
        return JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get()->count();
    }

    public function topicPassed(): int
    {
        $topics = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get();
        $topicsPassed = 0;

        foreach ($topics as $topic) {
            $topicUser = JavaExerciseTopicUser::with('javaExerciseTopic')
                ->where('java_exercise_topic_id', $topic->id)
                ->where('user_id', auth()->id())
                ->where('status', 'OK')
                ->first();

            if ($topicUser)
                $topicsPassed+=1;
        }

        return $topicsPassed;
    }

    public function topicPassedTeacher(): int
    {
        $topics = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get();
        $topicsPassed = 0;

        foreach ($topics as $topic) {
            $topicUser = JavaExerciseTopicUser::with('javaExerciseTopic')
                ->where('java_exercise_topic_id', $topic->id)
                ->where('status', 'OK')
                ->first();

            if ($topicUser)
                $topicsPassed+=1;
        }

        return $topicsPassed;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
