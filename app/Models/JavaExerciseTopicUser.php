<?php

namespace App\Models;

use App\User;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JavaExerciseTopicUser extends Model
{
    use SoftDeletes;

    public $table = 'java_exercise_topic_users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'file_path',
        'raw',
        'status',
        'report',
        'java_exercise_topic_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function javaExerciseTopic()
    {
        return $this->belongsTo(JavaExerciseTopic::class, 'java_exercise_topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
