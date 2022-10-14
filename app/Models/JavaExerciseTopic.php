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
        'file_path',
        'test_path',
        'java_exercise_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function javaExercise()
    {
        return $this->belongsTo(JavaExercise::class, 'java_exercise_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
