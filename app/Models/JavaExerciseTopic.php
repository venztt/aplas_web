<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JavaExerciseTopic extends Model
{
    use SoftDeletes;

    public $table = 'java_exercise_topics';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'percobaan',
        'min',
        'tingkatan',
        'file_path',
        'test_path',
        'java_class_name',
        'java_exercise_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function next($java_exercise_id){
        return JavaExerciseTopic::with('javaExercise')
            ->where('java_exercise_id', $java_exercise_id)
            ->where('id', '>', $this->id)->orderBy('id')->first();

    }

    public  function previous($java_exercise_id){
        return JavaExerciseTopic::with('javaExercise')
            ->where('java_exercise_id', $java_exercise_id)
            ->where('id', '<', $this->id)->orderByDesc('id')->first();
    }

    public  function tryingNumber(): int
    {
        return JavaExerciseTopicUser::with('javaExerciseTopic')
            ->where('java_exercise_topic_id', $this->id)
            ->where('user_id', auth()->id())->get()->count();
    }

    public function javaExercise()
    {
        return $this->belongsTo(JavaExercise::class, 'java_exercise_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
