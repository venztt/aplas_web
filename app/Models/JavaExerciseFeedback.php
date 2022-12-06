<?php

namespace App\Models;

use App\User;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JavaExerciseFeedback extends Model
{
    use SoftDeletes;

    public $table = 'java_exercise_feedbacks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'suggestions',
        'adding_material',
        'others',
        'java_exercise_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function javaExercise()
    {
        return $this->belongsTo(JavaExercise::class, 'java_exercise_id');
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
